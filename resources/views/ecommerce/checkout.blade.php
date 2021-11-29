@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3 form-container">
                <h1>Checkout</h1>
                <h4>Your total: <strong>${{$total}}</strong></h4>
                <div id="charge-error" class="alert alert-danger" {{!\Illuminate\Support\Facades\Session::has('error') ? 'hidden' : ''}}>
                    {{\Illuminate\Support\Facades\Session::get('error')}}
                </div>
                <form action="{{route('checkout.post')}}" method="post" id="checkout-form">
                    @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" required name="name">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" class="form-control" required name="address">
                            </div>


                            <div class="form-group">
                                <label for="card-name">Card Holder Name</label>
                                <input type="text" id="card-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="card-number">Credit Card Number</label>
                                <input type="text" name="accountNumber" id="card-number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="card-expiry-month">Expiration Month</label>
                                <input type="text" id="card-expiry-month" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="card-expiry-year">Expiration Year</label>
                                <input type="text"  name="cardExpiryYear" id="card-expiry-year" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="card-cvc">CVC</label>
                                <input type="text" id="card-cvc" class="form-control" required>
                            </div>

                    <button type="submit" class="btn btn-success btn-block">Buy Now</button>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('js/checkoutStripe.js')}}"></script>
    <script>
        console.log('val');
    </script>
@endsection
