@extends('layouts.dashboard')
@section('title', $title)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item light">Categories</li>
@endsection

@section('content')

    <x-flash-message name="success" />

    <div class="table-toobar row mb-3 d-flex justify-content-between">

        <div>
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success">Create</a>
            <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-primary">Trash</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>description</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <img src="{{ $category->image_url }}" height="60">
                        </td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.categories.edit', [$category->id]) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
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
