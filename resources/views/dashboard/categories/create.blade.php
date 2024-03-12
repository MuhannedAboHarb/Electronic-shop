@extends('layouts.dashboard')
@section('title', 'Create Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    {{-- this is object --}}
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


    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @include('dashboard.categories._form', [
            'button' => 'Create',
            'button2' => 'Cansel Create',
        ])
    </form>
@endsection
