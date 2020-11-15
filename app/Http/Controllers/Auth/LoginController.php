<?php

 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 
class LoginController extends Controller
{
   
    use AuthenticatesUsers;
 
    protected $redirectTo = '/home';
 
    protected $username;
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
 
        $this->username = $this->findUsername();
    }
 
    public function findUsername()
    {
        $username = request()->input('username'); 
     
        if($fieldType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username')

        {
             request()->merge([$fieldType => $username]); 
             return $fieldType;
        }else{
            return redirect()->route('login');            
        }
    }
 
    public function username()
    {
        return $this->username;
    }
}