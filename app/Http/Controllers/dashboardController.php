<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
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

class dashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Guard $auth){
	    

            $dt = new DateTime();
            $start='2019-07-15';
	    	$end=$dt->format('Y-m-d');
			$userId=$auth->user()->login;
			$userCentre=$auth->user()->CentreUser;
			$userPN=$auth->user()->prenom.' '.$auth->user()->nom;

			$arretContrat=DB::table('Employe')
					->where('Actif',1)
					->where('Centre',$userCentre)
					->count();

	    	$production=DB::table('Employe')
	    			->where('Fonction','Conseiller Commercial')
					->where('Actif',0)
					->where('Centre',$userCentre)
	    			->count();

	    	$carriere=DB::table('Employe')
					->where('Fonction', '!=','Conseiller Commercial Old')
					->where('Actif',0)
					->where('Centre',$userCentre)
	    			->count();

	    	$pat=DB::table('Employe')
	    			->whereNotIn('Fonction',['Conseiller Commercial','Conseiller Commercial Old'])
					->where('Centre',$userCentre)
					->where('Actif',0)
	    			->count();

	    	

	    	$entretienTel=DB::table('EntretienTelephonique')
				->join('Agents','Agents.Id_Candidat', '=', 'EntretienTelephonique.Id_Candidat')
				->where('CRC_Agents_Centre',$userCentre)
	    		->where('CRC_ET_VarStatut','0')
	    		->count();


	    	$face2face=DB::table('FacetoFace')
				->join('Agents','Agents.Id_Candidat', '=', 'FacetoFace.Id_Candidat')
				->where('CRC_Agents_Centre',$userCentre)
	    		->where('CRC_FF_VarStatut','0')
	    		->count();

	    	$formation=DB::table('FormationInitiale')
				->join('Agents','Agents.Id_Candidat', '=', 'FormationInitiale.Id_Candidat')
				->where('CRC_Agents_Centre',$userCentre)
	    		->where('CRC_FI_VarStatut','0')
	    		->count();

	    	$continue=DB::table('FormationContinue')
				->join('Agents','Agents.Id_Candidat', '=', 'FormationContinue.Id_Candidat')
				->where('CRC_Agents_Centre',$userCentre)
	    		->distinct('CRC_FC_Intitule')
	    		->count('CRC_FC_Intitule');

		return view('dashboard')->with('arretContrat',$arretContrat)->with('entretienTel',$entretienTel)->with('face2face',$face2face)->with('formation',$formation)->with('production',$production)->with('carriere',$carriere)->with('pat',$pat)->with('continue',$continue);
		
    }

}
