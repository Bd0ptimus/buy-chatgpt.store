@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row product-section d-flex justify-content-center">
                <div class="row d-flex justify-content-center" style="margin : 30px auto ;padding:0px;">
                    <div class="row" style="width:100%; margin: 30px auto;">
                        <div class="row justify-content-center my-4">
                            <div class="col-md-8">
                                <div class="card my-2">
                                    <div class="card-header">Thêm tài khoản {{$categoryName}} mới</div>

                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('admin.account.addAccount',['categoryId'=>$categoryId]) }}">
                                            @csrf

                                            <div class="row mb-3">
                                                <label for="username" class="col-md-4 col-form-label text-md-end">Username/Email<span class="text-danger">(*)</span></label>

                                                <div class="col-md-6">
                                                    <input id="username" type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        name="username" value="{{ old('username') }}" required
                                                        autocomplete="username" autofocus>

                                                    @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                            </div>

                                            <div class="row mb-3">
                                                <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu<span class="text-danger">(*)</span></label>
                                                <div class="col-md-6">
                                                    <input id="password" type="text"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" value="{{ old('password') }}" required
                                                        autocomplete="name" autofocus>

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="product" class="col-md-4 col-form-label text-md-end">Sản phẩm<span class="text-danger">(*)</span></label>
                                                <div class="col-md-6">
                                                    <select id="product" class="form-control"  name="product" >
                                                        <option label="Chọn sản phẩm..." value="0" selected="selected"  disabled hidden>Chọn sản phẩm</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>


                                                    @error('product')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Thêm tài khoản
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

