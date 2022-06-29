<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\AgentModel;
use App\EntretienTelModel;
use App\Face2FaceModel;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;
use Alert;

class continueController extends Controller
{
    /*public function index(){
	    $donneesFormation= DB::table('Activites')
            ->select('*')
            ->get();

		$dt = new DateTime();
            $start='2019-07-15';
	    	$end=$dt->format('Y-m-d');
	    

        $donneesFC= DB::select("call GenererProduction()",array());

		return view('continue')->with('donneesFC',$donneesFC)->with('donneesFormation',$donneesFormation); 
    }

    public function SaveContinue(Request $request){

    	$dt = new DateTime();
        
    	$idSelected=input::get('idSelected');
    	$idSelected = substr($idSelected,1); 
    	$nbRows=input::get('nbRows');
        $split=explode(',', $idSelected, $nbRows);

    	$continue=input::get('continue');

    	$periodeContinue=input::get('periodeContinue');
    	$splitName = explode('-', $periodeContinue, 2);
            $st=$splitName [0];
            $e=$splitName [1];
            $start= date("Y-m-d", strtotime($st));
            $end= date("Y-m-d", strtotime($e));

        $updateDetails = array(
            'CRC_FC_Intitule' => $continue,
            'CRC_FC_DateDebut' => $start,
            'CRC_FC_DateFin' => $end,
            'updated_at' => $dt->format('Y-m-d H:i:s'));

        for($i = 0;$i<$nbRows; $i++)
        {
            $id = $split[$i];
            DB::table('Production')
                ->where('Id_Candidat',"=",$id)
                ->update($updateDetails);
        }

        $previousUrl  = ('continue');
        Alert::success("Formation continue ajoutée");
        return redirect()->to($previousUrl); 
    }*/
}
