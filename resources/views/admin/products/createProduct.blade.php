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
                                    <div class="card-header">Thêm sản phẩm mới cho {{$categoryName}}</div>

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

                                            <div class="row mb-3">
                                                <label for="description" class="col-md-4 col-form-label text-md-end">Mô tả</label>
                                                <div class="col-md-6">
                                                    <input id="description" type="text"
                                                        class="form-control @error('description') is-invalid @enderror"
                                                        name="description" value="{{ old('description') }}" autocomplete="name"
                                                        autofocus>

                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="star" class="col-md-4 col-form-label text-md-end">Đánh giá</label>
                                                <div class="col-md-6">
                                                    <input id="star" type="range"
                                                        class=" @error('description') is-invalid @enderror"
                                                        name="star" value="{{ old('star') }}" autocomplete="star" min="0" max="5" step="1"
                                                        autofocus>
                                                    <span id="starPreview"></span><span>/5<i class="fa-solid fa-star" style="color:orange;"></i></span>
                                                    @error('star')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="status" class="col-md-4 col-form-label text-md-end">Trạng thái</label>
                                                <div class="col-md-6">
                                                    <select id="status"
                                                        class=" form-control @error('status') is-invalid @enderror"
                                                        name="status" >
                                                        <option value="{{PRODUCT_NONE_STATUS}}" label="Chọn trạng thái..." selected="selected"> Chọn trạng thái...</option>
                                                        <option value="{{PRODUCT_HOT_STATUS}}" > HOT</option>
                                                        <option value="{{PRODUCT_NEW_STATUS}}" > NEW</option>
                                                        <option value="{{PRODUCT_SALE_STATUS}}" > SALE</option>


                                                    </select>
                                                    @error('status')
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
    </div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {
    $('#star').val('0');
    $('#starPreview').text($('#star').val());

    $('#star').on('change', function () {
        $('#starPreview').text($('#star').val());
    });

});

</script>
@endsection
