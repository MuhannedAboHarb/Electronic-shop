@extends('layouts.dashboard')
@section('title', 'Edit Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Products</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @include('dashboard.products._form',[
        'button'=>'Update',
        'button2' => 'Cansel Update'
        ])
    </form>
@endsection
