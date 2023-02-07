@extends('layouts.app')

@section('content')
@php
    use App\Models\Account;
@endphp
    <div class="d-flex justify-content-center" style="height: auto; width:auto;">
        <div class="row justify-content-center" style="width:100%;">
            <div class="row justify-content-center" style="margin : 30px 0px;">
                @foreach ($categories as $category)
                <span class="filter-element vertical-container @if ($category->id == $categoryId) filter-button-activated @endif"  style="background-color:{{$category->main_color}}" onclick='location.href="{{ route('product.index', ['categoryId' => $category->id]) }}"'>
                    @if(isset($category->image) || $category->image!="" )
                        <img src = "{{$category->image}}" class="vertical-element-middle-align filter-element-image"/>
                    @endif
                    <a href="{{ route('product.index', ['categoryId' => $category->id]) }}" style="@if(isset($category->image)||$category->image!='') margin-left : 50px; @endif"
                        class="a-btn filter-button  ">&ensp;{{ $category->name }}</a>
                </span>
            @endforeach
            </div>
            <div class="row product-section ">
                @foreach ($products as $product)
                    <div class="product-slot">

                        <div class="product-text-sec product-title-sec vertical-container d-flex justify-content-center"
                            style=" height:50px; ">
                            <p class="product-name vertical-element-middle-align">
                                {{ $product->name }}
                            </p>
                        </div>

                        <div class="product-text-sec d-flex justify-content-center">
                            <p class="product-price">
                                $&ensp;{{ number_format($product->price) }} VNĐ
                            </p>
                        </div>

                        <div class="product-text-sec d-flex justify-content-center">
                            <p class="product-left">
                                Còn : <span class="product-left-number">{{(Account::where('product_id', $product->id)->where('sold',ACCOUNT_NOT_SOLD )->get()->count()) }}</span>
                            </p>
                        </div>


                        <div class="product-text-sec d-flex justify-content-center">
                            <p class="product-des">
                                @if(isset($product->description))<i class="fa-solid fa-circle-info"></i>@endif&ensp;{{$product->description }}
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
