@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.product.create')}}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <!-- Topbar Search -->
            @if(!empty($msg)) {!! $msg !!} @endif
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
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Images</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 0; ?>
                    @foreach($products as $product)
                        <?php
                            $no++;
                            $images = json_decode($product->images);
                            $image = array_shift($images);
                        ?>
                        <tr>
                            <td width="6%">{{$no}}</td>
                            <td width="10%">
                                <img src="{{asset('asset/uploads/images/'.$image)}}" alt="{{$image}}" class="img-fluid">
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{number_format($product->price)}}</td>
                            <td>{{number_format($product->sale_price)}}</td>
                            <td width="6%">{{$product->quantity}}</td>
                            <td>{{$product->category->name}}</td>
                            <td width="6%">
                                @if($product->status == 1)
                                    <span class="badge badge-success">Enable</span>
                                @elseif($product->status == 0)
                                    <span class="badge badge-secondary">Disable</span>
                                @endif
                            </td>
                            <td colspan="2" width="16%">
                                <form action="{{route('admin.product.destroy', ['product' => $product->id])}}"
                                      method="post" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">Delete</button>
                                    <a href="{{route('admin.product.edit', ['product' => $product->id])}}"
                                       class="btn btn-info btn-sm">Edit</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div> {{-- end .table-responsive --}}
            {{$products->links()}}
        </div> {{-- end .col-12.col-sm-12.col-md-12.col-lg-12.col-xl-12 --}}
    </div> {{-- end .row --}}
@endsection
