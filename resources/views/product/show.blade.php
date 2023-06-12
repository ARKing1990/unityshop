@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Product</h1>

            <a class="btn btn-primary mb-2" href="{{ route('product.create') }}" role="button">Create New</a>

            <div class="card mb-4">
                <div class="card-body">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Nama</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp. {{ number_format($product->price, 0, 2) }}</td>
                                    <td>Rp. {{ number_format($product->sale_price, 0, 2) }}</td>
                                    <td>
                                        @if ($product->image == null)
                                            <span class="badge bg-primary">No Image</span>
                                        @else
                                            <img src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 50px">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->status == 'Accepted')
                                            <span class="badge bg-success">{{ $product->status }}</span>
                                        @elseif ($product->status == 'Pending')
                                            <span class="badge bg-primary">{{ $product->status }}</span>
                                        @elseif ($product->status == 'Reject')
                                            <span class="badge bg-danger">{{ $product->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-grid gap d-md-flex justify-content-md-start">
                                            @if ($product->status == 'Pending')
                                                <form method="POST" action="{{ route('product.accept', $product->id) }}">
                                                    @csrf
                                                    <button class="btn btn-success me-md-2" type="submit">Accept</button>
                                                </form>
                                            @endif
                                            @if ($product->status == 'Pending')
                                                <form method="POST" action="{{ route('product.reject', $product->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                            @endif
                                          </div>
                                    </td>
                                    <td>
                                        <form onsubmit="return confirm('Are you sure? ');" action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
