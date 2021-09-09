@extends('public.master-layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <form class="form" action="{{route('admin.customer.register')}}" method="POST">
                @csrf
                <div class="row gx-4 gx-lg-5">
                    @if(!empty($msgRegister)) {!! $msgRegister !!} @endif
                    <legend>Tạo tài khoản mới</legend>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-3">
                            <label for="username">Tên tài khoản</label>
                            <input type="text" name="username" id="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror ">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Lặp lại mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror ">
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Địa chỉ Email</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror " value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-3">
                            <label for="first_name">Tên</label>
                            <input type="text" name="first_name" id="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{old('first_name')}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name">Họ</label>
                            <input type="text" name="last_name" id="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{old('last_name')}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">SĐT</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{old('phone')}}">
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Nơi ở</label>
                            <input type="text" name="address" id="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{old('address')}}">
                            @error('address')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Đăng ký</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
