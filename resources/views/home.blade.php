@extends('layouts.app')

@section('content')
    @php
        use App\Models\Account;
        use App\Models\Product;

    @endphp
    <div class="d-flex justify-content-center" style="height: auto; width:100%;">
        <div class="row justify-content-center" style="width:100%;">
            <div class="row justify-content-center" style="margin : 30px 0px;">
                @foreach ($categories as $category)
                    <span class="filter-element vertical-container" style="background-color:{{$category->main_color}}" onclick='location.href="{{ route('product.index', ['categoryId' => $category->id]) }}"'>
                        @if(isset($category->image) && filter_var($category->image, FILTER_VALIDATE_URL))
                            <img src = "{{$category->image}}" class="vertical-element-middle-align filter-element-image"/>
                        @endif
                        <a href="{{ route('product.index', ['categoryId' => $category->id]) }}" style="@if(isset($category->image)&&filter_var($category->image, FILTER_VALIDATE_URL)) margin-left : 50px; @endif"
                            class="a-btn filter-button  @if ($category->id == $categoryId) filter-button-activated @endif">&ensp;{{ $category->name }}</a>
                    </span>
                @endforeach
            </div>
            <div class="row product-section ">
                @foreach ($categories as $category)
                    @if(Product::where('category_id', $category->id)->get()->count() > 0)
                    <h1 class="category-splitder">
                        <span>
                            {{ $category->name }}
                        </span>
                    </h1>
                    @endif
                    @foreach ($category->products as $product)
                        <div class="product-slot">
                            @if($product->status != 0)
                            <div class = "product-status-sec">
                                <div class = " d-flex justify-content-center product-status vertical-container" style="z-index : 5001;">
                                    <p class="vertical-element-middle-align" style="margin:0px;">
                                        @if($product->status == PRODUCT_HOT_STATUS)
                                            HOT
                                        @elseif($product->status == PRODUCT_NEW_STATUS)
                                            NEW
                                        @elseif($product->status == PRODUCT_SALE_STATUS)
                                            SALE
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif

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
                                    Còn : <span
                                        class="product-left-number">{{ Account::where('product_id', $product->id)->where('sold', ACCOUNT_NOT_SOLD)->get()->count() }}</span>
                                </p>
                            </div>


                            <div class="product-text-sec d-flex justify-content-center">
                                <p class="product-des">
                                    @if (isset($product->description))
                                        <i class="fa-solid fa-circle-info"></i>
                                    @endif&ensp;{{ $product->description }}
                                </p>
                            </div>
                            <div class="product-text-sec d-flex justify-content-center">
                                @for ($i = 1; $i < 6; $i++)
                                        <span
                                            class="fa fa-star @if ($i <= $product->star) rating-star-checked @endif"></span>
                                @endfor
                            </div>

                            <div class="product-action-sec d-flex justify-content-center">
                                <a class="my-2 d-flex justify-content-center buy-btn"
                                    href="{{ route('checkout.shoppingCart', ['productId' => $product->id]) }}">
                                    <span style="font-weight : 600;"><i class="fa-solid fa-cart-plus"></i>&emsp;Mua
                                        ngay</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endforeach




            </div>
        </div>
    </div>
@endsection
