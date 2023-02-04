@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row product-section d-flex justify-content-center">
                <div class="row d-flex justify-content-center" style="margin : 30px auto; padding:0px;">
                    <h3 class="d-flex justify-content-center" style="padding:0px;">
                        Quản lý nhóm sản phẩm
                    </h3>

                </div>
                <div class="row d-flex justify-content-center" style="margin : 30px auto ;padding:0px;">
                    <div class="row" style="width:100%; margin: 30px auto;">
                        <h4 style="text-align:center; font-weight:700;">Các nhóm sản phẩm</h4>
                        <div class="table-responsive" style="margin-top:20px;">
                            <table id="categoryTable" class="table table-bordered table-striped text-nowrap"
                                style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">ID nhóm sản phẩm</th>
                                        <th scope="col">Tên nhóm sản phẩm</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <th scope="col">{{ $key + 1 }}</th>
                                            <th scope="col">{{ $category->id }}</th>
                                            <th scope="col">{{ $category->name }}</th>
                                            <td>
                                                <a class="interact-btn"
                                                    style="background-color:blue;"
                                                    onclick="updateCategory({{$category->id}}, '{{$category->name}}')">
                                                    Chỉnh sửa</a>
                                                <a class="interact-btn"
                                                    style="background-color:red;"
                                                    href="{{route('admin.category.deleteCategory',['categoryId'=>$category->id])}}">
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
                                    <div class="card-header">Thêm nhóm sản phẩm mới</div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('admin.category.addCategory') }}">
                                            @csrf

                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">Tên nhóm
                                                    sản phẩm mới</label>

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
                </div>
            </div>
        </div>
    </div>
    @include('admin.categories.updateCategory');

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categoryTable').DataTable();
        });

        function updateCategory(categoryId, categoryName) {
            let updateFormAction =  `{{route("admin.category.updateCategory",'')}}`+"/"+categoryId;
            changeCategoryResetFormStyle();
            changeCategoryResetForms();
            $('#updateCategoryForm').attr('action', updateFormAction);
            $('#categoryName').val(categoryName);
            $('#updateCategory-modal').modal('show');

        }
    </script>
@endsection
