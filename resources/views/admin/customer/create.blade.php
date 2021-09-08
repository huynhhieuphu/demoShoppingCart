@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.customer.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form action="{{route('admin.customer.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        @if(!empty($msg)) {!! $msg !!} @endif
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror ">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror ">
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror " value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>

                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{old('first_name')}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{old('last_name')}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">phone</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{old('phone')}}">
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{old('address')}}">
                            @error('address')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status: </label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="enable" class="form-check-input" value="1"
                                       checked>
                                <label for="enable" class="form-check-label">Enable</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="disable" class="form-check-input" value="0">
                                <label for="disable" class="form-check-label">Disable</label>
                            </div>
                            @error('status')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>

                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
