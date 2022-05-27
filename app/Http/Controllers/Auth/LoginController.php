<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {   
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'name';


        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }

    public function ApiLogin(Request $request){
        try {
            $name=$request->email;
            $password=$request->password;
            $user=User::where("name",$name)->first();
            if(Hash::check($password, $user->password)){
                return json_encode(["data"=>["api_token"=>$user->api_token],"code"=>200]);
            }
            else{
                return json_encode(["message"=>"Invalid Credentials","code"=>401]);
            }
    
        } catch (\Throwable $th) {
            return json_encode(["message"=>$th->getMessage(),"code"=>500]);
        }

    }
}
