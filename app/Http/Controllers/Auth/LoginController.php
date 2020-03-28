<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;

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
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser);

        return redirect()->route('home');
    }

    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where($provider.'_id', $user->id)->first()) {
            return $authUser;
        }
        if ($authUser = User::where('email', $user->email)->first()) {
            $provider === 'github'? $authUser->github_id = $user->id : $authUser->google_id = $user->id;
            return $authUser->save();
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'github_id' => $user->id,
        ]);
    }
}
