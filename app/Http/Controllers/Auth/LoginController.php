<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\validateCredentials;
use App\Models\Vista;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        

        return 'email';
    }
    
    public function logout(){
        Auth::logout();
        session()->invalidate();
        return redirect()->route('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('');
        }
        
    }
    function redirectTo()
    {    
        $cadena = "";
        
        $user_user = $_POST['email'];
        $password = $_POST['password'];
        $dato = 0;
        $verificar = Vista::verificar($user_user);
        if(!empty($verificar)){
            
            foreach ($verificar as $val) {
                session(['usuario' => $val->email]);
                session(['id' => $val->id]);
            }
            $dato = 1;
            return route('inicio');   
        }      
        
        if($dato == 0){
            echo '<script>alert("Este usuario no cuenta con acceso.");window.location("http://127.0.0.1:8000/");</script>';    
        }
            
    }
}
