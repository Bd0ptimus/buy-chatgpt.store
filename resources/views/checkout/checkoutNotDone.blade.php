@extends('layouts.app')

@section('content')
    @php
        use App\Models\Account;
    @endphp
    <div class="d-flex justify-content-center" style="height: auto; width:auto; margin:auto;">
        <div class="container d-flex justify-content-center">
            <div class = "d-flex justify-content-center">
                <h3>
                    Bạn chưa thanh toán hoặc chưa thanh toán đầy đủ đơn hàng {{$checkout->checkout_code}}
                </h3>
            </div>

        </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
