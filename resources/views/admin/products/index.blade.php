@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row product-section d-flex justify-content-center">
                <div class="row d-flex justify-content-center" style="margin : 30px auto; padding:0px;">
                    <h3 class="d-flex justify-content-center" style="padding:0px;">
                        {{ $categoryName }}
                    </h3>

                </div>
                <div class="row d-flex justify-content-center" style="margin : 30px auto ;padding:0px;">
                    <div class="row" style="width:100%; margin: 30px auto;">
                        <h4 style="text-align:center; font-weight:700;">Các sản phẩm</h4>
                        <div class="table-responsive" style="margin-top:20px;">
                            <table id="productTable" class="table table-bordered table-striped text-nowrap"
                                style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Giá bán (&#8363;)</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <th scope="col">{{ $key + 1 }}</th>
                                            <th scope="col">{{ $product->name }}</th>
                                            <th scope="col">{{ number_format($product->price) }}</th>
                                            <td>
                                                <a class="interact-btn" style="background-color:blue;"
                                                    onclick="updateProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->url_poster }}')">
                                                    Chỉnh sửa</a>
                                                <a class="interact-btn" style="background-color:red;"
                                                    href="{{ route('admin.product.deleteProduct', ['productId' => $product->id]) }}">
                                                    Xóa</a>
                                                {{-- @if ($admin->email != '')
                                                    <a class="action-account-btn interact-btn"
                                                        style="background-color:#1d8daf;"
                                                        href="{{ route('admin.sendAccountDetail', ['userId' => $admin->id, 'pageId' => ADMIN_PAGE]) }}">Gửi
                                                        thông tin tài khoản</a>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center my-4">
                            <div class="col-md-8">
                                <div class="card my-2">
                                    <div class="card-header">Thêm sản phẩm mới</div>

                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('admin.product.addProduct', ['categoryId' => $categoryId]) }}">
                                            @csrf

                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">Tên sản
                                                    phẩm mới<span class="text-danger">(*)</span></label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" required
                                                        autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                            </div>

                                            <div class="row mb-3">
                                                <label for="price" class="col-md-4 col-form-label text-md-end">Giá bán
                                                    (&#8363;)<span class="text-danger">(*)</span></label>
                                                <div class="col-md-6">
                                                    <input id="price" type="number"
                                                        class="form-control @error('price') is-invalid @enderror"
                                                        name="price" value="{{ old('price') }}" required
                                                        autocomplete="name" autofocus>

                                                    @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="poster" class="col-md-4 col-form-label text-md-end">URL ảnh
                                                    Poster</label>
                                                <div class="col-md-6">
                                                    <input id="poster" type="text"
                                                        class="form-control @error('poster') is-invalid @enderror"
                                                        name="poster" value="{{ old('poster') }}" autocomplete="name"
                                                        autofocus>

                                                    @error('poster')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Thêm sản phẩm
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($products as $product)
                        <div class="row" style="width:100%; margin: 30px auto;">
                            <h4 style="text-align:center; font-weight:700;">Các tài khoản của {{ $product->name }}</h4>
                            <div class="table-responsive" style="margin-top:20px;">
                                <table id="productTable" class="table table-bordered table-striped text-nowrap"
                                    style="overflow:scroll;">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tài khoản</th>
                                            <th scope="col">Mật khẩu</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <th scope="col">{{ $key + 1 }}</th>
                                                <th scope="col">{{ $product->name }}</th>
                                                <th scope="col">{{ number_format($product->price) }}</th>
                                                <td>
                                                    <a class="interact-btn" style="background-color:blue;"
                                                        onclick="updateProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->url_poster }}')">
                                                        Chỉnh sửa</a>
                                                    <a class="interact-btn" style="background-color:red;"
                                                        href="{{ route('admin.product.deleteProduct', ['productId' => $product->id]) }}">
                                                        Xóa</a>
                                                    {{-- @if ($admin->email != '')
                                                        <a class="action-account-btn interact-btn"
                                                            style="background-color:#1d8daf;"
                                                            href="{{ route('admin.sendAccountDetail', ['userId' => $admin->id, 'pageId' => ADMIN_PAGE]) }}">Gửi
                                                            thông tin tài khoản</a>
                                                    @endif --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('admin.products.updateProduct')
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productTable').DataTable();
        });

        function updateProduct(productId, productName, productPrice, productPoster) {
            let updateFormAction = `{{ route('admin.product.updateProduct', '') }}` + "/" + productId;
            changeProductResetFormStyle();
            changeProductResetForms();
            $('#updateProductForm').attr('action', updateFormAction);
            $('#productName').val(productName);
            $('#productPrice').val(productPrice);
            $('#productPoster').val(productPoster);

            $('#updateProduct-modal').modal('show');

        }

        function changeProductResetFormStyle() {
            var setupBorderColor = "rgba(0, 0, 0, 0.175)";
            $('#productName').css('border-color', setupBorderColor);
            $('#productPrice').css('border-color', setupBorderColor);
            $('#productPoster').css('border-color', setupBorderColor);

        }

        function changeProductResetForms() {
            $('#productName').val("");
            $('#productPrice').val("");
            $('#productPoster').val("");

        }
        $(document).ready(function() {
            $('#updateProduct-modal-close').on('click', function() {
                $('#updateProduct-modal').modal('hide');
            })
        });
    </script>
@endsection
