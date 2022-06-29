<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use App\AgentModel;
use App\EntretienTelModel;
use App\Face2FaceModel;
use App\logModel;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;
use Alert;


class entretienTelController extends Controller
{
    public function index(Guard $auth){

        $dt = new DateTime();
        $start='2019-07-15';
        $end=$dt->format('Y-m-d');
        $parrainage='';
        $statut='';
        $userCentre=$auth->user()->CentreUser;

        $donneesET= DB::select("call GenererEntretienCentre(?,?,?,?,?)",array($start,$end,'','',$userCentre));

        return view('Entretien.entretienTel')->with('donneesET',$donneesET);
    }



    public function SearchEntTel(Guard $auth,Request $request){

    	$dt = new DateTime();
        $userCentre=$auth->user()->CentreUser;
       $periode=$request->input('periodeSaisieCV');
       if(!empty($periode)){
          $splitName = explode('-', $periode, 2);
          $st=$splitName [0];
          $e=$splitName [1];
          $start= date("Y-m-d", strtotime($st));
          $end=date("Y-m-d", strtotime($e));
        }

      elseif(empty($periode)){
          $start='2019-07-15';
          $end=$dt->format('Y-m-d');
          $periode=$start.'-'.$end;

      }

      $parrainage=$request->input('parrainageAgent');
      $statut=$request->input('statutEntretienTel');

      if (empty($parrainage)) {
       $parrainage='';
   }
   if (empty($statut)) {
       $statut='';
   }

   $valeurSearch=$periode.' '.$parrainage.' '.$statut;
   $donneesET= DB::select("call GenererEntretienCentre(?,?,?,?,?)",array($start,$end,$parrainage,$statut,$userCentre));
   return view('Entretien.entretienTel')->with('donneesET',$donneesET)->with('valeurSearch',$valeurSearch);  

}

public function OuvrirFiche(Guard $auth, Request $request){

    $voirFiche=$request->input('voirFiche');
    $listenationalite= DB::table('Nationalites')
    ->select('*')
    ->orderby('Nationalites')
    ->get();

    $listecompetence= DB::table('Competences')
    ->select('*')
    ->orderby('Competence_Name')
    ->get();
    $listeNiveau= DB::table('Niveau')
    ->select('*')
    ->orderby('Niveau')
    ->get();
    $listeExperience= DB::table('ExperienceCA')
    ->select('*')
    ->orderby('Id')
    ->get();


    $infos= DB::table('Agents')
    ->join('EntretienTelephonique', 'Agents.Id_Candidat', '=', 'EntretienTelephonique.Id_Candidat')
    ->where('Agents.Id_Candidat', '=',$voirFiche)
    ->select('*')->get();

    $infosET= DB::table('EntretienTelephonique')
    ->where('Id_Candidat', '=',$voirFiche)
    ->select('CRC_ET_Statut')->get();
    foreach ($infosET as $statut){
        $statutET = $statut->CRC_ET_Statut;

    }


    if($statutET=='Nouveau'){
        $statutETNouveau=1;
        return view('Entretien.ficheET')->with('infos',$infos)->with('listenationalite', $listenationalite)->with('listecompetence', $listecompetence)
        ->with('statutETNouveau', $statutETNouveau)->with('listeNiveau', $listeNiveau)->with('listeExperience', $listeExperience);
        

    }elseif($statutET=='KO'){
        $statutETKO=1;
        return view('Entretien.ficheET')->with('infos',$infos)->with('listenationalite', $listenationalite)->with('listecompetence', $listecompetence)
        ->with('statutETKO', $statutETKO)->with('listeNiveau', $listeNiveau)->with('listeExperience', $listeExperience);  
    }



} 
public function UpdateCV(Guard $auth, Request $request){

    $dt = new DateTime();
    $today=$dt->format('Y-m-d');
    $userId=$auth->user()->login;
    $userCentre=$auth->user()->CentreUser;
    $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
    $clientIp = $request->ip();
    $Id_Candidat=$request->input('idCandidat');

    $nom=$request->input('nomAgent');
    $prenom1=$request->input('prenomAgent1');
    $prenom2=$request->input('prenomAgent2');
    $prenom3=$request->input('prenomAgent3');
    $prenom4=$request->input('prenomAgent4');
    $situationmat=$request->input('smAgent');
    $sexe=$request->input('sexeAgent');
    $datenaiss=$request->input('datenaissAgent');
    $lieunaiss=$request->input('lieunaissAgent');
    $nationalite=$request->input('nationaliteAgent');
    $email=$request->input('emailAgent');
    $tel1=$request->input('telAgent1');
    $tel2=$request->input('telAgent2');
    $adresse=$request->input('adresseAgent');
    $ville=$request->input('villeAgent');
    $cp=$request->input('cpAgent');
    $niveau=$request->input('niveauAgent');
    $experience=$request->input('experienceAgent');
    $competence=$request->input('competenceAgent');
    $source=$request->input('sourceCVAgent');
    $parrainage=$request->input('parrainageAgent');
    
    $langue='';
    if(isset($_POST["langueAgent"]))  
    { 
        foreach ($_POST['langueAgent'] as $l)  { 
            $langue=$langue.' '.$l;
        }
    }
    if($tel2==0 || $tel2==''){
        $tel2=(NULL);
    }
    // if($tel2!=0){
    //     $verifCV= DB::table('Agents')
    //         ->where('Id_Candidat','!=',$Id_Candidat)
    //         ->where('CRC_Agents_Tel_1', '=',$tel1)
    //         ->orWhere('CRC_Agents_Tel_1', '=', $tel2)
    //         ->orWhere('CRC_Agents_Tel_2', '=', $tel1)
    //         ->orWhere('CRC_Agents_Tel_2', '=', $tel2)
    //         ->select('Id_Candidat')->get();
    
    //     $verifCVTableEmploye= DB::table('Employe')
    //         ->where('Telephone1', '=',$tel1)
    //         ->orWhere('Telephone1', '=', $tel2)
    //         ->orWhere('Telephone2', '=', $tel1)
    //         ->orWhere('Telephone2', '=', $tel2)
    //         ->select('CRC_Agents_Id')->get();
    // }else{
    //     $verifCV= DB::table('Agents')
    //         ->where('Id_Candidat','!=',$Id_Candidat)
    //         ->where('CRC_Agents_Tel_1', '=',$tel1)
    //         ->orWhere('CRC_Agents_Tel_1', '=', $tel2)
    //         ->select('Id_Candidat')->get();
    
    //     $verifCVTableEmploye= DB::table('Employe')
    //         ->where('Telephone1', '=',$tel1)
    //         ->orWhere('Telephone1', '=', $tel2)
    //         ->select('CRC_Agents_Id')->get();
    // }
    // $countCV=count($verifCV)+count($verifCVTableEmploye);

    $updateDetails = array(
        "CRC_Agents_Prenom" => $prenom1,
        "CRC_Agents_Prenom2" => $prenom2,
        "CRC_Agents_Prenom3" => $prenom3,
        "CRC_Agents_Prenom4" => $prenom4,
        'CRC_Agents_Nom' => $nom,
        'CRC_Agents_Sexe' => $sexe,
        'CRC_Agents_Datenaiss'=> $datenaiss,
        'CRC_Agents_Lieunaiss' => $lieunaiss,
        'CRC_Agents_Situationmat'=> $situationmat,
        'CRC_Agents_Nationalite'=> $nationalite,
        'CRC_Agents_Email'=>$email,
        'CRC_Agents_Tel_1'=> $tel1,
        'CRC_Agents_Tel_2'=> $tel2,
        'CRC_Agents_Adresse'=> $adresse,
        'CRC_Agents_Ville'=> $ville,
        'CRC_Agents_CP'=> $cp,
        'CRC_Agents_Competence'=>$competence,
        'CRC_Agents_ExperienceCA'=>$experience,
        'CRC_Agents_Langues' => $langue,
        'CRC_Agents_SourceCV'=>$source,
        'CRC_Agents_Parrainage' =>$parrainage,
        'updated_by' => $userId
        );
        //if($countCV==0){
            $req=AgentModel::where('Id_Candidat',$Id_Candidat)
                ->update($updateDetails);
                if($req){
                    logModel::create([
                        'ACTION'=> "Update CV",
                        'DETAILS'=> "Update CV de l'agent: ".$Id_Candidat,
                        'ETAT'=> 'Réussi',
                        'ADRESSE_IP'=> $clientIp,
                        'PRENOM_NOM'=> $userPN,
                        'created_by'=> $userId,
                    ]);
                    return response()->json([
                        'status'  => true,
                        'message' => "Mise à jour du CV réussie!"
                    ]);
                }else{
                    logModel::create([
                        'ACTION'=> "Update CV",
                        'DETAILS'=> "Update CV de l'agent: ".$Id_Candidat,
                        'ETAT'=> 'Echec',
                        'ADRESSE_IP'=> $clientIp,
                        'PRENOM_NOM'=> $userPN,
                        'created_by'=> $userId,
                    ]);
                    return response()->json([
                        'status'  => false,
                        'message' => 'Echec de la mise à jour!'
                    ]);
                }

           
       // }else{
        //     return response()->json([
        //         'status'  => false,
        //         'message' => "Ce numéro de Tel existe déjà en base! ".$verifCV)
        //     ]);
        // }
}

