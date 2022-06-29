<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\AgentModel;
use App\Employe;
use App\EntretienTelModel;
use App\FormationIniModel;
use App\Production;
use App\logModel;
use App\FormationContinue;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;
use Alert;

class initialeController extends Controller
{
   

    public function index(Guard $auth){
	    $donneesFormation= DB::table('Activites')
            ->select('*')
            ->get();

		$dt = new DateTime();
        $start='2018-08-27';
	    $end=$dt->format('Y-m-d');
        $userCentre=$auth->user()->CentreUser;  
        $donneesFI= DB::select("call GenererFormationInitialeCentre(?,?,?,?,?)",array($start,$end,'','',$userCentre));
		return view('Formation.initiale')->with('donneesFI',$donneesFI)->with('donneesFormation',$donneesFormation); 
    }

    
    public function SearchInitiale(Guard $auth,Request $request){

        $dt = new DateTime();
        $userCentre=$auth->user()->CentreUser;
       $periode=$request->input('periodeFacetoface');
       if(!empty($periode)){
          $splitName = explode('-', $periode, 2);
          $st=$splitName [0];
          $e=$splitName [1];
          $start= date("Y-m-d", strtotime($st));
          $end=date("Y-m-d", strtotime($e));
      }

      elseif(empty($periode)){
            $start='2018-08-27';
          $end=$dt->format('Y-m-d');
          $periode=$start.'-'.$end;
      }

      $formation=$request->input('formation');
      $statut=$request->input('statutFormation');

    if (empty($formation)) {
           $formation='';
        }

    if (empty($statut)) {
           $statut='';
        }

    $donneesFormation= DB::table('Activites')
            ->select('*')
            ->get();
    $donneesFI= DB::select("call GenererFormationInitialeCentre(?,?,?,?,?)",array($start,$end,$formation,$statut,$userCentre));
    return view('Formation.initiale')->with('donneesFI',$donneesFI)->with('donneesFormation',$donneesFormation); 

}

    public function SaveFormation(Request $request,Guard $auth){
            
        $dt = new DateTime();
        $userId=$auth->user()->login;
        $userCentre=$auth->user()->CentreUser;
        $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
        $clientIp = $request->ip();
        
    	$idSelected=$request->input('idSelected');
    	$idSelected = substr($idSelected,1); 
    	$nbRows=$request->input('nbRows');
        $split=explode(',', $idSelected);

    	$formation=$request->input('fi');
    	$periodeFormation=$request->input('periodeFormation');
    	$splitName = explode('-', $periodeFormation, 2);
            $st=$splitName[0];
            $e=$splitName[1];
            $start= date("Y-m-d", strtotime($st));
            $end= date("Y-m-d", strtotime($e));
          $arrayID=[];
          for($i = 0;$i<$nbRows; $i++)
            {
                array_push($arrayID, $split[$i]);
            }

            $update=FormationIniModel::whereIN('Id_Candidat',$arrayID)->update(array(
                'CRC_FI_Intitule' => $formation,
                'CRC_FI_DateDebut' => $start,
                'CRC_FI_DateFin' => $end,
                'FI_Updated_By' => $userId
                ));
        
        if($update){
            logModel::create([
                'ACTION'=> "Initiale",
                'DETAILS'=> "Ajout formation: ".$idSelected,
                'ETAT'=> 'Réussi',
                'ADRESSE_IP'=> $clientIp,
                'PRENOM_NOM'=> $userPN,
                'created_by'=> $userId,
            ]);
            return response()->json([
                'status'  => true,
                'message' => "Formation ajoutée :".$formation
            ]);  
        }else{
            logModel::create([
                'ACTION'=> "Initiale",
                'DETAILS'=> "Ajout formation: ".$idSelected,
                'ETAT'=> 'Echec',
                'ADRESSE_IP'=> $clientIp,
                'PRENOM_NOM'=> $userPN,
                'created_by'=> $userId,
            ]);
            return response()->json([
                'status'  => false,
                'message' => "Erreur ajout de la formation "
            ]);  
        }
    }

