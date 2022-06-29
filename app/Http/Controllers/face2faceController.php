<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use App\AgentModel;
use App\EntretienTelModel;
use App\Face2FaceModel;
use App\logModel;
use App\FormationIniModel;
use App\Employe;
use App\doublonModel;
use Illuminate;
use View;
use DB;
use Schema;
use DateTime;
use Carbon;
use Date;
use Session;
use Alert;

    class face2faceController extends Controller
    {
        
         public function index(Guard $auth){
    	    
                $dt = new DateTime();
                $start='2018-08-27';
    	    	$end=$dt->format('Y-m-d');
                $userCentre=$auth->user()->CentreUser;
                $donneesFF= DB::select("call GenererFacetofaceCentre(?,?,?,?,?,?)",array($start,$end,'','','',$userCentre));

    		return view('Entretien.face2face',['donneesFF'=>$donneesFF]);  
        }

        public function SearchFacetoFace(Guard $auth,Request $request){

        	$dt = new DateTime();
            $userId=$auth->user()->login;
            $userCentre=$auth->user()->CentreUser;
            $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
            $clientIp = $request->ip();

            $periode=$request->input('periodeEntretien');
            $splitName = explode('-', $periode, 2);
                $st=$splitName [0];
                $e=$splitName [1];
                $start= date("Y-m-d", strtotime($st));
                $end=date("Y-m-d", strtotime($e));
                $periodeformat=$start.' au '.$end;

    	    $parrainage=$request->input('parrainageAgent');
    	    $disponibilite=$request->input('dispoAgent'); 
    	    $statut=$request->input('statutFacetoFace');

    	    if (empty($start)) {
                $start='2018-08-27';
    		}
    		if (empty($end)) {
     			 $end=$dt->format('Y-m-d');;
    		}
    	    if (empty($parrainage)) {
     			 $parrainage='';
    		}
    		if (empty($disponibilite)) {
     			 $disponibilite='';
    		}
    	    if (empty($statut)) {
     			 $statut='';
    		}

    		$valeurSearch=$start.' '.$end.' '.$parrainage.' '.$statut.' '.$disponibilite;
    	    $donneesFF= DB::select("call GenererFacetofaceCentre(?,?,?,?,?,?)",array($start,$end,$parrainage,$disponibilite,$statut,$userCentre));
    	  
    	    return view('Entretien.face2face')->with('donneesFF',$donneesFF)->with('valeurSearch',$valeurSearch);  

}


        public function EnregistrerFF(Request $request,Guard $auth){
             
            
        	$dt = new DateTime();
            $userId=$auth->user()->login;
            $userCentre=$auth->user()->CentreUser;
            $userPN=$auth->user()->prenom.' '.$auth->user()->nom;
            $clientIp = $request->ip();
            $today=$dt->format('Y-m-d');
            
            $Id_Candidat=$request->input('identifiantFF');
            $dateFF=$request->input('dateFF');
            $statutFF=$request->input('statutAgentFF');
            $resultatFF=$request->input('resultatFF');
            // $nom=$request->input('nomFF');
            // $prenom=$request->input('prenomFF');
            
            $updateFF=Face2FaceModel::where('Id_Candidat',$Id_Candidat)
            ->update(array(
                'CRC_FF_Date' => $dateFF,
                'CRC_FF_Statut' => $statutFF,
                'CRC_FF_VarStatut' => 1,
                'CRC_FF_Resultat' => $resultatFF,
                'FF_Updated_By'=>  $userId
            ));
            if($updateFF){
                logModel::create([
                    'ACTION'=> "Face2Face",
                    'DETAILS'=> "Infos Face2Face de l'agent: ".$Id_Candidat,
                    'ETAT'=> 'Réussi',
                    'ADRESSE_IP'=> $clientIp,
                    'PRENOM_NOM'=> $userPN,
                    'created_by'=> $userId,
                ]);
            if($statutFF =='KO') { 
                return response()->json([
                    'status'  => true,
                    'message' => "Infos enrégistrées"
                ]);                       
            }
            elseif($statutFF=='OK') {
                if($userCentre== 1){
                    $th=597.1730226;
                    $th_mn=9.9528837;
                    $Statut='CEE';
                }else{
                    $th=0.0000000;
                    $th_mn=0.0000000;
                    $Statut='ANAPEC';
                }
                $infos=DB::table('Agents')
                    ->where('Id_Candidat', $Id_Candidat)
                    ->select('*')->get();
                        $concat1;
                        $concat2;
                        $concat3;
                        $concat4;
                        $nom_datenaiss;
                        $date_lieu;
                        $tel1;
                        $tel2;

                    foreach ($infos as $i) {
                        $concat1=$i->CRC_Agents_Nom.','.$i->CRC_Agents_Prenom;
                        $concat2=$i->CRC_Agents_Nom.','.$i->CRC_Agents_Prenom2;
                        $concat3=$i->CRC_Agents_Nom.','.$i->CRC_Agents_Prenom3;
                        $concat4=$i->CRC_Agents_Nom.','.$i->CRC_Agents_Prenom4;
                        $nom_datenaiss=$i->CRC_Agents_Nom.','.$i->CRC_Agents_Datenaiss;
                        $date_lieu=$i->CRC_Agents_Datenaiss.','.$i->CRC_Agents_Lieunaiss; 
                        $tel1=$i->CRC_Agents_Tel_1;
                        $tel2=$i->CRC_Agents_Tel_2;
                    
                   // if($tel2 !=0){
                        // $verifDoublon=DB::table('Doublons')
                        //     ->where("Etat", 'Ouvert')
                        //     ->where('Telephone1', $tel1)
                        //     ->orwhere('Telephone1', $tel2)
                        //     ->orwhere('Telephone2',$tel2)
                        //     ->orwhere('Telephone2', $tel1)
                        //     ->select('Id')
                        //     ->get();
                       // }else{
                           // $tel2='';
                            // $verifDoublon=DB::table('Doublons')
                            // ->where("Etat", 'Ouvert')
                            // ->where('Telephone1', $tel1)
                            // ->orwhere('Telephone2', $tel1)
                            // ->select('Id')
                            // ->get();
                        //}
                        //if(empty($verifDoublon)){
                            if($tel2 !=''){
                                $verif=DB::table('Employe')
                                ->whereRaw("concat(Nom,',',Prenom) = ?", [$concat1])
                                // ->orwhereRaw("concat(Nom,',',Prenom2) = ?", [$concat2])
                                // ->orwhereRaw("concat(Nom,',',Prenom3) = ?", [$concat3])
                                // ->orwhereRaw("concat(Nom,',',Prenom4) = ?", [$concat4])
                                ->orwhereRaw("concat(Nom,',',Date_Naissance) = ?", [$nom_datenaiss])
                                ->orwhereRaw("concat(Date_Naissance,',',Lieu_Naissance) = ?", [$date_lieu])
                                ->orwhere('Telephone1', $tel1)
                                ->orwhere('Telephone1', $tel2)
                                ->orwhere('Telephone2',$tel2)
                                ->orwhere('Telephone2', $tel1)
                                ->select('CRC_Agents_Id')
                                ->get();
                            }else{
                                $tel2='';
                                $verif=DB::table('Employe')
                                ->whereRaw("concat(Nom,',',Prenom) = ?", [$concat1])
                                // ->orwhereRaw("concat(Nom,',',Prenom2) = ?", [$concat2])
                                // ->orwhereRaw("concat(Nom,',',Prenom3) = ?", [$concat3])
                                // ->orwhereRaw("concat(Nom,',',Prenom4) = ?", [$concat4])
                                ->orwhereRaw("concat(Nom,',',Date_Naissance) = ?", [$nom_datenaiss])
                                ->orwhereRaw("concat(Date_Naissance,',',Lieu_Naissance) = ?", [$date_lieu])
                                ->orwhere('Telephone1', $tel1)
                                ->orwhere('Telephone2', $tel1)
                                ->select('CRC_Agents_Id')
                                ->get();
                            }
                                $casSuspects='';
                        if(count($verif)>0){
                            foreach ($verif as $key) {
                                $casSuspects=$casSuspects.",".$key->CRC_Agents_Id."";
                                }
                                $casSuspects=substr($casSuspects,1);
                                doublonModel::create([
                                    'Nom'=> $i->CRC_Agents_Nom,
                                    'Prenom1'=> $i->CRC_Agents_Prenom,
                                    'Prenom2'=> $i->CRC_Agents_Prenom2,
                                    'Prenom3'=> $i->CRC_Agents_Prenom3,
                                    'Prenom4'=> $i->CRC_Agents_Prenom4,
                                    'Statut'=> $Statut,
                                    'Fonction'=> 'Conseiller Commercial',
                                    'accessLevel'=>1,
                                    'Taux_Horaire'=> $th,
                                    'Taux_Horaire_Mn'=> $th_mn,
                                    'Centre'=>$userCentre, 
                                    'Date_Naissance'=> $i->CRC_Agents_Datenaiss,
                                    'Lieu_Naissance'=>$i->CRC_Agents_Lieunaiss,
                                    'Telephone1'=>$tel1,
                                    'Telephone2'=>$tel2,
                                    'Adresse'=>$i->CRC_Agents_Adresse,
                                    'CP'=>$i->CRC_Agents_CP,
                                    'Ville'=>$i->CRC_Agents_Ville,
                                    'Nationalite'=>$i->CRC_Agents_Nationalite,
                                    'Etat'=>'Ouvert',
                                    'Date_creation'=>$today,
                                    'PotentielDoublons'=>$casSuspects,
                                    'Source'=>'RH',
                                    'Id_AgentRH'=>$Id_Candidat
                                ]);
                                return response()->json([
                                    'status'  => true,
                                    'message' => "Infos soumis à Support pour validation"
                                ]);
                            }else{
                                 $req1=DB::table('Employe')
                                    ->where('CRC_Agents_Id', DB::raw("(select max(`CRC_Agents_Id`) from Employe)"))
                                    ->select('CRC_Agents_Id')->get();
                
                                foreach ($req1 as $r)  { 
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
                                $initiale= new FormationIniModel; 
                                $initiale->Id_Candidat = $Id_Candidat;
                                $initiale->CRC_Agents_Id = $chaineIdCRC;
                                $initiale->CRC_FI_Statut = 'Nouveau';
                                $initiale->CRC_FI_VarStatut = 0;
                                $initiale->FI_Created_By = $userId;
                                $initiale->save();

                                $ajout=Employe::create([
                                    'CRC_Agents_Id'=>$chaineIdCRC,
                                    'Nom'=> $i->CRC_Agents_Nom,
                                    'Prenom'=> $i->CRC_Agents_Prenom,
                                    'Prenom2'=> $i->CRC_Agents_Prenom2,
                                    'Prenom3'=> $i->CRC_Agents_Prenom3,
                                    'Prenom4'=> $i->CRC_Agents_Prenom4,
                                    'Statut'=> $Statut,
                                    'Fonction'=> 'Conseiller Commercial',
                                    'Date_Naissance'=> $i->CRC_Agents_Datenaiss,
                                    'Lieu_Naissance'=>$i->CRC_Agents_Lieunaiss,
                                    'Telephone1'=> $tel1,
                                    'Telephone2'=> $tel2,
                                    'Adresse'=>$i->CRC_Agents_Adresse,
                                    'CP'=>$i->CRC_Agents_CP,
                                    'Ville'=>$i->CRC_Agents_Ville,
                                    'Nationalite'=>$i->CRC_Agents_Nationalite,
                                    'Centre' => $userCentre,
                                    'Taux_Horaire' => $th,
                                    'Taux_Horaire_Mn' => $th_mn,
                                    'created_by' => $userId,
                                    'Actif' =>0,
                                ]);
                                return response()->json([
                                    'status'  => true,
                                    'message' => "Face2Face validé"
                                ]);
                            }
                        // }else{
                        //     return response()->json([
                        //                 'status'  => false,
                        //                 'message' => "merde doublon"
                        //             ]);
                        // }
                    }

        }  
                    
    }else{
        logModel::create([
            'ACTION'=> "Face2Face",
            'DETAILS'=> "Infos Face2Face de l'agent: ".$Id_Candidat,
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
