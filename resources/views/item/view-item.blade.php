@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="d-flex flex-row justify-content-center flex-wrap my-flex-container">

        @foreach ($items as  $item)
            <div class="p-1 my-flex-item" style="width: 165px; ">     
    
                <div class="card" style="padding: 5px;position: relative; ">
				
                    <a class="card-text" style="font-size: 60%;text-decoration: none;color: black;" href="{{ url("/item/{$item->id}/detail") }}" >
    
                        <img style="width: 145px; height: 130px;" src="{{url("/images/item/" .$item->photo)}}" class="card-img-top" > 
                        
                        <div class="card-footer text-center bg-white">
                                <p class="card-title text-danger" >
                                    {{ number_format($item->price) }} MMK
                                </p>
                                <p class="card-text d-inline-block text-truncate">
                                    {{ $item->name }}
                                </p>	       	       
                        </div>
                    </a>
                

                </div>
    
            </div>
           @endforeach
    
    </div>
</div>

@endsection