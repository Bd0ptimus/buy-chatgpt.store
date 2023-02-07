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
                        <div class="row" style="width : 200px;">
                            <a class=" redirect-btn"
                                href="{{ route('admin.product.productForm', ['categoryId' => $categoryId]) }}">
                                {{-- href="{{route('admin.account.createAccount',['accountType'=>$role_user])}}" --}}
                                <i class="fa-solid fa-user-plus"></i><span> Thêm sản phẩm mới</span>
                            </a>
                        </div>
                        <div class="table-responsive" style="margin-top:20px;">
                            <table id="productTable" class="table table-bordered table-striped text-nowrap"
                                style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Giá bán (&#8363;)</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Đánh giá</th>
                                        <th scope="col">Trạng thái</th>

                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td scope="col">{{ $key + 1 }}</td>
                                            <td scope="col">{{ $product->name }}</td>
                                            <td scope="col">{{ number_format($product->price) }}</td>
                                            <td scope="col">{{ $product->description}}</td>
                                            <td scope="col">{{ $product->star}}<span>/5<i class="fa-solid fa-star" style="color:orange;"></i></span></td>
                                            <td scope="col">
                                                @if($product->status == PRODUCT_HOT_STATUS)
                                                    HOT
                                                @elseif($product->status == PRODUCT_NEW_STATUS)
                                                    NEW
                                                @elseif($product->status == PRODUCT_SALE_STATUS)
                                                    SALE
                                                @endif
                                            </td>

                                            <td>
                                                <a class="interact-btn" style="background-color:blue;"
                                                    onclick="updateProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->url_poster }}', '{{ $product->description }}', {{$product->star}}, {{$product->status}})">
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
                        @if(count($products)>0)
                        <div class="row" style="width : 200px; margin-top: 50px;">
                            <a class=" redirect-btn"
                                href="{{ route('admin.account.accountForm', ['categoryId' => $categoryId]) }}">
                                {{-- href="{{route('admin.account.createAccount',['accountType'=>$role_user])}}" --}}
                                <i class="fa-solid fa-user-plus"></i><span> Thêm tài khoản</span>
                            </a>
                        </div>
                        @endif
                        @foreach ($products as $product)
                        <div class="row" style="width:100%; margin: 30px auto;">
                            <h4 style="text-align:center; font-weight:700;">Các tài khoản của {{ $product->name }}</h4>
                            <div class="table-responsive" style="margin-top:20px;">
                                <table class="accountTable table table-bordered table-striped text-nowrap"
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
                                        @foreach ($accounts as $key => $account)
                                            @if ($account->product_id == $product->id)
                                                <tr>
                                                    <td scope="col">{{ $key + 1 }}</td>
                                                    <td scope="col">{{ $account->account }}</td>
                                                    <td scope="col">{{ $account->password }}</td>
                                                    <td>
                                                        <a class="interact-btn" style="background-color:blue;"
                                                            onclick="updateAccount({{ $account->id }}, '{{ $account->account }}', '{{ $account->password }}', {{$product->id}}, '{{$product->name}}')">
                                                            Chỉnh sửa</a>
                                                        <a class="interact-btn" style="background-color:red;"
                                                            href="{{ route('admin.account.deleteAccount', ['accountId' => $account->id]) }}">
                                                            Xóa</a>
                                                        {{-- @if ($admin->email != '')
                                                            <a class="action-account-btn interact-btn"
                                                                style="background-color:#1d8daf;"
                                                                href="{{ route('admin.sendAccountDetail', ['userId' => $admin->id, 'pageId' => ADMIN_PAGE]) }}">Gửi
                                                                thông tin tài khoản</a>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endif
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
    </div>
    </div>
    @include('admin.products.updateProduct')
    @include('admin.products.updateAccount')

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productTable').DataTable();
            $('.accountTable').DataTable();

            $('#productStar').on('change', function () {
                $('#starPreview').text($('#productStar').val());
            });

        });

        function updateProduct(productId, productName, productPrice, productPoster, productDes, productStar, productStatus) {
            let updateFormAction = `{{ route('admin.product.updateProduct', '') }}` + "/" + productId;
            changeProductResetFormStyle();
            changeProductResetForms();
            $('#updateProductForm').attr('action', updateFormAction);
            $('#productName').val(productName);
            $('#productPrice').val(productPrice);
            $('#productPoster').val(productPoster);
            $('#productDes').val(productDes);
            $('#productStar').val(productStar);
            $('#starPreview').text(productStar);
            $('#productStatus').val(productStatus);

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

            $('#updateAccount-modal-close').on('click', function() {
                $('#updateAccount-modal').modal('hide');
            })
        });

        function changeAccountResetFormStyle() {
            var setupBorderColor = "rgba(0, 0, 0, 0.175)";
            $('#accountUsername').css('border-color', setupBorderColor);
            $('#accountPassword').css('border-color', setupBorderColor);

        }

        function changeAccountResetForms() {
            $('#accountUsername').val("");
            $('#accountPassword').val("");
            $('#accountUsername').removeClass("is-invalid");
            $('#accountPassword').removeClass("is-invalid");
            $('span.invalid-feedback').remove();

        }

        function updateAccount(accountId, accountUsername, accountPassword, productId, productName){
            console.log(accountPassword);
            let updateFormAction = `{{ route('admin.account.updateAccount', '') }}`+"/"  + accountId;
            changeAccountResetFormStyle();
            changeAccountResetForms();
            $('#updateAccountForm').attr('action', updateFormAction);
            $('#accountUsername').val(accountUsername);
            $('#accountPassword').val(accountPassword);
            $('#accountProduct').val(productName);
            $('#accountConfirm').val(productId);

            $('#updateAccount-modal').modal('show');
        }
    </script>
@endsection
