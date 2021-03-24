<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

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
//    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:employee')->except('logout');
    }



    public function showUserLoginForm()
    {
        return view('auth.login', ['url' => 'user']);
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/users');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showEmployeeLoginForm()
    {
        return view('auth.login', ['url' => 'employee']);
    }

    public function employeeLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/employees');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    protected function attemptLogin(Request $request)
    {
        $customerAttempt = Auth::guard('user')->attempt(
            $this->credentials($request), $request->has('remember')
        );
        if(!$customerAttempt){
            return Auth::guard('employee')->attempt(
                $this->credentials($request), $request->has('remember')
            );
        }
        return $customerAttempt;
    }
    public function login(Request $request)
    {

        $validator = $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|string'
        ]);


        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.users.index'));
        } //attempt to log the seller in
        else if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('employee.profile.index'));
        }

        // if Auth::attempt fails (wrong credentials) create a new message bag instance.
        $errors = new MessageBag(['password' => ['Adresse email et/ou mot de passe incorrect.']]);
        // redirect back to the login page, using ->withErrors($errors) you send the error created above
        return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'password'));
    }
}
