@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.category.create')}}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
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
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php($count = ($categories->currentpage() - 1) * $categories->perpage())
                @foreach($categories as $category)
                    @php($count++)
                    <tr>
                        <td width="6%">{{$count}}</td>
                        <td>{{$category->name}}</td>
                        <td width="16%">
                            {{$category->parent_id}}
                        </td>
                        <td width="8%">{{$category->child->count()}}</td>
                        <td width="8%">
                            @if($category->status == 1)
                                <span class="badge badge-success">Enable</span>
                            @elseif($category->status == 0)
                                <span class="badge badge-secondary">Disable</span>
                            @endif
                        </td>
                        <td colspan="2" width="12%">
                            <form action="{{route('admin.category.destroy', ['category' => $category->id])}}"
                                  method="post" class="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('are you sure?')">Delete
                                </button>
                                <a href="{{route('admin.category.edit', ['category' => $category->id])}}"
                                   class="btn btn-info btn-sm">Edit</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$categories->links()}}
        </div>
    </div>
@endsection
