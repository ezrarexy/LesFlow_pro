<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function in(Request $req)
    {
       $pej = app()->make('stdClass');

        $pej->name = 'Login';
        $pej->link = 'login';


        $res = \DB::table('users')->where('email','=',$req->email)->first();
        if (count((array)$res)>0) {
            if (\Auth::attempt(['email'=>$req->email,'password'=>$req->password])) {
                
                $jabat = Role::find(\Auth::user()->id_role,['link'])->link;

                \Auth::user()->jabatan = $jabat;

                return redirect('/');
            }else {
                return view('/auth/login')->with('pej',$pej)->with('err','Password Salah')->with('email',$req->email);
            }
        } else{
            return view('/auth/login')->with('pej',$pej)->with('err','eMail Tidak Valid!');
        }
    }


    public function logout(Request $request) {
        \Auth::logout();
        return redirect('/');
    }


}
