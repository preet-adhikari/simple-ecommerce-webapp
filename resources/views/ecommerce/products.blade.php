@extends('layouts.app')

@section('content')
    <section class="p-3">
        <h2 class="text-center text-capitalize">Products under {{$brand_name}} </h2>
        <div class="container">
            <div class="row">
                @foreach($products as $item)
                    <div class="col-md-6">
                        <a href="#">
                            <div class="card bg-white text-dark">
                                <img src="{{asset('images/product_images/'.$item->image)}}" class="img-fluid w-50" alt="">
                                <div class="card-body">
                                    <div class="card-title">
                                        {{$item->name}}
                                    </div>
                                    <p class="card-text">{{$item->stock}} remaining in stock</p><br>
                                    <p class="card-text">Price : <span class="font-weight-bold">$ {{$item->price}}</span></p>
                                </div>
                            </div>
                        </a>
                        <br>
                        <div class="container">
                            <a href="{{route('product.addToCart',['id' => $item->id])}}" class="btn btn-success">Add to cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
        </div>

    </section>

@endsection
