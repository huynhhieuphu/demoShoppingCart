@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.banner.create')}}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <!-- Topbar Search -->
            @if(!empty(session('msg'))) {!! session('msg') !!} @endif
            <form
                class="d-sm-inline-block form-inline navbar-search float-sm-right">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="Search for..."
                           aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                <tr>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td width="12%">
                            <img src="{{asset('asset/uploads/banners/'. $banner->images)}}" alt="{{$banner->images}}" class="img-fluid">
                        </td>
                        <td width="20%">{{$banner->name}}</td>
                        <td>{{$banner->link}}</td>
                        <td width="8%">
                            @if($banner->status == 1)
                                <span class="badge badge-success">Enable</span>
                            @elseif($banner->status == 0)
                                <span class="badge badge-secondary">Disable</span>
                            @endif
                        </td>
                        <td colspan="2" width="12%">
                            <form action="{{route('admin.banner.delete', ['id' => $banner->id])}}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm"
                                        onclick="return confirm('are you sure?')">Active
                                </button>
                                <a href="{{route('admin.banner.edit', ['id' => $banner->id])}}"
                                   class="btn btn-info btn-sm">Edit</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$banners->links()}}
        </div>
    </div>
@endsection
