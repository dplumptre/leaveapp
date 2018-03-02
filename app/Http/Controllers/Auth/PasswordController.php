<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;
use DB;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }




    public function reset(Request $request)
    {
        $this->validate($request, [
			'token' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
			]);



    //    Verifying token


          $r =   $tokenData = DB::table('password_resets')
                              ->where('email', $request->email)
                              ->where('token',$request->token)->first();


        if($r){
         //updating password   
         $user = User::where('email',$request->email)->first();
         $user->password = bcrypt($request->password);
         $user->update();

         session()->flash('flash_message', 'Password reset  was successfull!');
         session()->flash('flash_type', 'alert-success');
        } else{
            session()->flash('flash_message', 'Password reset  was unsuccessfull!');
            session()->flash('flash_type', 'alert-danger');         
        }                     


        return back();	
	
    }













}
