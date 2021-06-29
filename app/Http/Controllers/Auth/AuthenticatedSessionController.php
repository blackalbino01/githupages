<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        //$request->session()->regenerate();

        return view('google2fa.index');

        //return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function verifysecret(Request $request){
        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');

        $secret = $request->one_time_password;
        $valid = $google2fa->verifyKey($user->secret, $secret);

        if($valid){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            return redirect('google2fa.index')->withErrors(['status','Invalid verification Code,Please try again.']);
        }
    }
}
