<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $findUser = User::where('email', $user->email)->first();

        if ($findUser) {
            Auth::login($findUser, true);
        } else {
            $username = str_replace(" ", "", $user->name);
            $user = User::firstOrCreate([
                'email' => $user->email,
                'username' => $username,
            ], [
                'name' => $user->name,
                'password' => Hash::make(Str::random(24)),
                'username' => $username,
            ]);
            Auth::login($user, true);
        }
        return redirect('/');
    }

    public function GoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function GoogleRedirectCallback()
    {
        $user = Socialite::driver('google')->user();

        $findUser = User::where('email', $user->email)->first();

        if ($findUser) {
            Auth::login($findUser, true);
        } else {
            $username = str_replace(" ", "", $user->name);
            $user = User::firstOrCreate([
                'email' => $user->email,
                'username' => $username,
            ], [
                'name' => $user->name,
                'password' => Hash::make(Str::random(24)),
                'username' => $username,
            ]);
            Auth::login($user, true);
        }
        return redirect('/');
    }
}
