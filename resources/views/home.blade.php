@extends('layouts.app')

@section('content')
@php
    use App\Models\Account;
@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="row product-section ">
                {{-- @foreach ($products as $product)
                    <div class="product-slot">
                        <div class="product-img-sec d-flex justify-content-center">
                            <img class="product-img" src="{{ $product->url_poster }}" />
                        </div>

                        <div class="product-text-sec">
                            <p class="product-name">
                                {{ $product->name }}
                            </p>
                        </div>
                        <div class="product-text-sec">
                            <p class="product-price">
                                &#8363; {{ number_format($product->price) }}
                            </p>
                        </div>
                        <div class="product-action-sec d-flex justify-content-center">
                            <a class="my-2 d-flex justify-content-center a-btn"
                                href="{{ route('payment.create', ['paymentAmount' => $product->price, 'checkoutId' => '123']) }}">
                                <span style="font-weight : 600;">Mua</span>
                            </a>
                        </div>
                    </div>
                @endforeach --}}
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
                                Còn : <span class="product-left-number">{{(Account::where('product_id', $product->id)->where('sold',ACCOUNT_NOT_SOLD )->get()->count()) }}</span>
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

        {{-- <div class="row justify-content-center">
            <div class="row product-section d-flex justify-content-center">
                <table id="productTable" class="table table-bordered table-striped text-nowrap" style="overflow:scroll;">
                    <thead style="background-color:blue; color:white; font-size:18px;">
                        <tr>
                            <th scope="col">Tài khoản chatGPT</th>
                            <th scope="col" style="text-align:center;">Hiện có</th>
                            <th scope="col" style="text-align:center;">Đã bán</th>
                            <th scope="col" style="text-align:center;">Giá</th>
                            <th scope="col" style="text-align:center;">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td scope="col" class="vertical-container">
                                    <p class ="vertical-element-middle-align product-title" >
                                        {{ $product->name }} qqqqqqqqqqqqqqqqqqqqqqqqqqqqq
                                        qqqqqqqqqqqqqqqqqqqqqqqqqqqqq
                                    </p>

                                </td>
                                <td scope="col" class="vertical-container" style="height:60px;">
                                    <p class ="vertical-element-middle-align p-btn" >
                                        20
                                    </p>
                                </td>
                                <td scope="col"  class="vertical-container " style="height:60px;">
                                    <p class ="vertical-element-middle-align p-btn" >
                                        20
                                    </p>
                                </td>
                                <td scope="col" class="vertical-container d-flex " style="height:60px;">
                                    <p class ="vertical-element-middle-align p-btn" >
                                        {{ number_format($product->price) }} &#8363;
                                    </p>

                                </td>
                                <td scope="col" class="vertical-container">
                                    <a class=" my-2 d-flex justify-content-center a-btn"
                                        href="{{ route('payment.create', ['paymentAmount' => $product->price, 'checkoutId' => '123']) }}">
                                        <span style="font-weight : 600;">Mua</span>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div> --}}
    </div>
    </div>
@endsection
