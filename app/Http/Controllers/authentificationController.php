<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Session;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;

class authentificationController extends Controller
{
    //

    public $login;
    public $pwd;
    


    public function SeConnecter(Request $request){
    	$login=input::get('login');
    	$pwd=input::get('password');


    	$req =DB::table('users')
        ->where('login', '=',$login)
        ->where('password', '=',$pwd)
        ->select('prenom', 'nom', 'fonction','login')->get();
        foreach ($req as $r){
                        $log = $r->login;
                        $fonction = $r->fonction;

                    }
        if(!empty($log)) {
            
                return View('dashboard')->with('req',$req);
                Session::set('login', $login);
           
            

        
       }           
        elseif(empty($log))
        {
            $errorVar=1;
            return View('authentification')->with('login', $login)->with('errorVar', $errorVar)->with('error', true);
            
        }
        
        
}

public function deconnexion()
{
    session()->flush();
    auth()->logout();
    
    //Session::forget('login');

    return redirect('/');
}

}
