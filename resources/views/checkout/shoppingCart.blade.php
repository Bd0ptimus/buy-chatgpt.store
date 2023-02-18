@extends('layouts.app')

@section('content')
    @php
        use App\Models\Account;
    @endphp
    <div class="d-flex justify-content-center" style="height: auto; width:auto; max-width:1000px; margin:auto;">
        <div class="row justify-content-center" style="width:100%;">
            <div class="d-block justify-content-center" style="padding: 0px 50px;">
                <div class="row d-flex justify-content-center" style="width:100%; margin:auto; text-align:center;">
                    <h3>Xác nhận thanh toán</h3>
                </div>

                <div class="checkout-info-sec">
                    <div class="checkout-sec d-block justify-content-center">
                        <div class=" vertical-container d-flex justify-content-start" style=" height:50px; ">
                            <p class="checkout-product-name vertical-element-middle-align">
                                Tên sản phẩm: {{ $product->name }}
                            </p>

                        </div>

                        <div class="d-flex justify-content-start">
                            <p class="checkout-product-price ">
                                $&ensp;{{ number_format($product->price) }} VNĐ
                            </p>
                        </div>

                        <div class=" d-flex justify-content-start">
                            <p class="product-left">
                                Còn : <span
                                    class="checkout-left-number">{{ Account::where('product_id', $product->id)->where('sold', ACCOUNT_NOT_SOLD)->get()->count() }}</span>
                            </p>
                        </div>


                        <div class=" d-flex justify-content-start">
                            <p class="checkout-product-des">
                                @if (isset($product->description))
                                    <i class="fa-solid fa-circle-info"></i>
                                @endif&ensp;{{ $product->description }}
                            </p>
                        </div>
                    </div>

                    <div class="checkout-sec d-block justify-content-center" style=" background-color:#fedb9891;">
                        <form method="POST" action="{{ route('checkout.waitingPayment', ['productId' => $product->id]) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Chọn số lượng<span
                                        class="text-danger">(*)</span></label>

                                <div class="col-md-6">
                                    <div class="number-field ">
                                        <div class="input-group d-flex justify-content-center">
                                          <button type="button" class="btn minus-btn" data-type="minus">-</button>
                                          <input type="number" id="numberProduct" name="numberProduct" value="1" min="1" style="width:50px;">
                                          <button type="button" class="btn plus-btn" data-type="plus">+</button>
                                        </div>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email<span
                                        class="text-danger">(*)</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Tên người nhận</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="product" class="col-md-12 col-form-label text-md-center"
                                    style="font-weight:700;">Các phương thức thanh toán : </label>
                                <div class="col-md-12">
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <span class="d-flex justify-content-center">
                                            <span class="col-md-1 col-form-label text-md-center">
                                                <input type="radio" id="payment-{{ $paymentMethod->id }}"
                                                    name="paymentMethod" value="{{ $paymentMethod->id }}" checked>
                                            </span>
                                            <span class="col-md-11 col-form-label text-md-start">
                                                <label for="payment-{{ $paymentMethod->id }}">Thanh toán bằng chuyển khoản
                                                    đến tài khoản
                                                    {{ PAYMENT_METHOD_NAME[$paymentMethod->payment_id] }}</label><br>
                                            </span>
                                        </span>
                                    @endforeach

                                    @error('product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="checkout-submit" type="submit" class="btn buy-btn" disabled>
                                        Xác nhận thanh toán
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>




        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/sass/checkout.scss'])
@endsection

@section('script2')
    <script type="text/javascript">
        let numberLeft = '{{(Account::where('product_id', $product->id)->where('sold',ACCOUNT_NOT_SOLD )->get()->count())}}';
        $(document).ready(function() {
            $('#email').change(() => {
                if ($('#email').val() != '') {
                    $('#checkout-submit').prop('disabled', false);
                } else {
                    $('#checkout-submit').attr('disabled', 'disabled');

                }
            });

            $('.number-field .btn').on('click', function() {
                var input = $(this).parent().find('input');
                var type = $(this).data('type');
                var value = parseInt(input.val());

                if (type === 'plus') {
                    if(value < numberLeft){
                        value = value + 1;
                    }
                } else {
                    value = value - 1;
                }

                if (value < 1) {
                    value = 1;
                }

                input.val(value);
            });
        });
    </script>
@endsection
