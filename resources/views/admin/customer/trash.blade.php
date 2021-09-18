@extends('admin.layout-main')

@section('title', $title)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>

        <a href="{{route('admin.customer.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <!-- Topbar Search -->
            @if(!empty(session('msg'))) {!! session('msg') !!} @endif
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
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->username}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>
                            @if($customer->status == 1)
                                <span class="badge badge-success">Enable</span>
                            @elseif($customer->status == 0)
                                <span class="badge badge-secondary">Disable</span>
                            @endif
                        </td>
                        <td colspan="2">
                            <a href="{{route('admin.customer.delete.immediately', ['id' => $customer->id])}}"
                               class="btn btn-danger btn-sm btnDelete">Delete</a>
                            <a href="{{route('admin.customer.put.back', ['id' => $customer->id])}}"
                               class="btn btn-info btn-sm btnRestore">Restore</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.btnRestore', function (e) {
            e.preventDefault();
            if (confirm('Ban co chac phuc hoi ?')) {
                $.post($(this).attr('href'), {'_token': '{{csrf_token()}}'}, function (res) {
                    if (res.code === 200) {
                        alert(res.message);
                        window.location.href = res.url;
                    } else {
                        alert(res.message);
                    }
                });
            }
            return false;
        })

        $(document).on('click', '.btnDelete', function (e) {
            e.preventDefault();
            if (confirm('Ban co chac xoa vinh vien ?')) {
                $.post($(this).attr('href'), {'_token': '{{csrf_token()}}', '_method' : 'DELETE'}, function (res) {
                    if (res.code === 200) {
                        alert(res.message);
                        window.location.href = res.url;
                    } else {
                        alert(res.message);
                    }
                });
            }
            return false;
        })
    </script>
@endpush
