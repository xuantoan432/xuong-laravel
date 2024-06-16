@extends('admin.layouts.master')

@section('title')
    Danh sách danh mục sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-content-center">
                    <h5 class="card-title">Danh sách</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>IMG_THUMBNAIL</th>
                                <th>NAME</th>
                                <th>SKU</th>
                                <th>Catelogues</th>
                                <th>Price regular</th>
                                <th>Price sale</th>
                                <th>Views</th>
                                <th>Is Active</th>
                                <th>Is Hot Deal</th>
                                <th>Is Good Deal</th>
                                <th>Is New</th>
                                <th>Is Show Home</th>
                                <th>Tags</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @php
                                            $url = $item->img_thumbnail;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = \Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" width="100px">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->catelogue->name }}</td>
                                    <td>{{ $item->price_regular }} </td>
                                    <td> {{ $item->price_sale }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>{!! $item->is_active
                                        ? '<span class="badge bg-info-subtle text-info">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!} </td>
                                    <td>{!! $item->is_hot_deal
                                        ? '<span class="badge bg-info-subtle text-info">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!} </td>
                                    <td>{!! $item->is_good_deal
                                        ? '<span class="badge bg-info-subtle text-info">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!} </td>
                                    <td>{!! $item->is_new
                                        ? '<span class="badge bg-info-subtle text-info">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!} </td>
                                    <td>{!! $item->is_show_home
                                        ? '<span class="badge bg-info-subtle text-info">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!} </td>
                                    <td>
                                        @foreach ($item->tags as $tag)
                                            <span class="badge bg-success-subtle text-success">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->created_at }} </td>
                                    <td> {{ $item->updated_at }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="#!" class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        View</a></li>
                                                <li><a class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a></li>
                                                <li>
                                                    <form action="{{ route('admin.products.destroy', $item) }}" 
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item remove-item-btn"
                                                            onclick="return confirm('có chắc chắn k')"
                                                        >

                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </button>
                                                    </form>

                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example1", {
            order: [
                [0, 'desc']
            ]
        })
    </script>
@endsection
