<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use App\AgentModel;
use App\logModel;
use App\EntretienTelModel;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;
use Alert;


class addAgentController extends Controller
{
    
    public $nom;
    public $prenom;
    public $situationmat;
    public $sexe;
    public $datenaiss;
    public $lieunaiss;
    public $nationalite;
    public $email;
    public $tel;
    public $adresse;
    public $niveau;
    public $competence;
    public $experience;
    public $source;
    public $parrainage;
    public $langue;
    public $cvPDF;

    public function index(){

        $listenationalite= DB::table('Nationalites')
            ->select('*')
            ->orderby('Nationalites')
            ->get();

        $listecompetence= DB::table('Competences')
            ->select('*')
            ->orderby('Competence_Name')
            ->get();

		return View('addAgent')->with('listenationalite', $listenationalite)->with('listecompetence', $listecompetence);
    }
    


    public function SaveCV(Guard $auth,Request $request){

    	$dt = new DateTime();
        $userId=$auth->user()->login;
        $userCentre=$auth->user()->CentreUser;
        $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
        $clientIp = $request->ip();

    $nom=$request->input('nomAgent');
    $prenom1=$request->input('prenom1');
    $prenom2=$request->input('prenom2');
    $prenom3=$request->input('prenom3');
    $prenom4=$request->input('prenom4');
    $situationmat=$request->input('smAgent');
    $sexe=$request->input('sexeAgent');
    $datenaiss=$request->input('datenaissAgent');
    $lieunaiss=$request->input('lieunaissAgent');
    $nationalite=$request->input('nationaliteAgent');
    $email=$request->input('emailAgent');
    $tel1=$request->input('telAgent1');
    $tel1=substr($tel1,1);
    $tel2=$request->input('telAgent2');
    $tel2=substr($tel2,1);
    $adresse=$request->input('adresseAgent');
    $ville=$request->input('ville');
    $cp=$request->input('cp');
    $niveau=$request->input('niveauAgent');
    $experience=$request->input('experienceAgent');
    $source=$request->input('sourceCVAgent');
    $parrainage=$request->input('parrainage');
    $competence=$request->input('competenceAgent');
    $langue='';
    if(isset($_POST["langue"]))  
        { 
            foreach ($_POST['langue'] as $l)  { 
            	$langue=$langue.' '.$l;
        }
    }
    if($tel2!=0){
    $verifCV= DB::table('Agents')
        ->where('CRC_Agents_Tel_1', '=',$tel1)
        ->orWhere('CRC_Agents_Tel_1', '=', $tel2)
        ->orWhere('CRC_Agents_Tel_2', '=', $tel1)
        ->orWhere('CRC_Agents_Tel_2', '=', $tel2)
        ->select('*')->get();

        $verifCVTableEmploye= DB::table('Employe')
        ->where('Telephone1', '=',$tel1)
        ->orWhere('Telephone1', '=', $tel2)
        ->orWhere('Telephone2', '=', $tel1)
        ->orWhere('Telephone2', '=', $tel2)
        ->select('*')->get();
    }else{
        $tel2='';
        $verifCV= DB::table('Agents')
        ->where('CRC_Agents_Tel_1', '=',$tel1)
        ->orWhere('CRC_Agents_Tel_1', '=', $tel2)
        ->select('*')->get();

        $verifCVTableEmploye= DB::table('Employe')
        ->where('Telephone1', '=',$tel1)
        ->orWhere('Telephone1', '=', $tel2)
        ->select('*')->get();
    }
    $countCV=count($verifCV)+count($verifCVTableEmploye);

    if($countCV==0){
		$agent = new AgentModel;
			$agent->CRC_Agents_Nom= $nom;
			$agent->CRC_Agents_Prenom = $prenom1 ;
            $agent->CRC_Agents_Prenom2 = $prenom2 ;
            $agent->CRC_Agents_Prenom3 = $prenom3 ;
            $agent->CRC_Agents_Prenom4 = $prenom4 ;
			$agent->CRC_Agents_Sexe = $sexe;
			$agent->CRC_Agents_Datenaiss =$datenaiss ;
			$agent->CRC_Agents_Lieunaiss = $lieunaiss ;
			$agent->CRC_Agents_Situationmat = $situationmat ;
			$agent->CRC_Agents_Nationalite = $nationalite;
			$agent->CRC_Agents_Email = $email;
			$agent->CRC_Agents_Tel_1 = $tel1;
            $agent->CRC_Agents_Tel_2 = $tel2;
			$agent->CRC_Agents_Adresse = $adresse;
            $agent->CRC_Agents_Ville = $ville ;
            $agent->CRC_Agents_CP = $cp ;
			$agent->CRC_Agents_Niveau = $niveau;
			$agent->CRC_Agents_Competence = $competence;
			$agent->CRC_Agents_ExperienceCA = $experience;
			$agent->CRC_Agents_SourceCV = $source;
			$agent->CRC_Agents_Langues = $langue;
			$agent->CRC_Agents_Parrainage = $parrainage;
            $agent->created_by = $userId;
            $agent->CRC_Agents_Centre = $userCentre;
			$agent->save();

        	if(!empty($agent)){
        		$id= DB::table('Agents')->where('Id_Candidat', DB::raw("(select max(`Id_Candidat`) from Agents)"))->get();

            foreach ($id as $max){
                                $idmax = $max->Id_Candidat;
                            }
        	$entTel= new EntretienTelModel; 
        			$entTel->Id_Candidat = $idmax;
        			$entTel->CRC_ET_Statut = 'Nouveau';
        			$entTel->CRC_ET_VarStatut = '0';
                    $entTel->ET_Created_By=  $userId;
        			$entTel->save();

                    logModel::create([
                        'ACTION'=> "Saisie CV",
                        'DETAILS'=> "Saisie CV de l'agent: ".$idmax,
                        'ETAT'=> 'Réussi',
                        'ADRESSE_IP'=> $clientIp,
                        'PRENOM_NOM'=> $userPN,
                        'created_by'=> $userId,
                    ]);
                    return response()->json([
                        'status'  => true,
                        'message' => "Saisie CV réussie!"
                    ]);

        	}elseif(empty($agent)){

                logModel::create([
                    'ACTION'=> "Saisie CV",
                    'DETAILS'=> "Saisie CV de l'agent: ",
                    'ETAT'=> 'Echec',
                    'ADRESSE_IP'=> $clientIp,
                    'PRENOM_NOM'=> $userPN,
                    'created_by'=> $userId,
                ]);
                return response()->json([
                    'status'  => false,
                    'message' => "Echec de l'enrégistrement!"
                ]);
            } 
    }
    elseif($countCV!=0){

        return response()->json([
            'status'  => false,
            'message' => "Ce numéro de Tel existe déjà en base!"
        ]);
    }	
	   
	
}

}
