<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use App\AgentModel;
use App\Employe;
use App\EntretienTelModel;
use App\FormationIniModel;
use App\logModel;
use App\User;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;
use Alert;
use PDF;
//use Excel;
use App\Imports\EmployeImport;
use Maatwebsite\Excel\Facades\Excel;
//use Maatwebsite\Excel\HeadingRowImport;

class carriereController extends Controller
{
    public function index(Guard $auth,Request $request){

      $dt = new DateTime();
      $today=$dt->format('Y-m-d');
      $userCentre=$auth->user()->CentreUser;

    $donneesId= DB::table('Employe')->select('*')
      ->where('Actif', '=',0)->get();

		$poste= DB::table('Employe')->select('Fonction')->distinct()->orderBy('Fonction')
    ->where('Fonction', '!=','Conseiller Commercial Old')
    ->where('Actif', '=',0)
    ->get();
		$donneesCarriere= DB::select("call GenererCarriereCentre(?,?,?,?,?,?)",array('','','','',$today,$userCentre));

    $listenationalite= DB::table('Nationalites')
    ->select('*')
    ->orderby('Nationalites')
    ->get();

		return view('carriere')->with('donneesCarriere',$donneesCarriere)->with('poste',$poste)->with('donneesId',$donneesId)->with('listenationalite', $listenationalite);
    }

    public function SearchCarriere(Guard $auth,Request $request){

    	$dt = new DateTime();
      $today=$dt->format('Y-m-d');
      $userCentre=$auth->user()->CentreUser;
	    $idAgent='';

	    if(isset($_POST["identifiant"]))  
	        { 
	            foreach ($_POST['identifiant'] as $l)  { 
	            	$idAgent=$idAgent.','.$l;
	        }
	    }
	    $post=$request->input('poste');
	    $dateEmbauche=$request->input('dateEmbauche');
      $alerte=$request->input('alerte');

	    if (empty($idAgent)) {
             $idAgent='';
    	}
    	if (empty($post)) {
             $post='';
    	}
    	if (empty($dateEmbauche)) {
             $dateEmbauche='';
    	}
      if (empty($alerte)) {
             $alerte='';
      }

	    $donneesCarriere= DB::select("call GenererCarriereCentre(?,?,?,?,?,?)",array($dateEmbauche,$post,$idAgent,$alerte,$today,$userCentre));
	    $donneesId= DB::table('Employe')->select('*')->get();
	    $poste= DB::table('Employe')->select('Fonction')->distinct()->orderBy('Fonction')->get();

      $listenationalite= DB::table('Nationalites')
        ->select('*')
        ->orderby('Nationalites')
        ->get();
	    
	    return view('carriere')->with('donneesCarriere',$donneesCarriere)->with('poste',$poste)->with('donneesId',$donneesId)->with('listenationalite', $listenationalite); 

	}

