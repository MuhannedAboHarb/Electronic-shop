@extends('layouts.dashboard')
@section('title', 'Create Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Product</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @include('dashboard.products._form', [
            'button' => 'Create',
            'button2' => 'Cansel Create'
        ])
    </form>
@endsection
