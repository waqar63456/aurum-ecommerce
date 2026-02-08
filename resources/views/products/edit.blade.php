@extends('admin.dashboard')

@section('title', 'Edit Product')

@section('content')
<div class="card" style="margin-left: 5px">
    <h1 class="text-center">Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ asset('storage/' . $product->image) }}" width="50" height="50">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3"><i class="bi bi-check-circle"></i>  Update</button>
    </form>
</div>
@endsection
