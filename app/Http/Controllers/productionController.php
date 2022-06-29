<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use App\AgentModel;
use App\EntretienTelModel;
use App\FormationContinue;
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

class productionController extends Controller
{
    public function index(Guard $auth){
        $donneesFormation= DB::table('Activites')
            ->select('*')
            ->get();

        $dt = new DateTime();
        $start='2018-08-27';
        $end=$dt->format('Y-m-d');
        
        $userCentre=$auth->user()->CentreUser;

        $donneesFC= DB::select("call GenererProductionCentre(?)",array($userCentre));

        return view('production')->with('donneesFC',$donneesFC)->with('donneesFormation',$donneesFormation); 
    }

    public function SaveContinue(Guard $auth,Request $request){

        $dt = new DateTime();
        $previousUrl  = ('production');
        
        $idSelected=$request->input('idSelected');
        $idSelected = substr($idSelected,1); 
        $nbRows=$request->input('nbRows');
        $split=explode(',', $idSelected, $nbRows);

        $formContinue=$request->input('continue');

        $periodeContinue=$request->input('periodeContinue');
        $splitName = explode('-', $periodeContinue, 2);
            $st=$splitName [0];
            $e=$splitName [1];
            $start= date("Y-m-d", strtotime($st));
            $end= date("Y-m-d", strtotime($e));

        for($i = 0; $i<$nbRows; $i++)
        {

            $id = $split[$i];

            $infos= DB::table('FormationContinue')
                ->where('CRC_Agents_Id', '=',$id)
                ->where('CRC_FC_Intitule', $formContinue)
                ->select('*')->get();
            $countInfo=count($infos);

            $in= DB::table('FormationContinue')
                ->where('CRC_Agents_Id', '=',$id)
                ->where('created_at', DB::raw("(select min(`created_at`) from FormationContinue where CRC_Agents_Id=".$id." )"))
                ->select('CRC_FC_Intitule')->get();

            foreach ($in as $z) {
                $intitule=$z->CRC_FC_Intitule;
                
            }
            

            if($countInfo!=0){
                Alert::info("Ce conseiller a déjà suivi cette formation");
                return redirect()->to($previousUrl); 

            }
            if($countInfo==0){
                $requete= DB::table('Production')
                    ->where('CRC_Agents_Id', $id)
                    ->select('Id_Candidat')->get();

                foreach ($requete as $P)  { 
                        $idCandidat=$P->Id_Candidat;
                }

                if($intitule =='Pas de formation continue'){

                    $req=DB::table('FormationContinue')
                        ->where('Id_Candidat',$idCandidat)
                        ->update(array(
                            'CRC_FC_Intitule' => $formContinue,
                            'CRC_FC_DateDebut' => $start,
                            'CRC_FC_DateFin' => $end,
                            'updated_at'=> $dt->format('Y-m-d H:i:s')
                        ));

                }
                elseif($intitule != 'Pas de formation continue'){
                    $continue = new FormationContinue;
                        $continue->Id_Candidat = $idCandidat;
                        $continue->CRC_Agents_Id = $id;
                        $continue->CRC_FC_Intitule = $formContinue;
                        $continue->CRC_FC_DateDebut=$start;
                        $continue->CRC_FC_DateFin=$end;
                        $continue->created_at = $dt->format('Y-m-d H:i:s');
                        $continue->updated_at = $dt->format('Y-m-d H:i:s');
                        $continue->save();


                }
                

               

            }

            


        }
        Alert::success("Formation continue ajoutée");
        return redirect()->to($previousUrl);  
        
    }
}
