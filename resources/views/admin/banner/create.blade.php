@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.banner.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            @if(!empty($msg)) {!! $msg !!} @endif
            <form action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " value="{{old('name')}}">
                    @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror " value="{{old('link')}}">
                    @error('link') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Choose Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror ">
                    @error('image') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>
@endsection
