<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        //$profile = $user->profile;

        return view( 'auth.user-profile' ,[
            'user' => $user
        ]);
    }


    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'first_name' => ['required' , 'string' , 'max:100'] ,
            'last_name' => ['required' , 'string' , 'max:255'] ,
            'name' => ['required' , 'string' , 'max:100'] ,
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ] , 

            'birthday' => 'date|before:today' , 
            'gender' => 'in:male,female'
        ]);
        
        $user->update($request->all());

        $profile =  $user->profile;
        $request->merge([
            'user_id' => $user->id
        ]);
        if(!$profile->exists) {
            $profile = Profile::create($request->all());
        } else {
            $profile->update($request->all());
        }

        return redirect()
        ->route('profile')
        ->with('success' , 'Profile Updated !!');
    }

}
