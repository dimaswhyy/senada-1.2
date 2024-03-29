<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::guard('account_super_admin')->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            return redirect('/dashboard');

        }else if(Auth::guard('account_sekolah')->attempt(array('email' => $input['email'], 'password' => $input['password']))){
            return redirect('/dashboard');

        }else if(Auth::guard('peserta_didik')->attempt(array('email' => $input['email'], 'password' => $input['password']))){
            return redirect('/dashboard');

        }else{
            return redirect()->route('login')
                ->with('error','Email dan Kata Sandi yang Anda Masukkan Salah!');
        }

    }
}