 public function EnregistrerET(Guard $auth, Request $request){

    $dt = new DateTime();
    $userId=$auth->user()->login;
    $userCentre=$auth->user()->CentreUser;
    $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
    $clientIp = $request->ip();

    $idCandidatET=$request->input('idCandidatET');
    $dateEntretien=$request->input('dateEntretien');
    $statutET=$request->input('statutAgentEnt');
    $profil=$request->input('profilAgentEnt');
    $disponibilite=$request->input('dispoAgent');
    $resultatET=trim($request->input('resultatET'));
    
    if($statutET =='KO') {
        $VarstatutET=0;
        $updateET=EntretienTelModel::where('Id_Candidat',$idCandidatET)
                        ->update(array(
                            'CRC_ET_Date' => $dateEntretien,
                            'CRC_ET_Statut' => 'KO',
                            'CRC_ET_Profil' => $profil,
                            'CRC_ET_VarStatut' => $VarstatutET,
                            'CRC_ET_Resultat' =>$resultatET,
                            'CRC_ET_Dispo' => $disponibilite,
                            'ET_Updated_By'=>  $userId
                        ));
    if($updateET){
    logModel::create([
        'ACTION'=> "Fiche ET",
        'DETAILS'=> "Infos entretien de l'agent: ".$idCandidatET,
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
            'ACTION'=> "Fiche ET",
            'DETAILS'=> "Infos entretien de l'agent: ".$idCandidatET,
            'ETAT'=> 'Echec',
            'ADRESSE_IP'=> $clientIp,
            'PRENOM_NOM'=> $userPN,
            'created_by'=> $userId,
        ]);
        return response()->json([
            'status'  => false,
            'message' => "Echec de l'enrégistrement"
        ]);
    }
}
    elseif($statutET =='OK') {
        $VarstatutET=1;
        $VarstatutFF=0;
        $updateETOK=EntretienTelModel::where('Id_Candidat',$idCandidatET)
                        ->update(array(
                            'CRC_ET_Date' => $dateEntretien,
                            'CRC_ET_Statut' => 'OK',
                            'CRC_ET_Profil' => $profil,
                            'CRC_ET_VarStatut' => $VarstatutET,
                            'CRC_ET_Resultat' => $resultatET,
                            'CRC_ET_Dispo' => $disponibilite,
                            'ET_Updated_By'=>  $userId
                        ));

        $face= new Face2FaceModel; 
                    $face->Id_Candidat = $idCandidatET;
                    $face->CRC_FF_Statut = 'Nouveau';
                    $face->CRC_FF_VarStatut = $VarstatutFF;
                    $face->FF_Created_By = $userId;
                    $face->save();

                    if($updateETOK && $face){
                        logModel::create([
                            'ACTION'=> "Fiche ET",
                            'DETAILS'=> "Infos entretien de l'agent: ".$idCandidatET,
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
                                'ACTION'=> "Fiche ET",
                                'DETAILS'=> "Infos entretien de l'agent: ".$idCandidatET,
                                'ETAT'=> 'Echec',
                                'ADRESSE_IP'=> $clientIp,
                                'PRENOM_NOM'=> $userPN,
                                'created_by'=> $userId,
                            ]);
                            return response()->json([
                                'status'  => false,
                                'message' => "Echec de l'enrégistrement"
                            ]);
                        }
    }         
    }
}






