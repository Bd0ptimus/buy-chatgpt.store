@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row product-section d-flex justify-content-center">
            @foreach($products as $product)
                <div class="product-slot">
                    <div class="product-img-sec d-flex justify-content-center">
                        <img class="product-img" src="{{$product->url_poster}}"/>
                    </div>

                    <div class="product-text-sec">
                        <p class ="product-name">
                            {{$product->name}}
                        </p>
                    </div>
                    <div class="product-text-sec">
                        <p class ="product-price">
                            &#8363; {{number_format($product->price)}}
                        </p>
                    </div>
                    <div class="product-action-sec d-flex justify-content-center">
                        <a class="my-2 d-flex justify-content-center a-btn">
                            <span style="font-weight : 600;">Mua</span>
                        </a>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
</div>
@endsection
