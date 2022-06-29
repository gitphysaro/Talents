<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\dashboardController;
use Alert;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;


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
    //protected $redirectTo = 'dashboard';


    public function login(Request $request)
    {
        //dd($request->all());
        $credentials = $request->only('login', 'password');
        $login=$request->input('login');
        $password=$request->input('password');

        $verifActif=DB::table("Employe")
        ->where('CRC_Agents_Id',$login)
        ->select('Actif')->get();
        $actif=2;
        foreach ($verifActif as $value) {
            $actif=$value->Actif;
        }
if($actif==0){
       // if (Auth::attempt(['login' => $login, 'password' => $password, 'Actif' => 0])) {
 
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $role = Auth::user()->accessLevel; 
            $fonction = Auth::user()->fonction; 

            if($role==6 ){
                return redirect()->action([dashboardController::class, 'index']);
            }
            if($role==2 &&  $fonction!='Superviseur'){
                return redirect()->action([dashboardController::class, 'index']);
            }
            else{
                Session::flush();
                Auth::logout();
                return back()->withInput()->with('status', "Votre profil ne vous permet pas d'acceder à cet outil!");

            }
        }else{
                Session::flush();
                Auth::logout();
               return back()->withInput()->with('status', "Login ou mot de passe incorrect!");
        }
    }elseif ($actif==1) {
        Session::flush();
        Auth::logout();
        return back()->withInput()->with('status', 'Ce compte est inactif!');
    }
    else{
        Session::flush();
        Auth::logout();
        return back()->withInput()->with('status', "Ce compte n'existe pas!");

        
    }
    }
    public function logout(){
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
