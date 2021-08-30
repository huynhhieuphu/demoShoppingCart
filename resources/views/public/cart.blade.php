@extends('public.master-layout')

@section('content')
    <!-- cart section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4"><i class="bi bi-cart4"></i> Cart</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Images</td>
                        <td>Product</td>
                        <td>Quantity</td>
                        <td class="text-end">Price</td>
                        <td class="text-end">Total</td>
                        <td width="3%"></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php($no = 0)
                    @foreach($cart->items as $item)
                        <?php
                        $no++;
                        $total = $item['quantity'] * $item['price'];
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td width="12%"><img src="{{asset('asset/uploads/images/'.$item['images'])}}"
                                                 alt="{{$item['images']}}" class="img-fluid"></td>
                            <td>{{$item['name']}}</td>
                            <td width="5%">
                                <form action="{{route('cart.update', ['id' => $item['id']])}}" method="get">
                                    @csrf
                                    <input type="text" value="{{$item['quantity']}}" size="6" name="quantity">
                                    <button class="btn btn-primary btn-sm mt-2" type="submit">Update</button>
                                </form>
                            </td>
                            <td class="text-end" width="16%">{{number_format($item['price'])}} VND</td>
                            <td class="text-end" width="16%">{{number_format($total)}} VND</td>
                            <td>
                                <a href="{{route('cart.remove', ['id' => $item['id']])}}" class="btn btn-danger"
                                   onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><h4>Total</h4></td>
                            <td colspan="2" class="text-end"><h4>{{number_format($cart->totalPrice)}} VND</h4></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <a href="{{route('home.index')}}" class="btn btn-primary">Buy more</a>
            <a href="{{route('cart.clear')}}" class="btn btn-danger">Clear all</a>
            <a href="#" class="btn btn-success">Check out</a>

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
