@extends('admin.dashboard')

@section('title', 'Edit Category')

@section('content')
<div class="card" style="margin-left: 5px">
    <h1 class="text-center">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="form-group">
            <label for="image">Category Image:</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ asset('storage/' . $category->image) }}" width="50" height="50">
        </div>

        <button type="submit" class="btn btn-success mt-3"><i class="bi bi-check-circle"></i> Update</button>
    </form>
</div>
@endsection
