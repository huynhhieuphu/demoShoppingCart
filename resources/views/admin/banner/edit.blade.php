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
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if(!empty($msg)) {!! $msg !!} @endif
            <form action="{{route('admin.banner.update', ['id' => $banner->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " value="{{request()->input('name') ?? $banner->name}}">
                            @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror " value="{{request()->input('link') ?? $banner->link}}">
                            @error('link') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Choose Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror ">
                            @error('image') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <img src="{{asset('asset/uploads/banners/'. $banner->images)}}" alt="{{$banner->images}}" class="img-fluid">
                        <input type="hidden" name="image_old" value="{{$banner->images}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
