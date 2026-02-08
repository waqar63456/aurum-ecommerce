@extends('admin.dashboard')

@section('title', 'All Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="card ms-1 text-center">
        <h1 class="text-center"><i class="bi bi-bag"></i> Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3" style="width: 200px " > <i class="bi bi-plus-circle"></i> Create New Product</a>
    

    <table class="table align-items-center">
        <thead class="bg-primary text-white"> <!-- Header with background color -->
            <tr class="table-info"> <!-- Light blue header row -->
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="bg-ligh align-items-centert "> <!-- Light gray background for rows -->
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                
                    <td>{{ $product->category->name }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" width="70" height="67" alt="$product->image" class="rounded-circle d-block mx-auto "></td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info ">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        
                    
                        <!-- Delete Button -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline; margin-top:2px;">
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
    
@endsection
