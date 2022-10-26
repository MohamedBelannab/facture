<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;




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
    // protected function credentials(\Illuminate\Http\Request $request)
    // {

    //     return ['email' => $request->email, 'password' => $request->password, 'status' => 'مفعل']; 
    
    // }
    public function redirectToprovider($social){
        return Socialite::driver($social)->stateless()->redirect();
    }
    public function callback($social){
        $user = Socialite::driver($social)->stateless()->user();

        $this->_registerOrLogin($user);

        return  redirect('/home');

        
        

       
    }
    protected function _registerOrLogin($data){
        $user = User::where('email' , $data->email)->first();
        $token = $data->token;
        $id = $data->getId();
        $name = $data->getName();
        $email = $data->getEmail();

        if(!$user){
            

            $userApi = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => Carbon::now(),
                'remember_token' => $token,
                'password' => Hash::make($email),
                'roles_name' => ["user"],
                'avatar' => $data->avatar,
                'status' => 'غير مفعل'
                
                
            ]);
          
            $userApi->assignRole('user');
            

        }
        Auth::login($user);
       
    }
}
