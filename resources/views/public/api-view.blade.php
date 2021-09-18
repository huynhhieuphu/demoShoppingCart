<table class="table table-bordered table-sm">
    <thead>
    <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->status}}</td>
            <td>
                <a href="{{route('api.category.destroy', ['id' => $category->id])}}"
                   class="btn btn-danger btn-sm btnDelete">delete</a>
                <a href="{{route('api.category.show', ['id' => $category->id])}}" class="btn btn-info btn-sm btnEdit">edit</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
