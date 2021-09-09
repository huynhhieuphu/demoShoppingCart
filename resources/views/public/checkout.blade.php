@extends('public.master-layout')

@section('content')
    <!-- checkout section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4"><i class="bi bi-bag-check"></i> Checkout</h2>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <form action="{{route('checkout.checkout')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="full_name">Người nhận</label>
                            <input type="text" name="full_name" id="full_name"
                                   class="form-control @error('full_name') is-invalid @enderror"
                                   value="{{auth('cus')->user()->first_name}} {{auth('cus')->user()->last_name}}">
                            @error('full_name')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ nhận</label>
                            <input type="text" name="address" id="address"
                                   class="form-control @error('address') is-invalid @enderror "
                                   value="{{auth('cus')->user()->address}}">
                            @error('address')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">SĐT Liên hệ</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror "
                                   value="{{auth('cus')->user()->phone}}">
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" rows="6"
                                      class="form-control @error('email') is-invalid @enderror ">{{old('note')}}</textarea>
                            @error('note')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Thanh toán</button>
                    </form>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-end">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart->items as $item)
                                <?php
                                $total = $item['quantity'] * $item['price'];
                                ?>
                                <tr>
                                    <td>{{$item['name']}}</td>
                                    <td class="text-end">{{$item['quantity']}}</td>
                                    <td class="text-end">{{number_format($total)}} VND</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="text-end"><strong>Total</strong></td>
                                <td class="text-end"><strong>{{$cart->totalQuantity}}</strong></td>
                                <td class="text-end"><strong>{{number_format($cart->totalPrice)}} VND</strong></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
