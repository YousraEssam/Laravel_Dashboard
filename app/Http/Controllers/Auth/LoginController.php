<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/home';
    protected $max_attempts = 2;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if(is_numeric($request->get($this->username()))){
            return [
                'phone'=>$request->get($this->username()),
                'password'=>$request->get('password')
            ];
        }
        else{
            return [
                'email' => $request->get($this->username()), 
                'password'=>$request->get('password')
            ];
        }
    }

        /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $key = $this->cache->get($this->throttleKey($request));
    
        if($key > $this->max_attempts){
            $this->cache->forget($this->throttleKey($request));
            
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
                'recaptcha' => 'No!!',
            ]);
        }else{
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }
}
