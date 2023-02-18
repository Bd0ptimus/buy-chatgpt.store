@extends('layouts.app')

@section('content')
    @php
        use App\Models\Account;
    @endphp
    <div class="d-flex justify-content-center" style="height: auto; width:auto; margin:auto;">
        <div class="container d-block justify-content-center">
            <div class = "d-flex justify-content-center">
                <h4>
                    Thanh toán thành công :  {{$checkout->checkout_code}}
                </h4>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <table id="productTable" class="table table-bordered table-striped text-nowrap" style="overflow:scroll;">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tài khoản</th>
                            <th scope="col">Mật khẩu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkout->accounts as $key=> $account)
                            <tr>
                                <td scope="col">{{ $key + 1 }}</td>
                                <td scope="col">{{ $account->account }}</td>
                                <td scope="col">{{  $account->password}}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
