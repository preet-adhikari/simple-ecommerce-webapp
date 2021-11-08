@extends('layouts.app')

@section('content')
    <section class="p-3">
        <h2 class="text-center text-capitalize">Brands under {{$category_name}}</h2>
        <div class="container">
            <div class="row">
                @foreach($brands as $item)
                    <div class="col-md-6">
                        <a href="{{route('brand.viewProduct',['name' => $item->name, 'id' => $item->id])}}">
                            <div class="card bg-white text-dark">
                                <img src="{{asset('images/brand_images/'.$item->logo)}}" class="img-fluid w-50" alt="">
                                <div class="card-img-overlay">
                                    <div class="card-title">
                                        {{$item->name}}
                                    </div>
                                    <p class="card-text">View products under {{$item->name}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

@endsection
