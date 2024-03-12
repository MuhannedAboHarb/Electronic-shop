<head>
    <style>
        /* تنسيق الأسعار */
        .product-price {
            font-size: 18px;
            color: #f3eeee;
            font-weight: bold;
        }

        .compare-price {
            font-size: 15px;
            color: #d52020;
            text-decoration: line-through;
        }
    </style>
</head>

@extends('layouts.dashboard')
@section('title', 'Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item light">Products</li>
@endsection

@section('content')

    <x-flash-message name="success" />

    <div class="table-toobar row mb-3 d-flex justify-content-between">

        <div>
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-success">Create</a>
            <a href="{{ route('dashboard.products.trash') }}" class="btn btn-primary">Trash</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>SKU</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->image_url }}" height="60">
                        </td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category_id }}</td>

                        <td>
                            <span class="product-price">{{ number_format($product->price) }}</span> |
                            @if ($product->compare_price)
                                <span class="compare-price">
                                    <del>{{ $product->compare_price }}</del>
                                </span>
                            @endif
                        </td>


                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.products.edit', [$product->id]) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
