<?php

namespace ceeacce\Http\Controllers\Auth;

use ceeacce\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use ceeacce\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * User login.
     *
     * @param  Request  $request
     * @return User
     */
    protected function register(Request $request)
    {
        $data = $request->only(["email", "password","name", "remember"]);
        $rememberMe = $data['remember'];

        $user = new User;
        $user->name = $data['name'];
        $user->password = bcrypt($data['password']);
        $user->email = $data['email'];

        if($user->save()){
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']],$rememberMe)) {
                // Authentication passed...
                return redirect()->intended('dashboard');
            }
        }

        return redirect('user/register')->withInput($request->except('password'));

    }

    /**
     * User login.
     *
     * @param  Request  $request
     * @return User
     */
    protected function logIn(Request $request)
    {
        $data = $request->only(["email", "password"]);
        $rememberMe = $request->has('remember');

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']],$rememberMe)) {
            // Authentication passed...
            return redirect()->intended('dashboard')->with('remember', $rememberMe);
        }
        return redirect('login')->withInput($request->except('password'));

    }

}
