@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.product.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if(!empty($msg)) {!! $msg !!} @endif
            <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <div class="form-group">
                            <label for="name">Product</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="5" style="resize: none">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="images[]">Choose file</label>
                            <input type="file"
                                   class="form-control @if($errors->has('images') || $errors->has('images.*')) is-invalid @endif"
                                   id="images[]" name="images[]" multiple>
                            @if($errors->has('images'))
                                <div class="invalid-feedback">{{$errors->first('images')}} </div>
                            @elseif($errors->has('images.*'))
                                <div class="invalid-feedback">{{$errors->first('images.*')}} </div>
                            @endif
                        </div>
                    </div> {{-- end .col-12.col-sm-12.col-md-8.col-lg-8.col-xl-8 --}}
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-- choose a category --</option>
                                {{showCategories($categories)}}
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price"
                                   class="form-control @error('price') is-invalid @enderror" min="0"
                                   value="{{old('price')}}">
                            @error('price')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="sale_price">Sale</label>
                            <input type="number" name="sale_price" id="sale_price"
                                   class="form-control @error('sale_price') is-invalid @enderror" min="0"
                                   value="{{old('sale_price')}}">
                            @error('sale_price')
                            <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity"
                                   class="form-control @error('quantity') is-invalid @enderror" min="0" max="100"
                                   value="{{old('quantity')}}">
                            @error('quantity')
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
                        <button type="submit" class="btn btn-success">Add</button>
                    </div> {{-- end .col-12.col-sm-12.col-md-4.col-lg-4.col-xl-4 --}}
                </div> {{-- end .row --}}
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        // Replace the <textarea id="description"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('description', options);
    </script>
@endpush
