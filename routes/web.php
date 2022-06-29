<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;
use App\Employe;

Route::get('/', function () {
  
  //....
  // try {
  //      DB::connection()->getPdo();
  //      if(DB::connection()->getDatabaseName()){
  //          echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
  //          //$results = DB::select('select * from users where login = ?', array('0034'));
  //          //return $results;
  //      }else{
  //          die("Could not find the database. Please check your configuration.");
  //      }
  //  } catch (\Exception $e) {
  //      die("Could not open connection to database server.  Please check your configuration.");
  //  }
   
  return redirect('/login') ;
});
Route::get('/logout', function () {
  return redirect('/login') ;
});
Route::get('register', function () {
  return redirect('/register') ;
});

Auth::routes();

Route::group(['prefix' => '', 'middleware' => 'auth'], function()
{
    

      Route::get('contrat', function () {
        return view('contrat');
    });

    Route::get('dashboard', 'dashboardController@index');

    Route::get('addAgent', 'addAgentController@index');
    Route::post('saveCV', 'addAgentController@SaveCV');


    Route::get('entretienTel', 'entretienTelController@index');
    Route::post('searchEntTel', 'entretienTelController@SearchEntTel');
   // Route::get('ficheet/{Id_Candidat}','entretienTelController@OuvrirFiche');
    Route::post('voirfiche','entretienTelController@OuvrirFiche');
    Route::post('enregistrerET', 'entretienTelController@EnregistrerET');
    Route::post('updateCV', 'entretienTelController@UpdateCV');


    Route::get('face2face', 'face2faceController@index');
    Route::post('searchFacetoFace', 'face2faceController@SearchFacetoFace');
    Route::post('saveFacetoface','face2faceController@EnregistrerFF');


    Route::get('initiale', 'initialeController@index');
    Route::post('searchInitiale', 'initialeController@SearchInitiale');
    Route::post('saveFormation', 'initialeController@SaveFormation');
    Route::post('saveNote', 'initialeController@SaveNote');


    Route::get('carriere','carriereController@index');
    Route::post('generercontrat','carriereController@Generate');
    Route::post('searchCarriere','carriereController@SearchCarriere');
    Route::post('demissionner','carriereController@Demissionner');
    Route::post('uploadCarriere','carriereController@UploadCarriere');
    Route::post('saveIntegration','carriereController@SaveIntegration');
    Route::post('renouveler','carriereController@RenouvelerContrat');
    
    Route::get('production', 'productionController@index');
    Route::post('saveContinue', 'productionController@SaveContinue');

  Route::get('ajax-method', function(){
    $Ids = Request::get('Ids');
    $infos = DB::table('Employe')
     ->join('Production', 'Employe.CRC_Agents_Id', '=', 'Production.CRC_Agents_Id')
     ->join('FormationInitiale', 'Production.Id_Candidat', '=', 'FormationInitiale.Id_Candidat')
     ->join('FacetoFace', 'FormationInitiale.Id_Candidat', '=', 'FacetoFace.Id_Candidat')
     ->join('EntretienTelephonique', 'FacetoFace.Id_Candidat', '=', 'EntretienTelephonique.Id_Candidat')
     ->join('Agents', 'Agents.Id_Candidat', '=', 'EntretienTelephonique.Id_Candidat')
    ->where('Employe.CRC_Agents_Id', '=',$Ids)
    ->select('*')->get();

    return Response::json($infos);

});  
    Route::get('ajax-fiche', function(){
    $identifiant = Request::get('identifiant');
    $i = DB::table('Employe')
    ->where('Employe.CRC_Agents_Id', '=',$identifiant)
    ->select('*')->get();

    return Response::json($i);

}); 

});