	public function UploadCarriere(Request $request){

        $dt = new DateTime();
        $previousUrl  = ('carriere');
        //validate the xls file
         $this->validate($request, ['Employe_file' => 'required|mimes:xlx,xlsx' ]);
            
                $path = $request->file('Employe_file')->getRealPath();

                 Excel::import(new EmployeImport, $path);
                 Alert::success('success', 'Your Data has successfully imported');
                 	return redirect()->to($previousUrl);             
                 
}
public function Generate(Request $request){
  $conseiller=$request->input('contrat');
  $infos=DB::table('Employe')
        ->join('Production','Production.CRC_Agents_Id', '=', 'Employe.CRC_Agents_Id')
        ->join('Agents','Production.Id_Candidat', '=', 'Agents.Id_Candidat')
        ->where('Employe.CRC_Agents_Id',$conseiller)
        ->select('*')->get();

        $data=[];
        foreach ($infos as $i) {
          $debutContrat = date( "Y-m-d", strtotime("-6 months",strtotime($i->Date_FinContrat)));
          $data=[
            'NOM' => $i->Nom,
            'PRENOM' => $i->Prenom,
            'DEBUT' => $debutContrat,
            'FIN' => $i->Date_FinContrat,
            'ADRESSE' => $i->CRC_Agents_Adresse,
            'SEXE' => $i->CRC_Agents_Sexe,
            'LIEU' => $i->CRC_Agents_Lieunaiss,
            'NAISSANCE' => $i->CRC_Agents_Datenaiss,
            'NATIONALITE' => $i->CRC_Agents_Nationalite,
            'PERE' => $i->PN_Pere,
            'MERE' => $i->PN_Mere,
            'ETAB' => $i->Etablissement,
            'REF' => $i->Emploi_ref,
            'CATEGORIE' => $i->Categorie,
            'TYPE' => $i->Type_Identification,
            'NUMERO' => $i->Numero_Identification
          ];
        }
    $pdf = PDF::loadView('contrat', $data)->save('pdf/Contrat.pdf');
   
   return response()->json([
    'status'  => true,
    'message' => $data
]);
}
public function SaveIntegration(Request $request,Guard $auth){

      $dt = new DateTime();
      $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
      $clientIp = $request->ip();
      $userId=$auth->user()->login;

      $IdCRC=$request->input('CRCId');

      $pere=$request->input('pere');
      $mere=$request->input('mere');
      $debut=$request->input('debut');
      $fin=$request->input('fin');
      $categorie=$request->input('categorie');
      $type=$request->input('type');
      $numero=$request->input('numero');
      $etab=$request->input('etab');
      $ref=$request->input('ref');

      $update=Employe::where('CRC_Agents_Id',$IdCRC)
                        ->update(array(
                            'PN_Pere' => $pere,
                            'PN_Mere' => $mere,
                            'Etablissement'=> $etab,
                            'Emploi_ref' => $ref,
                            'Categorie' => $categorie,
                            'Type_Identification'=> $type,
                            'Numero_Identification' => $numero,
                            //'Date_FinContrat' => $fin,
                        ));
        if($update){
          logModel::create([
            'ACTION'=> "Infos complementaires",
            'DETAILS'=> "Infos".$IdCRC,
            'ETAT'=> 'Réussi',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
          return response()->json([
            'status'  => true,
            'message' => "Infos enrégistrées"
          ]);
        }else{
          logModel::create([
            'ACTION'=> "Infos complementaires",
            'DETAILS'=> "Infos".$IdCRC,
            'ETAT'=> 'Echec',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
          return response()->json([
            'status'  => false,
            'message' => "Echec de l'enregistrement"
        ]);
        }


      }

      public function RenouvelerContrat(Request $request){

      $dt = new DateTime();
      $IdCRC=$request->input('idEmp');

      $statut=$request->input('statut');
      $renouvel=$request->input('countR');

      $requete= DB::table('Employe')->select('*')
      ->where('CRC_Agents_Id', '=',$IdCRC)->get();

      foreach ($requete as $req){ 
                    $statutActuel=$req->Statut;
                    $dateFActuel=$req->Date_FinContrat;
                    $countR=$req->Renouvellement_Count;
            }
      $dateFinContrat = date('Y-m-d',strtotime('+6 month',strtotime($dateFActuel)));

        // Cas CEE ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if($statut == 'CEE'){
            $req=DB::table('Employe')
              ->where('CRC_Agents_Id',$IdCRC)
              ->update(array(
                            'Statut' => $statut,
                            'Renouvellement_Count' => $renouvel,
                            'DureeContrat'=> '6 mois',
                            'Date_FinContrat' => $dateFinContrat,
                            'Taux_Horaire'=>597.1730226,
                            'Taux_Horaire_Mn'=> 9.9528837,
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')   
                        ));
        
        
      }
      // Cas CEE BELI ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      elseif($statut == 'CEE_BELI'){
       
        $req=DB::table('Employe')
                        ->where('CRC_Agents_Id',$IdCRC)
                        ->update(array(
                            'Statut' => $statut,
                            'Renouvellement_Count' => $renouvel,
                            'DureeContrat'=> '6 mois',
                            'Date_FinContrat' => $dateFinContrat,
                            'Taux_Horaire'=>810.1851852,
                            'Taux_Horaire_Mn'=> 13.5030864,
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')   
                        ));
      
      }

      // Cas CDD ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      elseif($statut == 'CDD'){
            $req=DB::table('Employe')
                  ->where('CRC_Agents_Id',$IdCRC)
                  ->update(array(
                                'Statut' => $statut,
                                'Renouvellement_Count' => $renouvel,
                                'DureeContrat'=> '6 mois',
                                'Date_FinContrat' => $dateFinContrat,
                                'Taux_Horaire'=>729.2332545,
                                'Taux_Horaire_Mn'=> 12.1538875,
                                'updated_at'=>  $dt->format('Y-m-d H:i:s')   
                            ));
      }


      // Cas CDD BELI ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      elseif($statut == 'CDD_Beli'){
      
        $req=DB::table('Employe')
                        ->where('CRC_Agents_Id',$IdCRC)
                        ->update(array(
                            'Statut' => $statut,
                            'Renouvellement_Count' => $renouvel,
                            'DureeContrat'=> '6 mois',
                            'Date_FinContrat' => $dateFinContrat,
                            'Taux_Horaire'=>902.7777778,
                            'Taux_Horaire_Mn'=> 15.0462962,
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')   
                        ));
      }

      // Cas CDI ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      elseif($statut == 'CDI'){
        $req=DB::table('Employe')
                        ->where('CRC_Agents_Id',$IdCRC)
                        ->update(array(
                            'Statut' => $statut,
                            'Renouvellement_Count' => 0,
                            'DureeContrat'=> 'Indefini',
                            'Date_FinContrat' => NULL,
                            'Taux_Horaire'=>729.2332545,
                            'Taux_Horaire_Mn'=> 12.1538875,
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')   
                        ));
      }

      
      
  

       $previousUrl  = ('carriere');
       Alert::success('success', 'Saved');
      return redirect()->to($previousUrl); 


      }

      public function Demissionner(Request $request,Guard $auth){
        $dt = new DateTime();
        $IdD=$request->input('IdD');
  
        $motif=$request->input('motif');
        $dateDemission=$request->input('dateDemission');
        $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
        $clientIp = $request->ip();
        $userId=$auth->user()->login;

        
        $req=Employe::where('CRC_Agents_Id',$IdD)
                        ->update(array(
                            'Actif' => 1,
                            'Date_Demission' => $dateDemission,
                            'Motif_Demission'=> $motif
                        ));
        if($req){
          $deleted = User::where('login', $IdD)->delete();
        }
        if($deleted || $req){
          logModel::create([
            'ACTION'=> "Infos Demission",
            'DETAILS'=> "Demission et suppression des accès de l'agent ".$IdD,
            'ETAT'=> 'Réussi',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
          return response()->json([
            'status'  => true,
            'message' => "Infos enrégistrées"
          ]);
        }else{
          logModel::create([
            'ACTION'=> "Infos Demission",
            'DETAILS'=> "Demission et suppression des accès de l'agent ".$IdD,
            'ETAT'=> 'Echec',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
          return response()->json([
            'status'  => false,
            'message' => "Echec"
        ]);
        }
      }
}
