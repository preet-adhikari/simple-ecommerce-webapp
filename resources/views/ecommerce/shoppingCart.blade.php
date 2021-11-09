@extends('layouts.app')

@section('content')
    <section class="p-3">
    @if(\Illuminate\Support\Facades\Session::has('cart'))
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <ul class="list-group">
                        @foreach($products as $item)
                            <li class="list-group-item">
                                <span class="badge">{{$item['qty']}}</span>
                                <strong>{{ $item['item']['name'] }}</strong>
                                <span class="label label-success">${{$item['price']}}</span>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Options <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Reduce by 1</a></li>
                                        <li><a href="#">Remove product</a></li>
                                    </ul>
                                </div>
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
