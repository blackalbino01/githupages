<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        $request->merge(session('user'));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'secret' => $request->secret,
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect(RouteServiceProvider::LOGIN);
    }

    public function preRegister(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $google2fa = app('pragmarx.google2fa');

        $user = array_merge(['secret' => $google2fa->generateSecretKey()],$request->all());

        $request->session()->flash('user', $user);

        $QR_Image = $google2fa->getQRCodeInline( config('app.name'),$user['email'], $user['secret']);

        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $user['secret']]);
        
    }
}
