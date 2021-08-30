@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.category.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <form action="{{route('admin.category.store')}}" method="post">
                @csrf
                @if(!empty($msg)) {!! $msg !!} @endif
                <div class="form-group">
                    <label for="name">Category</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror ">
                    @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                        <option value="">-- choose a category --</option>
                        <option value="0">Root</option>
                        {{showCategories($parents)}}
                    </select>
                    @if($errors->has('parent_id'))
                        <div class="invalid-feedback">{{$errors->first('parent_id')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Status: </label>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="status" id="enable" class="form-check-input" value="1" checked>
                        <label for="enable" class="form-check-label">Enable</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="status" id="disable" class="form-check-input" value="0">
                        <label for="disable" class="form-check-label">Disable</label>
                    </div>
                    @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>
@endsection
