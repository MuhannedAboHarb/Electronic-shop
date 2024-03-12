@extends('layouts.dashboard')

@section('title' , 'Change Password')

@section('content')
    

    <x-flash-message />

    <form action="{{ route('change-password.update') }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <x-form.input type="password" name="password" lable="Current Password" />    
        </div>

        <div class="form-group">
            <x-form.input type="password" name="new_password" lable="New Password" />
        </div>

        <div class="form-group">
            <x-form.input type="password" name="new_password_confirmation" lable="Confirm Password" />
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-info"> Change Password </button>
        </div>   

    </form>



@endsection