@extends('admin.dashboard')

@section('title', 'All Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="card  text-center " style="margin-left: 5px">
        <h1> <i class="bi bi-list"></i> Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success w-50 mb-3" >
            <i class="bi bi-plus-circle"></i> Create New Category
        </a>
        
   

    <table class="table " >
        <thead class="bg-secondary text-white">
            <tr class="table-info">
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr class="bg-light ">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" width="70" height="67" alt="" class="rounded-circle d-block mx-auto  "></td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info  ">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