    public function SaveNote(Request $request,Guard $auth){
             
            
        $dt = new DateTime();
        $userId=$auth->user()->login;
        $userCentre=$auth->user()->CentreUser;
        $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
        $clientIp = $request->ip();
        $today=$dt->format('Y-m-d');
        
        $idCandidat=$request->input('identifiantForm');
        $idCRC=$request->input('identifiantCRC');
        $statutFormation=$request->input('statutFI');
        $noteFormation=$request->input('noteFormation');
        $dateEntreeProd=$request->input('dateEntreeProd');
        $resultatComite=$request->input('resultatComite');

        $req=DB::table('Employe')
            ->where('CRC_Agents_Id', DB::raw("(select max(`CRC_Agents_Id`) from Employe)"))
            ->select('CRC_Agents_Id')->get();

            foreach ($req as $r) { 
            $dernierIdCRC=$r->CRC_Agents_Id;
            }
            $intIdCRC=intval($dernierIdCRC);
            $intIdCRC=$intIdCRC+1;
            $chaineIdCRC="";
            if(strlen((string)$intIdCRC)>3){
            $chaineIdCRC=(string)$intIdCRC;
            }else{
            $chaineIdCRC="0".(string)$intIdCRC;
            }

        if($userCentre==1){
            $Statut='CEE';
            $password='crc'.$chaineIdCRC;
        }elseif($userCentre==5){
            $Statut='ANAPEC';
            $password='CASA'.$chaineIdCRC;
        }
        $recup=DB::table('Taux_Horaire')
        ->where('IdCentre',$userCentre)
        ->where('Statut',$Statut)
        ->select('*')->get();
        $th;
        $th_mn;
        foreach ($recup as $k) {
            $th=$k->Taux_Horaire;
            $th_mn=$k->Taux_Horaire_Mn;
        }
//Recuperer nom et prenom de l'agent
$requete=DB::table('Agents')
->where('Id_Candidat', $idCandidat)
->select('CRC_Agents_Nom', 'CRC_Agents_Prenom','CRC_Agents_Prenom2','CRC_Agents_Prenom3','CRC_Agents_Prenom4')->get();

foreach ($requete as $re)  { 
 $nom=$re->CRC_Agents_Nom;
 $prenom=$re->CRC_Agents_Prenom.' '.$re->CRC_Agents_Prenom2.' '.$re->CRC_Agents_Prenom3.' '.$re->CRC_Agents_Prenom4;
}

//Recuperer date debut formation initiale as date d'embauche
$requeteFI=DB::table('FormationInitiale')
->where('Id_Candidat', $idCandidat)
->select('CRC_FI_DateDebut')->get();

foreach ($requeteFI as $FI)  { 
 $dateEmbauche=$FI->CRC_FI_DateDebut;
}
$dateFinContrat = date('Y-m-d',strtotime('+6 month',strtotime($dateEmbauche)));



// MODIF GENERATION ID ON FACE2FACE
if(empty($idCRC)){
    FormationIniModel::where('Id_Candidat',$idCandidat)
    ->update(array(
                'CRC_FI_Statut' => $statutFormation,
                'CRC_FI_Note' => $noteFormation,
                'CRC_FI_VarStatut' => 1,
                'CRC_FI_Resultat'=> $resultatComite,
                'FI_Updated_By'=> $userId
            ));
   if($statutFormation =='OK') {
        $fi= new FormationContinue;
        $fi->Id_Candidat = $idCandidat;
        $fi->CRC_Agents_Id = $chaineIdCRC;
        $fi->CRC_FC_Intitule = 'Pas de formation continue';
        $fi->CRC_FC_DateDebut =null;
        $fi->CRC_FC_DateFin = null;    
        $fi->save();

    $prod= new Production;
        $prod->Id_Candidat = $idCandidat;
        $prod->CRC_Agents_Id = $chaineIdCRC;
        $prod->CRC_Agents_EntreeProd = $dateEntreeProd;
        $prod->Created_By = $userId;
        $prod->save();

    $e= new Employe; 
        $e->CRC_Agents_Id = $chaineIdCRC;
        $e->Nom = $nom;
        $e->Prenom = $prenom;
        $e->Date_Embauche=$dateEmbauche;
	    $e->DureeContrat='6 mois';
        $e->Date_FinContrat=$dateFinContrat;
        $e->Fonction='Conseiller Commercial';
        $e->Statut=$Statut;
	    $e->Centre=1;
        $e->Taux_Horaire=$th;
        $e->Taux_Horaire_Mn=$th_mn;
        $e->created_by=$userId;
        $e->save();

     User::create([
            'nom'=> $nom,
            'prenom'=> $prenom,
            'fonction'=> 'Conseiller Commercial',
            'accessLevel'=> 1,
            'login' => $chaineIdCRC,
	        'CentreUser'=>$userCentre,
            'password' => bcrypt($password),
            'sansHash' => $password,
        ]);
        logModel::create([
            'ACTION'=> "Initiale",
            'DETAILS'=> "Validation FI: ".$idCandidat,
            'ETAT'=> 'Réussi',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
        return response()->json([
            'status'  => true,
            'message' => "FI validée"
        ]);  
    }else{

        logModel::create([
            'ACTION'=> "Initiale",
            'DETAILS'=> "Formation initiale KO: ".$idCandidat,
            'ETAT'=> 'Réussi',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
        return response()->json([
            'status'  => true,
            'message' => "KO Formation"
        ]);  
    }

}else{
    if($userCentre==1){
        $password='crc'.$idCRC;
    }elseif($userCentre==5){
        $password='CASA'.$idCRC;
    }
    FormationIniModel::where('Id_Candidat',$idCandidat)
    ->update(array(
                'CRC_FI_Statut' => $statutFormation,
                'CRC_FI_Note' => $noteFormation,
                'CRC_FI_VarStatut' => 1,
                'CRC_FI_Resultat'=> $resultatComite,
                'FI_Updated_By'=> $userId
    ));
    if($statutFormation !='OK' ) {
        $maj = Employe::where('CRC_Agents_Id', $idCRC)->update(array(
            'Actif' => 1,
            'Motif_Demission'=>'KO formation',
            'Date_Demission'=>$today,
            'updated_by'=> $userId
        ));
        logModel::create([
            'ACTION'=> "Initiale",
            'DETAILS'=> "Validation FI KO: ".$idCandidat,
            'ETAT'=> 'Réussi',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
        return response()->json([
            'status'  => true,
            'message' => "KO formation"
        ]);  
   }      
       elseif($statutFormation =='OK') {
       $fi= new FormationContinue;
           $fi->Id_Candidat = $idCandidat;
           $fi->CRC_Agents_Id = $idCRC;
           $fi->CRC_FC_Intitule = 'Pas de formation continue';
           $fi->CRC_FC_DateDebut =null;
           $fi->CRC_FC_DateFin = null;    
           $fi->save();
   
        $prod= new Production;
           $prod->Id_Candidat = $idCandidat;
           $prod->CRC_Agents_Id = $idCRC;
           $prod->CRC_Agents_EntreeProd = $dateEntreeProd;
           $prod->save();

        $update=Employe::where('CRC_Agents_Id', $idCRC)
                ->update(array(
                    'Date_Embauche'=>$dateEmbauche,
                    'DureeContrat'=>'6 mois',
                    'Date_FinContrat'=>$dateFinContrat,
                    'Statut'=>$Statut,
                    'Centre' => $userCentre,
                    'Taux_Horaire' => $th,
                    'Taux_Horaire_Mn' => $th_mn,
                    'updated_by' => $userId, 
                    'Actif'=>0    
        ));
        User::create([
               'nom'=> $nom,
               'prenom'=> $prenom,
               'fonction'=> 'Conseiller Commercial',
               'accessLevel'=> 1,
               'login' => $idCRC,
               'CentreUser'=>$userCentre,
               'password' => bcrypt($password),
               'sansHash' => $password,
        ]);
        logModel::create([
            'ACTION'=> "Initiale",
            'DETAILS'=> "Validation FI OK: ".$idCandidat,
            'ETAT'=> 'Réussi',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
        return response()->json([
            'status'  => true,
            'message' => "Entrée en prod effective"
        ]); 
       }
}
      
        
}

}