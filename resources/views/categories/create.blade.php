@extends('admin.dashboard')

@section('title', 'Create Category')

@section('content')
<div class="card    " style="margin-left: 5px">
    <h2 class="text-center">Create New Category</h2>
<div class="d-flex justify-content-center">
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Category Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3 "><i class="bi bi-check-circle"></i>  Create</button>
    </form>
</div>
</div>
@endsection
