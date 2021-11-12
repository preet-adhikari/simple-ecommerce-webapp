@extends('layouts.app')

@section('content')
    <section class="p-3">
    @if(\Illuminate\Support\Facades\Session::has('cart') && (\Illuminate\Support\Facades\Session::get('cart')->items != null))

        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <ul class="list-group">
                        @foreach($products as $item)
                            <li class="list-group-item">
                                <span class="badge">{{$item['qty']}}</span>
                                <strong>{{ $item['item']['name'] }}</strong>
                                <span class="label label-success">${{$item['price']}}</span>
                                <span class="badge">
                                    <a href="{{route('product.removeFromCart',['id' => $item['item']['id']])}}" class="btn btn-outline-danger"><i class="bi bi-x-circle"></i></a>
                                </span>
                                <span class="d-flex justify-content-end">
                                    @if( $item['item']->stock > 0)
                                    <a href="{{route('product.addToCart',['id' => $item['item']['id']])}}" class="btn btn-outline-secondary">
                                        <i class="bi bi-plus-circle"></i>
                                    </a>
                                    @endif

                                    <a href="{{route('product.reduceFromCart',['id' => $item['item']['id']])}}" class="btn btn-outline-danger">
                                        <i class="bi bi-dash-circle"></i>
                                    </a>

                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <strong>Total : {{$totalPrice}}</strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <button type="button" class="btn btn-success">Checkout</button>
                </div>
            </div>

        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h2>No items in Cart</h2>
                </div>
            </div>
        </div>
    @endif
    </section>
@endsection
