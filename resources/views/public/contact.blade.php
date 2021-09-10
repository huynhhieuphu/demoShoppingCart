@extends('public.master-layout')

@section('content')
    <!-- checkout section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4"><i class="bi bi-envelope"></i> Liên hệ</h2>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <form action="{{route('home.send.mail')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="sender">Người Gửi</label>
                            <input type="text" name="sender" id="sender"
                                   class="form-control @error('sender') is-invalid @enderror"
                                   value="{{old('sender')}}">
                            @error('sender')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email gửi</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror "
                                   value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="messages">Nội dung</label>
                            <textarea name="messages" id="messages" rows="6"
                                      class="form-control @error('messages') is-invalid @enderror">{{old('messages')}}</textarea>
                            @error('messages')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
