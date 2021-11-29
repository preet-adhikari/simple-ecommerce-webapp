@extends('layouts.app')

@section('content')
{{--    Main View--}}
<section class="bg-dark p-5 pb-lg-0 pt-lg-4">
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between py-5">
                <img src="https://source.unsplash.com/ezeC8-clZSs" class="img-fluid w-50 float-left" alt="">
            <div class="p-3 text-white">
                <h1>Welcome To <span class="text-success">WebKart</span></h1>
                <p class="lead my-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur provident
                    tempora possimus
                    necessitatibus earum explicabo ratione, ipsa quaerat voluptas nisi ad harum a ut, reprehenderit
                    iste eos aut deleniti repudiandae?</p>
            </div>
        </div>
    </div>
</section>
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="container">
            <div class="row">
                <div id="charge-message" class="alert alert-success">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            </div>
        </div>
    @endif

{{--    Newsletter--}}
    <section class="bg-secondary p-5">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center">
                <h3 class="mb-3 mb-md-0 text-white">Sign Up for Our Daily Newsletter</h3>
                <div class="input-group newsletter">
                    <input type="text" class="form-control" placeholder="Enter your email">
                    <button class="btn btn-dark btn-lg" type="button">Submit</button>
                </div>
            </div>
        </div>
    </section>


    <section class="p-3">
        <h2 class="text-center text-capitalize">Looking for something? We have almost all of it.</h2>
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('img/product1.jpg') }}" alt="">
            </div>
        </div>

    </section>


    <section class="p-3">
        <h2 class="text-center text-capitalize">Categories</h2>
        <div class="container">

                <div class="row">
                    @foreach($categories as $key => $item)
                        @if($loop->iteration <=12)
                        <div class="col-md-6 p-3">
                            <a href="{{route('category.viewBrand',['name' => $item->name, 'id' => $item->id])}}" class="text-white">
                                <div class="card bg-dark text-white">
                                    <img src="{{asset('images/category_images/'.$item->image)}}" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->name}}</h5>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos, velit.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @else
                            <div class="col-md-6 p-3 category-hide">
                                <a href="{{route('category.viewBrand',['name' => $item->name, 'id' => $item->id])}}" class="text-white">
                                    <div class="card bg-dark text-white">
                                        <img src="{{asset('images/category_images/'.$item->image)}}" alt="" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->name}}</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos, velit.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary p-3 justify-content-center text-bold content-toggle">View More Categories</button>
                <button class="btn btn-primary p-3 justify-content-center text-bold show-less">Show less</button>
            </div>
                <br>

        </div>
    </section>


@endsection

@section('javascripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('js/hideContent.js')}}"></script>
    <script>
        jQuery(document).ready( function ($) {
            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 1520,
                smartSpeed: 1500,
                animateIn: 'linear',
                animateOut: 'linear',
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>
@endsection
