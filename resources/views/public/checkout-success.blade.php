@extends('public.master-layout')

@section('content')
    <!-- cart section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <h2 class="fw-bolder mb-4">Thông Báo Thanh Toán</h2>
                    @if(!empty($msgCheckout)) {!! $msgCheckout !!} @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $item)
                    <?php
                    $images = json_decode($item->images);
                    $image = array_shift($images);
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                        @if($item->sale_price)
                            <!-- Sale badge-->
                                <div class="badge bg-danger text-white position-absolute"
                                     style="top: 0.5rem; right: 0.5rem">Sale
                                </div>
                            @else
                                <div class="badge bg-primary text-white position-absolute"
                                     style="top: 0.5rem; right: 0.5rem">News
                                </div>
                        @endif
                        <!-- Product image-->
                            <a href="{{route('home.product', ['slug' => $item->slug])}}"><img class="card-img-top"
                                                                                              src="{{asset('asset/uploads/images/'.$image)}}"
                                                                                              alt="{{$image}}"/></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$item->name}}</h5>
                                    <!-- Product price-->
                                    <div
                                        class=" @if($item->sale_price) text-muted text-decoration-line-through @endif">{{number_format($item->price)}}
                                        VND
                                    </div>
                                    @if($item->sale_price) <span class="text-danger">{{number_format($item->sale_price)}} VND</span> @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                            href="{{route('cart.add', ['id' => $item->id])}}">Add
                                        Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
