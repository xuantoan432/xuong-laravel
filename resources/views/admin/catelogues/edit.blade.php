@extends('admin.layouts.master')

@section('title')
    Sửa danh mục sản phẩm: {{ $model->name }}
@endsection

@section('content')
    <form action="{{ route('admin.catelogues.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="Name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="Name" placeholder="Enter Name" name="name" value="{{ $model->name }}">
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="cover" class="form-label">cover:</label>
                    <input type="file" class="form-control" id="cover" placeholder="Enter cover" name="cover">
                    <img src="{{ Storage::url($model->cover) }}" alt="" width="70">
                </div>
            </div>
        </div>
        
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                @if ($model->is_active)
                   checked
                @endif
                > Is active
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
