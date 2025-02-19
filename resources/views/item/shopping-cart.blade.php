@extends('layouts.admin')
@section('content')

<!-- Shopping Cart -->
<div class="container">

	@if(Session::has('cart'))
    <div class="row text-center">
        <div class="col-sm-12 col-md-12" style="overflow-x:auto;">	

            <table class="table table-hover">
                <tr>
                    <th>ItemID</th>
                    <th>ItemName</th>					
                    <th>UnitPrice</th>
                    <th class="text-center" colspan="3">Qty</th>
                    <th>Amount</th>					
                    <th>Status</th>
                </tr>

                @foreach($items as $item)	

							<?php 	$p_id 	= 	$item['item']['id'];		?>	

						<tr>
							<td>{{ $item['item']['id'] }} </td>								

							<td>{{ $item['item']['name'] }} </td>	

							<td class="text-right"> MMK {{ number_format($item['item']['price']) }} </td>

							<td>
								<a href="{{ url("/item/subToCart/{$p_id}") }}" class="btn btn-outline-primary"> 
								- 
								</a>
							</td>
							
							<td> 
								<input type="text" name="qty" disabled value="{{ $item['qty'] }}" style="width: 80px; text-align: center;"> 
							</td>

							<td>
								<a href="{{ url("/item/addToCart/{$p_id}") }}" class="btn btn-outline-primary">
								+ 
								</a>
							</td>

							<td class="text-right"> MMK {{ number_format($item['item']['price'] * $item['qty']) }} </td>

							<td>
								<a href="{{ url("/item/removeFromCart/{$p_id}") }}" class="btn btn-outline-primary"> Remove </a>
							</td>
							
						</tr>	

				@endforeach

                <tr>
                    <td colspan="3">TOTAL</td>
                    <td colspan="3">
                        <b>{{ $totalQty }}</b>
                    </td>
                    <td class="text-right ">
                        <b>{{ number_format($totalPrice) }} MMK</b>
                    </td>						
                    <td></td>
                </tr>

            </table>    
        </div>
    </div>

    <br>
		
		<div class="row">

				<div class="col-sm-4 col-md-4">

						<a href="{{ url('/') }}" type="button" class="btn btn-outline-primary text-center" style="width: 100%">
							Continue Shopping
						</a>
				</div>

				<div class="col-sm-4 col-md-4">
						<a href="{{ url('/item/clearCart') }}" type="button" class="btn btn-outline-primary text-center" style="width: 100%">
							Clear
						</a>
				</div>

				<div class="col-sm-4 col-md-4">
						<a href="{{ url('/order') }}" type="button" class="btn btn-outline-primary text-center" style="width: 100%">
							Order
						</a>
				</div>

		</div>

	@else
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <img style="width: 300px;height: 200px;" src="{{ url("/images/emptycart.jpg") }}" class="card-img-top" >
                <h4>!!! No items in Cart !!!</h4>
        </div>
    </div>
	@endif

</div>
<!-- Shopping Cart -->

@endsection