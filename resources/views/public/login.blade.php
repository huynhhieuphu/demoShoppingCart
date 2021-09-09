@extends('public.master-layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                    @if(!empty(session('msg'))) {!! session('msg') !!} @endif
                    @if(!empty($msgLogin)) {!! $msgLogin!!} @endif
                     <form action="{{route('admin.customer.login')}}" method="POST">
                        @csrf
                        <legend>Đăng Nhập</legend>
                        <div class="mb-3">
                            <label for="username" class="form-label">Tài Khoản</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username">
                            @error('username')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        <a href="{{route('admin.customer.register.form')}}" class="text-decoration-none">Tạo tài khoản</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
