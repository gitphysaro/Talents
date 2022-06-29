<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\AgentModel;
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

class ficheETController extends Controller
{
    public function EnregistrerET(Request $request){
         

    $dt = new DateTime();
    $today=$dt->format('Y-m-d');
    $IdCandidat=$request->input('idCandidatET');
    echo $IdCandidat;

    
    $dateEntretien=$request->input('dateEntretien');
    echo $dateEntretien;

    $statutET=$request->input('statutAgentEnt');
    $profil=$request->input('profilAgentEnt');
    echo $profil;
    $disponibilite=$request->input('dispoAgent');
    $resultatET=$request->input('resultatET');

    DB::table('Agents')
        ->where('Id_Candidat','=',$IdCandidat)
        ->update(array(
            'CRC_Agents_Profil' =>$profil,
            'updated_at'=>  $dt->format('Y-m-d H:i:s')
                           
    ));

    
    if($statutET !='OK' ) {
        $VarstatutET=0;
        DB::table('EntretienTelephonique')
                        ->where('Id_Candidat',$IdCandidat)
                        ->update(array(
                            'CRC_ET_Date' => $dateEntretien,
                            'CRC_ET_Statut' => 'KO',
                            'CRC_ET_VarStatut' => $VarstatutET,
                            'CRC_ET_Resultat' => $resultatET,
                            'CRC_ET_Dispo' => $disponibilite,
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')
                        ));
    }
    elseif($statutET =='OK') {
        $VarstatutET=1;
        $VarstatutFF=0;

        DB::table('EntretienTelephonique')
                        ->where('Id_Candidat',$IdCandidat)
                        ->update(array(
                            'CRC_ET_Date' => $dateEntretien,
                            'CRC_ET_Statut' => $statutET,
                            'CRC_ET_VarStatut' => $VarstatutET,
                            'CRC_ET_Resultat' => $resultatET,
                            'CRC_ET_Dispo' => $disponibilite,
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')
                        ));

                $face= new Face2FaceModel; 
                    $face->Id_Candidat = $IdCandidat;
                    $face->CRC_FF_Statut = 'Nouveau';
                    $face->CRC_FF_VarStatut = $VarstatutFF;
                    $face->created_at = $dt->format('Y-m-d H:i:s');
                    $face->updated_at = $dt->format('Y-m-d H:i:s');
                    $face->save();
                }

                

                
    $previousUrl  = ('entretienTel');
    Alert::success("Ajout des infos de l'entretien téléphonique réussi!");
    return redirect()->to($previousUrl);


    }

}
