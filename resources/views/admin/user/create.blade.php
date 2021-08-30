@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.user.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <form action="{{route('admin.user.store')}}" method="post">
                @csrf
                @if(!empty($msg)) {!! $msg !!} @endif
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{request()->input('username') ?? old('username')}}">
                    @error('username') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror ">
                    @error('password') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror ">
                    @error('password_confirmation') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror " value="{{request()->input('email') ?? old('email')}}">
                    @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="">-- Choose Role --</option>
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">Editor</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{$message}}</div> @enderror
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
