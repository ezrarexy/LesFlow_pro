<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;
class ResetPasswordController extends Controller
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
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    function CheckPass(Request $req){
        $id = Auth::user()->id;

        $user = User::find($id);

        if (Hash::check($req->oldPass, $user->password)) {
            return response(['status' => 'ok']);
        } else {
            return response(['status' => 'fail','msg'=>'Password lama salah!']);
        }        
    }

    function ChangePass(Request $req){
        $id = Auth::user()->id;

        try {
            $user = User::find($id);

            $user->password = Hash::make($req->password);

            $user->save();
        } catch (Throwable $th) {
            return response(['status' => 'fail', 'msg' => json_encode($th)]);
        }

        return response(['status' => 'ok', 'msg' => 'Password berhasil diganti!']);
    }

}
