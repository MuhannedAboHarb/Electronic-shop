@extends('layouts.dashboard')

@section('title' , 'Profile Update')

@section('content')
    

    <p>
        <a href="{{ route('change-password') }}">Change Password</a>
    </p>

    <x-flash-message />

    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <x-form.input name="first_name" :value=" $user->profile->first_name " lable="First Name" />    
                </div>        
            </div>

            <div class="col-6">
                <div class="form-group">
                    <x-form.input name="last_name" :value=" $user->profile->last_name " lable="Last Name" />    
                </div>   
            </div>
        </div>

        <div class="form-group">
            <x-form.input name="name" :value=" $user->name " lable="Display Name" />    
        </div>

        <div class="form-group">
            <x-form.input name="email" :value=" $user->email " lable="Email Address" />
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <x-form.input type="date"  name="birthday" :value=" $user->profile->birthday " lable="Birthday" />    
                </div>        
            </div>

            <div class="col-6">
                <div class="form-group">
                    <x-form.lable>Gender</x-form.lable>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" @if($user->profile->gender == 'male') checked @endif>
                            <label class="form-check-label" for="male">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" @if($user->profile->gender == 'female') checked @endif>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>    
                </div>   
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <x-form.input  name="city" :value=" $user->profile->city " lable="City" />    
                </div>        
            </div>

            <div class="col-6">
                <div class="form-group">
                    <x-form.textarea  name="address" :value=" $user->profile->address " lable="Address" />    
                </div>        
            </div>

            <div class="col-6">
                <div class="form-group">
                    <x-form.lable>Country</x-form.lable>
                    <select name="country_code" id="country_code" class="form-control">
                        <option value="">Select Country</option>
                        @foreach (Symfony\Component\Intl\Countries::getNames() as $code => $name )
                            <option value="{{ $code }}" @if($user->profile->country_code == $code) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>   
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <x-form.lable>Language</x-form.lable>  {{-- مقصود فيه ال لوكل --}}
                    <select name="locale" id="locale" class="form-control">
                        <option value="">Select Language</option>
                        @foreach (Symfony\Component\Intl\Locales::getNames() as $code => $name )
                            <option value="{{ $code }}" @if($user->profile->locale == $code) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>           
            </div>

            <div class="col-6">
                <div class="form-group">
                    <x-form.lable>Timezone</x-form.lable>
                    <select name="timezone" id="timezone" class="form-control">
                        <option value="">Select Timezone</option>
                        @foreach (Symfony\Component\Intl\Timezones::getNames() as $code => $name )
                            <option value="{{ $code }}" @if($user->profile->timezone == $code) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>   
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info"> Update </button>
        </div>   

    </form>



@endsection