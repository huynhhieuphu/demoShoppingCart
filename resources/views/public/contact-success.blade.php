@extends('public.master-layout')

@section('content')
    <!-- cart section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <h2 class="fw-bolder mb-4">Thông Báo Liên Hệ</h2>
                    @if(!empty($msgContact)) {!! $msgContact !!} @endif
                </div>
            </div>
        </div>
    </section>
@endsection
