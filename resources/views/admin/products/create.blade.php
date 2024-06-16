@extends('admin.layouts.master')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-4">
                                    <div class="mb-3">
                                        <label for="basiInput" class="form-label">Name </label>
                                        <input type="text" class="form-control" name="name" id="basiInput">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sku" class="form-label">SKU </label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ strtoupper(Str::random(8)) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="price_regular" class="form-label">Price price_regular </label>
                                        <input type="number" value="0" class="form-control" name="price_regular"
                                            id="price_regular">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_sale" class="form-label">Price sale </label>
                                        <input type="number" value="0" class="form-control" name="price_sale"
                                            id="price_sale">
                                    </div>
                                    <div class="mb-3">
                                        <label for="catelogue_id" class="form-label">Catelogues</label>
                                        <select class="form-select mb-3" aria-label="Default select example"
                                            name="catelogue_id" id="catelogue_id">
                                            @foreach ($catelogues as $id => $value)
                                                <option value="{{ $id }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="img_thumbnail" class="form-label">hình ảnh </label>
                                        <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail">
                                    </div>

                                </div>

                                <div class="col-xxl-3 col-md-8">
                                    <div class=" d-flex justify-content-between mb-3">
                                        <div class="form-check form-switch form-switch-secondary">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                                id="is_active" checked>
                                            <label class="form-check-label" for="is_active">Is Active</label>
                                        </div>
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_hot_deal" id="is_hot_deal" checked>
                                            <label class="form-check-label" for="is_hot_deal">Is Hot Deal</label>
                                        </div>
                                        <div class="form-check form-switch form-switch-danger">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_good_deal" id="is_good_deal" checked>
                                            <label class="form-check-label" for="is_good_deal">Is Good Deal</label>
                                        </div>
                                        <div class="form-check form-switch form-switch-warning">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_new"
                                                id="is_new" checked>
                                            <label class="form-check-label" for="is_new">Is New</label>
                                        </div>
                                        <div class="form-check form-switch form-switch-info">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_show_home" id="is_show_home" checked>
                                            <label class="form-check-label" for="is_show_home">Is Show Home</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="material" class="form-label">Material</label>
                                            <textarea class="form-control" name="material" id="material" rows="2"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="user_manual" class="form-label">User Manual</label>
                                            <textarea class="form-control" name="user_manual" id="user_manual" rows="2"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="content"></textarea>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 300px; overflow: scroll">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-12">

                                    <table class="text-center table">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Quantity</th>
                                                <th>Gallergy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizes as $sizeID => $sizeName)
                                                @foreach ($colors as $colorID => $colorName)
                                                    <tr>
                                                        <td>{{ $sizeName }}</td>
                                                        <td class="">
                                                            <div class="m-auto"
                                                                style="width: 50px; height: 30px; background:{{ $colorName }};">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                                class="form-control" id="">
                                                        </td>
                                                        <td>
                                                            <input type="file"
                                                                name="product_variants[{{ $sizeID . '-' . $colorID }}][image]"
                                                                class="form-control">
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>


                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-4">
                                    <div class="mb-3">
                                        <label for="gallergy_1" class="form-label">Gallergy 1</label>
                                        <input type="file" class="form-control" name="gallergies[]" id="gallergy_1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gallergy_2" class="form-label">Gallergy 2</label>
                                        <input type="file" class="form-control" name="gallergies[]" id="gallergy_2">
                                    </div>





                                </div>


                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tag</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-4">
                                    <div class="col-lg-12">
                                        <label for="tags" class="fw-semibold">Tag</label>
                                        <select class="js-example-basic-multiple" id="tags" name="tags[]"
                                            multiple="multiple">
                                            @foreach ($tags as $id => $value)
                                                <option value="{{ $id }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>





                                </div>


                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div><!-- end card header -->

                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection

@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
