@extends('layouts.admin')
@section('content')


<div class="container-fluid">
<div class="row justify-content-center">
		
	<div class="col-md-4">
		<div class="container">
			<img style="width: 300px; height: 300px;" src="{{url("/images/item/" .$item->photo)}}" class="card-img-top" >
		</div>
	</div>

	<div class="col-md-8">
        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header text-center text-white" style="background: linear-gradient(135deg, #ff9a9e, #fad0c4); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="fw-bold mb-0">Product Detail</h5>
            </div>
            <div class="card-body" style="background-color: #fffaf0; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
            <div class="table-responsive">
			<div class="text-center">
				<div class="card-text">Name: 	{{ $item->name }} 	</div>
				<div class="card-text">Price: 	{{ $item->price }} 	</div>
				<div class="card-text">Qty: 	{{ $item->qty }} 	</div>
				<div class="card-text">Gender: 	{{ $item->gender }} 	</div>
			</div>
		</div>
	</div>

</div> 
		<br>

		<div class="card text-center">
			
			<div class="card-body" style="background-color: #fffaf0; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
				
				<form method="get" enctype="multipart/form-data" action="{{ url("/item/addToCartQty/{$item->id}") }}" >
					{{ csrf_field() }} 

					<span>
					    Quantity : 
					    <input style="width: 100px;"  type="number" name="pqty"  min="1" max="{{ $item->qty }}" value="1" >
					</span>


                    @if($item->qty > 0)		    		
                        <input  type="submit"  value="Add to Cart" class="btn btn-primary" >
                    @else
                        <input  type="submit" value="Out of Stock" class="btn btn-danger" disabled>	
                    @endif

				</form>
			</div>
		</div>
</div> <!-- Container -->

@endsection