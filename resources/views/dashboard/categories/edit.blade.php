@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
@endif

@if (session()->has('message'))
<div class="alert alert-{{ session('alert-type') }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Alert!</h5>
    {{ session('message') }}
</div>
@endif

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @include('dashboard.categories._form',[
        'button'=>'Update',
        'button2' => 'Cansel Update'
        ])
    </form>
@endsection
