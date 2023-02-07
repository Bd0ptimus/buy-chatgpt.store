@php
    use App\Admin;
@endphp
<div class="modal fade clearfix px-5" id="updateProduct-modal" tabindex="-1" role="dialog"
    aria-labelledby="" aria-hidden="true" style="padding:0px;">
    <div class="modal-dialog modal-dialog-centered " role="document"
        style="max-width: 1000px; width: 100%; margin : auto;">
        <div class="modal-content">

            <div class="modal-header d-flex justify-content-center" style="position:relative;">
                <h4 style="font-size:20px; font-weight:bold; text-align:center;  padding:0px 50px;">Chỉnh sửa sản phẩm</h4>
                <span id="updateProduct-modal-close" style=" position:absolute; right:10px; top:5px;" class="modal-close-btn d-flex justify-content-center">
                    <i class="fa-solid fa-xmark fa-xl icon-align" ></i></span>

            </div>


            <div class="modal-body">
                <form id="updateProductForm" method="POST" action=""> @csrf
                    <div class="row my-1">
                        <div class="col-xs-4 h-100 m-0" style="display:block; justify-content: center;">
                            <h6 class="mt-2">Tên sản phẩm</h6>
                        </div>
                        <div class="col-xs-7 h-100 m-0">
                            <input maxlength="100" style="border-colorsetupBorderColor" id="productName"
                                name='productName' type="text" class="form-control h-100" value="" required/>
                        </div>
                    </div>

                    <div class="row my-1">
                        <div class="col-xs-4 h-100 m-0" style="display:block; justify-content: center;">
                            <h6 class="mt-2">Giá sản phẩm (&#8363;)</h6>
                        </div>
                        <div class="col-xs-7 h-100 m-0">
                            <input maxlength="100" style="border-colorsetupBorderColor" id="productPrice"
                                name='productPrice' type="number" class="form-control h-100" value="" required/>
                        </div>
                    </div>

                    <div class="row my-1">
                        <div class="col-xs-4 h-100 m-0" style="display:block; justify-content: center;">
                            <h6 class="mt-2">Giá sản phẩm (&#8363;)</h6>
                        </div>
                        <div class="col-xs-7 h-100 m-0">
                            <input maxlength="100" style="border-colorsetupBorderColor" id="productPoster"
                                name='productPoster' type="text" class="form-control h-100" value="" />
                        </div>
                    </div>
                    <div class="row my-1">
                        <div class="col-xs-4 h-100 m-0" style="display:block; justify-content: center;">
                            <h6 class="mt-2">Mô tả</h6>
                        </div>
                        <div class="col-xs-7 h-100 m-0">
                            <input maxlength="100" style="border-colorsetupBorderColor" id="productDes"
                                name='productDes' type="text" class="form-control h-100" value="" />
                        </div>
                    </div>

                    <div class="row my-1">
                        <div class="col-xs-4 h-100 m-0" style="display:block; justify-content: center;">
                            <h6 class="mt-2">Đánh giá</h6>
                        </div>
                        <div class="col-xs-7 h-100 m-0">
                            <input maxlength="100" style="border-colorsetupBorderColor" id="productStar"
                                name='productStar' type="range" class="h-100" value="" min="0" max="5" step="1"/>
                                <span id="starPreview"></span><span>/5<i class="fa-solid fa-star" style="color:orange;"></i></span>
                        </div>
                    </div>

                    <div class="row my-1">
                        <div class="col-xs-4 h-100 m-0" style="display:block; justify-content: center;">
                            <h6 class="mt-2">Tình trạng</h6>
                        </div>
                        <div class="col-xs-7 h-100 m-0">
                            <select style="border-colorsetupBorderColor" id="productStatus"
                                name='productStatus' class="form-control h-100">
                                <option value="{{PRODUCT_NONE_STATUS}}" label="Chọn trạng thái..." selected="selected"> Chọn trạng thái...</option>
                                <option value="{{PRODUCT_HOT_STATUS}}" > HOT</option>
                                <option value="{{PRODUCT_NEW_STATUS}}" > NEW</option>
                                <option value="{{PRODUCT_SALE_STATUS}}" > SALE</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="categoryConfirm" type="submit" class="btn modal-btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
    @section('style')
    <style>

        .modal-active {
            /* border-bottom: solid 3px #1d8daf; */
            color: white;
            background-color: #1d8daf;
            border-top-right-radius: 8px 8px;
            border-top-left-radius: 8px 8px;
        }

        .modalTitle {
            float: left;
            margin: 0px;
            padding: 10px 10px 0px;
        }

        .modalTitle:hover {
            transition: 0.4s;
            cursor: pointer;
            color: white;
            /* border-bottom: solid 3px #1d8daf; */
            background-color: #1d8daf;
            border-top-right-radius: 8px 8px;
            border-top-left-radius: 8px 8px;

        }

        .select2-dropdown {
            z-index: 2000;
        }


        @media screen and (min-width : 1020px) and (max-width: 5000px) {
            .modal-header {
                padding: 10px 20px 0px;
            }
        }


        @media screen and (min-width : 820px) and (max-width: 1020px) {
            .modal-header {
                padding: 10px 20px 0px;
            }
        }


        @media screen and (min-width : 450px) and (max-width: 820px) {
            .modal-header {
                padding: 10px 0px 10px 5px;
            }
        }


        @media screen and (max-width: 450px) {
            .modal-header {
                padding: 10px 0px 10px 5px;
            }
        }
    </style>
    @endsection
</div>
{{-- @section('script')
<script type="text/javascript">


</script>
@endsection --}}
