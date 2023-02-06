@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row product-section ">
                @foreach ($products as $product)
                    <div class="product-slot">

                        <div class="product-text-sec vertical-container d-flex justify-content-center"
                            style=" height:50px; background-color: rgb(255,245,203,0.5);">
                            <p class="product-name vertical-element-middle-align">
                                {{ $product->name }}
                            </p>
                        </div>

                        <div class="product-text-sec d-flex justify-content-center">
                            <p class="product-price">
                                {{ number_format($product->price) }} VNĐ
                            </p>
                        </div>

                        <div class="product-text-sec d-flex justify-content-center">
                            <p class="product-left">
                                Còn : <span class="product-left-number">10000</span>
                            </p>
                        </div>


                        <div class="product-text-sec d-flex justify-content-center">
                            <p class="product-des">
                                {{$product->description }}
                            </p>
                        </div>


                        <div class="product-action-sec d-flex justify-content-center">
                            <a class="my-2 d-flex justify-content-center buy-btn"
                                href="{{ route('payment.create', ['paymentAmount' => $product->price, 'checkoutId' => '123']) }}">
                                <span style="font-weight : 600;"><i class="fa-solid fa-cart-plus"></i>&emsp;Mua ngay</span>
                            </a>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
@endsection
