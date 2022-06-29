@extends('layouts.layout')

 @section('carriere') 


 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Carriere
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li> -->
        <li class="active">Carriere</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
              <div class="box box-default">
        <div class="box-header with-border">
          <h2 class="box-title">Critères de recherche</h2>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form class="form" method="post" role="form" action="searchCarriere">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col-md-3">
              
             
              <div class="form-group">
                <label>Id Employé</label>
                <select id="identifiant" name="identifiant[]" class="form-control select2" multiple="multiple" data-placeholder="Sélectionner id">
                  @foreach ($donneesId as $data)
                     <option value="{{$data->CRC_Agents_Id}}">{{ $data->CRC_Agents_Id }} <small> {{ $data->Prenom.' '.$data->Nom }} </small></option>
                  @endforeach
                </select>
                
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Poste occupé</label>
                <select id="poste" name="poste" class="form-control select2" style="width: 100%;">
                  <option value="" selected disabled> Sélectionner le poste</option> 
                   @foreach ($poste as $p) 
                           <option value="{{$p->Fonction}}">{{$p->Fonction}}</option> 
                        @endforeach
                </select>
              </div>
              
            </div>

            <div class="col-md-2">
              
              <div class="form-group">
                <label>Date d'embauche</label>
                
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control input-sm pull-right" id="dateEmbauche" name="dateEmbauche">
                </div>
              </div>

              </div>

               <div class="col-md-2">
              
              <div class="form-group">
                <label>Alerte fin contrat</label>
                
                <select id="alerte" name="alerte" class="form-control select2" style="width: 100%;">
                  <option value="" selected disabled>Sélectionner</option> 
                  <option value="31">Au plus 30 jours</option> 
                  <option value="">Voir tout</option>       
                </select>
              </div>

              </div>

              <div class="col-md-2">
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-block pull-right" style="background-color: #7cc404; color: white;margin-top:25px;">Rechercher</button>
                </div>
              </div>

              </form>
          </div>
          </div>


          </div>
      </div>
      

      <div class="row">
        <div class="col-md-12">

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des employés</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              @if(count($errors)>0)
              <div class="col-md-5 pull-right">
                <div class="alert alert-danger">
                  Upload Validation Error <br><br>
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach

                  </ul>
                </div>

              </div>
              @endif
                <!--  <div class="col-md-11 pull-left"></div>
                 <div class="col-md-1 pull-right">
                        <a type="button btn-default" data-toggle="modal" data-target="#myModal" id="upload" name="upload" class="btn btn-round  btn-block btn-md btn-flat" ><i class="fa fa-upload" aria-hidden="true"></i> Importer xlsx</a>

                       
                 </div>  --> 
                               <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Choose file</h4>
                </div>
                <div class="modal-body">
  
                    <form id="uploadForm" class="form-horizontal" role="form" method="post" action="uploadCarriere" enctype="multipart/form-data">
                     
                         <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
  
                        <div class="form-group">
                            <label class="col-md-4 control-label">Choose your xls/csv File :</label>
                            <div class="col-md-7">
                                <input type="file" class="form-control @error('Employe_file') is-invalid @enderror" id="Employe_file" name="Employe_file" required>
                                <small class="help-block"></small>
                                @error('Employe_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
  
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                                <button type="submit" value="" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>                       
  
                </div>
            </div>
        </div>
    </div>

                   
              <table id="example2" class="table table-bordered table-hover"  style="width:100%">
                <thead style="background-color: #555555; color: white;">
                <tr>
                  <th>Identifiant CRC</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Poste occupé</th>
                  <th>Statut</th>
                  <th>Date d'embauche</th>
                  <th>Date Fin Contrat</th>
                  <th>Alerte fin contrat </th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($donneesCarriere as $C) 
                        <tr> 
                           <td>{{$C->CRC_Agents_Id}}</td>
                           <td> {{$C->Nom }}</td> 
                           <td> {{$C->Prenom}} {{$C->Prenom2}} {{$C->Prenom3}} {{$C->Prenom4}}</td> 
                           <td> {{$C->Fonction }}</td>
                           <td> {{$C->Statut}}</td>
                           <td> {{$C->Date_Embauche}}</td>
                           <td> {{$C->Date_FinContrat}}</td>
                           
                           @if($C->Alerte =='')
                             <td>-</td> 
                           @endif
                           @if($C->Alerte !='')
                             @if($C->Alerte <= 30)
                             <td style="color: red;"> {{$C->Alerte}} jours restant</td> 

                             @endif
                             @if($C->Alerte > 30)
                             <td>{{$C->Alerte}} jours restant</td> 

                             @endif
                           @endif
                           <td> 

                          
                          @if($C->Fonction=='Conseiller Commercial')
                          <button class="btn  btn-sm" style="background-color: #1b73a4; color: white" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-lg" title="Consulter la fiche employé"
                         data-agent_id="{{$C->CRC_Agents_Id}}">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                          </button>
                          @if($C->Statut != 'CDI' && $C->Statut != '')
                            @if($C->Alerte <= 300)
                         <button class="btn  btn-sm btn-info" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".renouvellement" title="Renouveller le contrat"
                         data-agent_id="{{$C->CRC_Agents_Id}}" data-agent_statut="{{$C->Statut}}" data-agent_renouvelllement="{{$C->Renouvellement_Count}}" data-agent_prenom="{{$C->Prenom}}" data-agent_nom="{{$C->Nom}}">
                                <i class="fa fa-book" aria-hidden="true"></i>
                          </button>
                          @endif 
                          @endif
                          <button class="btn  btn-sm" data-toggle="modal" data-target=".edit" data-backdrop="static" data-keyboard="false" title="Ajouter info integration" 
                          data-agent_id="{{$C->CRC_Agents_Id}}" data-agent_p="{{$C->Prenom}}" data-agent_n="{{$C->Nom}}"
                          data-agent_pere="{{$C->PN_Pere}}" data-agent_mere="{{$C->PN_Mere}}" data-agent_categorie="{{$C->Categorie}}" data-agent_etab="{{$C->Etablissement}}"
                          data-agent_emploi="{{$C->Emploi_ref}}" data-agent_type="{{$C->Type_Identification}}" data-agent_numero="{{$C->Numero_Identification}}"
                          data-agent_debut="{{$C->Date_Embauche}}" data-agent_fin="{{$C->Date_FinContrat}}"
                           name="btnc" id="btnc" style="background-color: #7cc404; color: white;">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </button>
                          @if($C->Statut != 'CDI')
                          <button type="button" style="color: white" value="{{$C->CRC_Agents_Id}}" onclick='voircontrat(this)' formtarget="_blank" id="contrat" name="contrat" class="btn btn-sm btn-warning" style="border: none;" title="Voir le contrat">
                          <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                          @endif
                          @endif
                           @if($C->Fonction !='Conseiller Commercial')
                         <button class="btn  btn-sm" style="background-color: #1b73a4; color: white" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".example-modal-lg" title="Consulter la fiche employé"
                         data-agent_id="{{$C->CRC_Agents_Id}}">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                          </button>
                          @endif
                          
                          <button class="btn  btn-sm btn-danger" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".modalDemission" title="Demission"
                         data-agent_idd="{{$C->CRC_Agents_Id}}" data-agent_prenomd="{{$C->Prenom}}" data-agent_nomd="{{$C->Nom}}">
                         <i class="fa fa-window-close" aria-hidden="true"></i>
                          </button>
                        </td> 
                           
                        </tr>
                        @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  
                </tr> 
                </tfoot>
              </table>






<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" role="form" action="">
            <input type="hidden" name="IdCRC" id="IdCRC" value="">
{{ csrf_field() }} 
      <div class="modal-header" style="background-color: #555555;color:#7cc404;text-align: center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" >Fiche Employe </h3>
                <div class="" id="alerter" name="alerter" style="color:orange;text-align: center"> </div>
              </div>
              <div class="modal-body">
                 <div class="row">
                

<div class="col-md-12">
  <div class="box">
                <h4 class="box-title" style="color:#7cc404;">Informations personnelles</h4>

  <div class="form-group col-md-6">
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Id CRC:</label>
                            <div class="col-md-7">
                               <b><input id="id" type="text" class="form-control" name="id" value="" style="border: none" readonly></b> 
                            </div>

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Nom:</label>
                            <div class="col-md-7">
                                <input id="nom" type="text" class="form-control" name="nom" value="" style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Prénom:</label>
                            <div class="col-md-7">
                                <input id="prenom" type="text" class="form-control" name="prenom" value="" style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Date de naissance:</label>
                            <div class="col-md-7">
                                <input id="datenaiss" type="text" class="form-control " name="datenaiss" value=""  style="border: none" readonly>
                            </div>

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Lieu de naissance:</label>
                            <div class="col-md-7">
                                <input id="lieunaiss" type="text" class="form-control " name="lieunaiss" value=""  style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Situation Mat:</label>
                            <div class="col-md-7">
                                <input id="situation" type="text" class="form-control" name="situation" value=""  style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Nationalité:</label>
                            <div class="col-md-7">
                                <input id="nationalite" type="text" class="form-control" name="nationalite" value=""  style="border: none" readonly>
                            </div>
                        </div>

  <div class="form-group col-md-6">
                            

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Email:</label>
                            <div class="col-md-7">
                                <input id="email" type="text" class="form-control " name="email" value=""  style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Tel 1 / Tel 2:</label>
                            <div class="col-md-7">
                                <input id="tel" type="text" class="form-control " name="tel" value=""  style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Adresse:</label>
                            <div class="col-md-7">
                                <input id="adresse" type="text" class="form-control" name="adresse" value=""  style="border: none" readonly>
                            </div>

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Niveau d'etude:</label>
                            <div class="col-md-7">
                                <input id="niveau" type="text" class="form-control" name="niveau" value=""  style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Parrainage:</label>
                            <div class="col-md-7">
                                <input id="parrainage" type="text" class="form-control" name="parrainage" value=""  style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Langues:</label>
                            <div class="col-md-7">
                                <input id="langue" type="text" class="form-control" name="langue" value=""  style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Ecrites et Parlées:</label>
                            <div class="col-md-7">
                                <input id="langueEP" type="text" class="form-control" name="langueEP" value=""  style="border: none" readonly>
                            </div>
                        </div>
                        </div>
                        </div>
<div class="col-md-12">
   <div class="box">
                <h4 class="box-title" style="color:#7cc404; ">Entretien téléphonique</h4>

  <div class="form-group col-md-6">
 
  
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Date Entretien:</label>
                            <div class="col-md-7">
                                <input id="dateET" type="text" class="form-control" name="dateET" value="" style="border: none" readonly>
                            </div>

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Profil:</label>
                            <div class="col-md-7">
                                <input id="profil" type="text" class="form-control" name="profil" value="" style="border: none" readonly>
                            </div>

                            

                        </div>
 <div class="form-group col-md-6">
<label for="login" class="col-md-5 col-form-label text-sm-left">Résultat:</label>
                            <div class="col-md-7">
                                <input id="resultatET" type="text" class="form-control" name="resultatET" value="" style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Disponibilité:</label>
                            <div class="col-md-7">
                                <input id="dispo" type="text" class="form-control" name="dispo" value=""  style="border: none" readonly>
                            </div>
 </div> 
</div> 
</div>
<div class="col-md-12">
<div class="box">
    <h4 class="box-title" style="color:#7cc404; ">Face to face</h4>
 <div class="form-group col-md-6">

 
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Date Face to face:</label>
                            <div class="col-md-7">
                                <input id="dateFF" type="text" class="form-control" name="dateFF" value="" style="border: none" readonly>
                            </div>

 </div>                      
<div class="form-group col-md-6">
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Résultat:</label>
                            <div class="col-md-7">
                                <input id="resultatFF" type="text" class="form-control" name="resultatFF" value="" style="border: none" readonly>
                            </div>

                        </div>
                        </div>
                        </div>
<div class="col-md-12">
   <div class="box">
                <h4 class="box-title" style="color:#7cc404; ">Formation initiale suivie</h4>

  <div class="form-group col-md-6">
 
  
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Intitulé:</label>
                            <div class="col-md-7">
                                <input id="initiale" type="text" class="form-control" name="initiale" value="" style="border: none" readonly>
                            </div>

                        </div>
 <div class="form-group col-md-6">
<label for="login" class="col-md-5 col-form-label text-sm-left">Periode initiale:</label>
                            <div class="col-md-7">
                                <input id="initialeP" type="text" class="form-control" name="initialeP" value="" style="border: none" readonly>
                            </div>

 </div> 
</div> 
</div>
<div class="col-md-12">
<div class="box">
    <h4 class="box-title" style="color:#7cc404;">Autres</h4>
 <div class="form-group col-md-6">

 
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Date d'embauche:</label>
                            <div class="col-md-7">
                                <input id="embauche" type="text" class="form-control" name="embauche" value="" style="border: none" readonly>
                            </div>

 </div>                      
<div class="form-group col-md-6">
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Date d'entrée Prod</label>
                            <div class="col-md-7">
                                <input id="entreProd" type="text" class="form-control" name="entreProd" value="" style="border: none" readonly>
                            </div>

                        </div>
                        </div>
                        </div>

 </div>
              <div class="modal-footer">
                <button type="button" class="btn pull-right" style="background-color: #555555; color: white;" data-dismiss="modal">Fermer</button>

              </div>
              </form>
              </div>

            
            </div>
    
    
  </div>



  <div class="modal fade example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" role="form" action="">
            <input type="hidden" name="IdCRCPAT" id="IdCRCPAT" value="">
{{ csrf_field() }} 
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" style="color:#7cc404;text-align: center">Fiche Employe 
               <!--  <input id="fonctionPAT" type="text" class="form-control input-sm" name="fonctionPAT"  > -->
                 </h3>
              </div>
              <div class="modal-body">
                 <div class="row">
                

<div class="col-md-12">
  <div class="box">
                <h4 class="box-title" style="color:#7cc404;">Informations personnelles</h4>

  <div class="form-group col-md-6">
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Id CRC:</label>
                            <div class="col-md-7">
                               <b><input id="idPAT" type="text" class="form-control" name="idPAT" value="" style="border: none" readonly></b> 
                            </div>

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Nom:</label>
                            <div class="col-md-7">
                                <input id="nomPAT" type="text" class="form-control" name="nomPAT" value="" style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Prénom:</label>
                            <div class="col-md-7">
                                <input id="prenomPAT" type="text" class="form-control" name="prenomPAT" value="" style="border: none" readonly>
                            </div>

                            <label for="login" class="col-md-5 col-form-label text-sm-left">Situation Mat:</label>
                            <div class="col-md-7">
                                <input id="situationPAT" type="text" class="form-control" name="situationPAT" value=""  style="border: none" readonly>
                            </div>

                            

                            
                        </div>

  <div class="form-group col-md-6">
                            
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Nationalité:</label>
                            <div class="col-md-7">
                                <input id="nationalitePAT" type="text" class="form-control" name="nationalitePAT" value=""  style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Fonction:</label>
                            <div class="col-md-7">
                                <input id="fonctionPAT" type="text" class="form-control" name="fonctionPAT" value="" style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Date d'embauche:</label>
                            <div class="col-md-7">
                                <input id="embauchePAT" type="text" class="form-control" name="embauchePAT" value="" style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Statut:</label>
                            <div class="col-md-7">
                                <input id="statutPAT" type="text" class="form-control" name="statutPAT" value="" style="border: none" readonly>
                            </div>
                            

                        </div>
                        </div>
                        </div>

<div class="col-md-12">
   <div class="box">
                <h4 class="box-title" style="color:#7cc404; ">En cas d'urgence aviser</h4>

  <div class="form-group col-md-6">
 
  
                            <label for="login" class="col-md-5 col-form-label text-sm-left">A contacter</label>
                            <div class="col-md-7">
                                <input id="contacterPAT" type="text" class="form-control" name="contacterPAT" value="" style="border: none" readonly>
                            </div>

                          <label for="login" class="col-md-5 col-form-label text-sm-left">Dégré de parenté</label>
                            <div class="col-md-7">
                                <input id="degrePAT" type="text" class="form-control" name="degrePAT" value="" style="border: none" readonly>
                            </div>

                            

                        </div>
 <div class="form-group col-md-6">
<label for="login" class="col-md-5 col-form-label text-sm-left">Numéro de tel</label>
                            <div class="col-md-7">
                                <input id="numeroPAT" type="text" class="form-control" name="numeroPAT" value="" style="border: none" readonly>
                            </div>
                            <label for="login" class="col-md-5 col-form-label text-sm-left">Adresse</label>
                            <div class="col-md-7">
                                <input id="adPAT" type="text" class="form-control" name="adPAT" value=""  style="border: none" readonly>
                            </div>
 </div> 
</div> 
</div>
</div>
 </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Fermer</button>

              </div>
              </form>
              </div>

            
            </div>
    
    
  </div>




</div>



            </div>
 <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" role="form" action="" id="formInfo" name="formInfo">
            <input type="hidden" name="CRCId" id="CRCId" value="" style="border:none;" readonly>
{{ csrf_field() }} 
      <div class="modal-header" style="background:#555555;color:#7cc404 ;text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Fiche de renseignements administratifs</h3>
                <h4 id="cc" class="modal-title" style="text-align: center; color:white;"></h4>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                        <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Prénom du père</label>
                        <div class="col-md-6">
                          <input type="text" name="pere" id="pere" class="form-control input-sm"required>
                      </div>
              </div>
                      <div class="form-group row">
                        <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Prénom et nom de la mère</label>
                        <div class="col-md-6">
                          <input type="text" name="mere" id="mere" class="form-control input-sm" required>
                      </div>
              </div>

                <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Stagiaire diplômée de </label>
                            <div class="col-md-6">
                                <input id="etab" type="text" class="form-control input-sm" name="etab" required>
                            </div>
                        </div>
            
                <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Référence du stagiaire</label>
                            <div class="col-md-6">
                                <input id="ref" type="text" class="form-control input-sm" name="ref" required>
                            </div>
                        </div>
                <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Catégorie </label>
                            <div class="col-md-6">
                                <input id="categorie" type="text" class="form-control input-sm" name="categorie" required >
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Pièce d’identification </label>
                            <div class="col-md-6">
                              <select name="type" id="type" required class="form-control input-sm">
                                <option value="" disabled selected>Sélectionner un type</option>
                                <option value="CIN">CIN</option>
                                <option value="Passeport">Passeport</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">N° de pièce d’identification</label>
                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control input-sm" name="numero" required>
                            </div>
                        </div>
                 <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Date de début du contrat </label>
                            <div class="col-md-6">
                                <input id="debut" type="text" class="form-control input-sm" name="debut" readonly>
                            </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-md-1"></div>
                            <label for="" class="col-md-4 col-form-label text-md-right">Date de fin du contrat </label>
                            <div class="col-md-6">
                                <input id="fin" type="text" class="form-control input-sm" name="fin" readonly>
                            </div>
                        </div>

               </div>
               <div class="modal-footer">
                <button type="button" class="btn pull-left" style="background:#555555;color:white;" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn" style="background:#7cc404;color:white ;">Enregistrer</button>
              </div>
              </form>
            </div>
    
  </div>
</div> 
<!-- -------------------------------------------------------------------------------------------------------------------------  -->
<!-- Modal pour demission  -->
<div class="modal fade modalDemission" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" role="form" action="" id="formDemission" name="formDemission">
            {{ csrf_field() }} 
      <div class="modal-header" style="background-color: #555555;color:#7cc404;text-align: center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Démission 
               <!--  <input id="fonctionPAT" type="text" class="form-control input-sm" name="fonctionPAT"  > -->
                 </h3>
              </div>
              <div class="modal-body">
                <div class="row"> 

              <div class="col-md-6">
              
              <div class="form-group">
                <label>Identifiant</label>
                <input id="IdD" type="text" class="form-control input-sm" name="IdD" readonly value="">
              </div>
              </div>

              <div class="col-md-6">
              <div class="form-group">
                <label>Prénom et Nom</label>
                <input id="pnD" type="text" class="form-control input-sm" name="pnD" readonly value="">
              </div>
              </div>

              </div>
               <div class="row"> 

              <div class="col-md-6">
              
              <div class="form-group">
                <label>Date démission</label>
                <input type="date" class="form-control input-sm pull-right" id="dateDemission" name="dateDemission" required>

              </div>
              </div>

              <div class="col-md-6">
              <div class="form-group">
                <label>Motif demission</label>
                <input id="motif" type="text" class="form-control input-sm" name="motif" required>
                
              </div>
              </div>

              </div>

                 </div>
              <div class="modal-footer">
                <button type="button" class="btn pull-left" style="background-color: #555555; color: white;" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn" style="background-color: #7cc404; color: white;">Valider</button>

              </div>
              </form>
              </div>

            
            </div>
    
    
  </div>       
<!-- Fin Modal pour demission -->  
<!-- Modal pour renouvellement contrat  -->
  <div class="modal fade renouvellement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" role="form" action="renouveler">
            <input type="hidden" name="idEmp" id="idEmp" value="">
            {{ csrf_field() }} 
      <div class="modal-header" style="background-color: #555555; color: #7cc404;text-align: center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Formulaire de renouvellement de contrat 
               <!--  <input id="fonctionPAT" type="text" class="form-control input-sm" name="fonctionPAT"  > -->
                 </h3>
              </div>
              <div class="modal-body">
                <div class="row"> 

              <div class="col-md-6">
              
              <div class="form-group">
                <label>Identifiant</label>
                <input id="IdEmployes" type="text" class="form-control input-sm" name="IdEmployes" readonly value="">
              </div>
              </div>

              <div class="col-md-6">
              <div class="form-group">
                <label>Prénom et Nom</label>
                <input id="pn" type="text" class="form-control input-sm" name="pn" readonly value="">
              </div>
              </div>

              </div>
               <div class="row"> 

              <div class="col-md-6">
              
              <div class="form-group">
                <label>Statut</label>
                
                <select id="statut" name="statut" class="form-control select2" style="width: 100%;">
                  <option value="CEE">CEE</option>
                  <option value="CEE_Beli">CEE_Beli</option> 
                  <option value="CDD">CDD</option>
                  <option value="CDD_Beli">CDD_Beli</option>
                  <option value="CDI">CDI</option>     
                </select>
              </div>
              </div>

              <div class="col-md-6">
              <div class="form-group">
                <label>Nombre de renouvellement</label>
                <input id="countR" type="int" class="form-control input-sm" name="countR">
              </div>
              </div>

              </div>

                 </div>
              <div class="modal-footer">
                <button type="button" class="btn pull-left" style="background-color: #555555; color: white;" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn" style="background-color: #7cc404; color: white;">Renouveler</button>

              </div>
              </form>
              </div>

            
            </div>
    
    
  </div>       
<!-- Fin Modal pour renouvellement contrat  -->  
 <!-- -------------------------------------------------------------------------------------------------------------------------  -->
      
        
      </div>
      </div>
     

    </section>
  </div>
  <div id='loader'></div>
@stop

@section('scripts')


 <script src="{{asset('js/jqueryv2.js')}}"></script> 
 <script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('js/jszip.min.js')}}"></script>
<script src="{{ asset('js/pdfmake.min.js')}}"></script>
<script src="{{ asset('js/vfs_fonts.js')}}"></script>
<script src="{{ asset('js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('js/buttons.print.min.js')}}"></script>
<script src="{{ asset('js/dataTables.select.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('js/tether.min.js')}}"></script>
<script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('AdminLTE//bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>


<script type="text/javascript">

    $(document).ready(function() {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
      
      dom: "<'ui grid'"+
     "<'col-md-12'"+
        "<'four wide column'l>"+
        "<'center aligned eight wide column'B>"+
        "<'right aligned four wide column'f>"+
     ">"+
     "<'col-md-12 dt-table'"+
        "<'sixteen wide column'tr>"+
     ">"+
     "<'col-md-12'"+
        "<'seven wide column'i>"+
        "<'right aligned nine wide column'p>"+
     ">"+
    ">",

buttons: [
             { extend: 'excelHtml5', footer: true,
             text: 'Exporter', 
             filename: function(){
                var date = new Date();

                var d = date.getDate();
                var m = date.getMonth()+1;
                var y = date.getFullYear();


                var dateString = (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;
                return 'Carriere '+dateString;
            },
           },
           ]

    }); 
    
    
  });

  $('#dateEmbauche').datepicker({
      autoclose: true,
      format:'yyyy-mm-dd',
      showInputs: false,
    });
  $('#dateFormation').datepicker({
      autoclose: true
  });

</script>
<script>
  $('.select2').select2();
</script>

<script type="text/javascript">
       $(function(){
  
        $('#upload').click(function() {
            $('#myModal').modal();
        });
        
});

       $('input:radio[name="optionsRadios"]').change(
    function(){
        if (this.checked && this.value == 'Celibataire') {
          var elem = document.getElementById("dateSM");
        elem.style.display='none';
        }
        if (this.checked && this.value == 'Marié(e)') {
          var elem = document.getElementById("dateSM");
          elem.style.visibility='visible';
        elem.style.display='block';
        }
        if (this.checked && this.value == 'Divorcé(e)') {
          var elem = document.getElementById("dateSM");
          elem.style.visibility='visible';
        elem.style.display='block';
        }
        if (this.checked && this.value == 'Veuf(e)') {
          var elem = document.getElementById("dateSM");
          elem.style.visibility='visible';
        elem.style.display='block';
        }
    });

</script>
<script type="text/javascript">
   $('.edit').on('show.bs.modal', function(a) {
    $('#pere').val('');
    $('#CRCId').val('');
        $('#mere').val('');
        $('#categorie').val('');
        $('#etab').val('');
        $('#emploi').val('');
        $('#type').val('');
        $('#numero').val('');
        $('#debut').val('');
        $('#fin').val('');
        // $('#adr').val('');
        // $('#datenaiss').val('');
        // $('#lieu').val('');
        // $('#nat').val('');
        // $('#sexe').val('');
        var Id = $(a.relatedTarget).data('agent_id');
        var p = $(a.relatedTarget).data('agent_p');
        var n = $(a.relatedTarget).data('agent_n');
        $('#CRCId').val(Id);
        document.getElementById("cc").innerHTML =  p+' '+n;
        $('#pere').val($(a.relatedTarget).data('agent_pere'));
        $('#mere').val($(a.relatedTarget).data('agent_mere'));
        $('#categorie').val( $(a.relatedTarget).data('agent_categorie'));
        $('#etab').val( $(a.relatedTarget).data('agent_etab'));
        $('#ref').val( $(a.relatedTarget).data('agent_emploi'));
        $('#type').val($(a.relatedTarget).data('agent_type'));
        $('#numero').val( $(a.relatedTarget).data('agent_numero'));

        var embauche=$(a.relatedTarget).data('agent_debut');
        var fin=$(a.relatedTarget).data('agent_fin');

        if(fin==''){
          $('#fin').val('');
          $('#debut').val(embauche);
        }else{
          $('#fin').val(fin);
          var d = new Date(fin);
          d.setMonth(d.getMonth() - 6);
          var debut=d.toLocaleDateString();
          $('#debut').val(debut);
        }

});

   $('.bd-example-modal-lg').on('show.bs.modal', function(b) {
    var Ids = $(b.relatedTarget).data('agent_id');
    $('#IdCRC').val(Ids);
          $('#id').val('');
          $('#nom').val('');
          $('#prenom').val('');
          $('#datenaiss').val('');
          $('#lieunaiss').val('');
          $('#situation').val('');
          $('#nationalite').val('');
          $('#email').val('');
          $('#tel').val('');
          $('#adresse').val('');
          $('#niveau').val('');
          $('#parrainage').val('');
          $('#langue').val('');
          $('#langueEP').val('');
          $('#dateET').val('');
          $('#profil').val('');
          $('#resultatET').val('');
          $('#dispo').val('');
          $('#dateFF').val('');
          $('#resultatFF').val('');
          $('#initiale').val('');
          $('#initialeP').val('');
          $('#embauche').val('');
          $('#entreProd').val('');
          // $('#contacter').val('');
          // $('#degre').val('');
          // $('#ad').val('');
          // $('#numero').val('');
    
    $.get('ajax-method?Ids='+Ids, function(data){
      console.log(data);
      if(data.length==0){
        alert("Ce conseiller n'a pas suivi le process RH");
      }else{
      $.each(data, function(index, methodObj){
        
        var nomcandidat=methodObj.Nom;
          $('#id').val(Ids);
          $('#nom').val(methodObj.Nom);
          $('#prenom').val(methodObj.Prenom);
          $('#datenaiss').val(methodObj.CRC_Agents_Datenaiss);
          $('#lieunaiss').val(methodObj.CRC_Agents_Lieunaiss);
          $('#situation').val(methodObj.CRC_Agents_Situationmat);
          $('#nationalite').val(methodObj.CRC_Agents_Nationalite);
          $('#email').val(methodObj.CRC_Agents_Email);
          var tel=methodObj.CRC_Agents_Tel_1+ '/'+methodObj.CRC_Agents_Tel_2;
          $('#tel').val(tel);
          $('#adresse').val(methodObj.CRC_Agents_Adresse);
          $('#niveau').val(methodObj.CRC_Agents_Niveau);
          $('#parrainage').val(methodObj.CRC_Agents_Parrainage);
          $('#langue').val(methodObj.Langues);
          $('#langueEP').val(methodObj.Langues_EP);
          $('#dateET').val(methodObj.CRC_ET_Date);
          $('#profil').val(methodObj.CRC_ET_Profil);
          $('#resultatET').val(methodObj.CRC_ET_Resultat);
          $('#dispo').val(methodObj.CRC_ET_Dispo);
          $('#dateFF').val(methodObj.CRC_FF_Date);
          $('#resultatFF').val(methodObj.CRC_FF_Resultat);
          $('#initiale').val(methodObj.CRC_FI_Intitule);
          
          var p=methodObj.CRC_FI_DateDebut+ ' -- '+methodObj.CRC_FI_DateFin;
          $('#initialeP').val(p);
          $('#embauche').val(methodObj.Date_Embauche);
          $('#entreProd').val(methodObj.CRC_Agents_EntreeProd);
          // $('#contacter').val(methodObj.AContacter);
          // $('#degre').val(methodObj.Degre_parent);
          // $('#ad').val(methodObj.Adresse_AContacter);
          // $('#numero').val(methodObj.Tel_AContacter);

      });
    }
    });


      });

   $('.example-modal-lg').on('show.bs.modal', function(d) {
    var identifiant = $(d.relatedTarget).data('agent_id');
    
    $('#IdCRCPAT').val(identifiant);
          $('#idPAT').val('');
          $('#nomPAT').val('');
          $('#prenomPAT').val('');
          $('#situationPAT').val('');
          $('#nationalitePAT').val('');
          $('#statutPAT').val('');
          $('#embauchePAT').val('');
          $('#contacterPAT').val('');
          $('#degrePAT').val('');
          $('#adPAT').val('');
          $('#numeroPAT').val('');
    
    $.get('ajax-fiche?identifiant='+identifiant, function(data1){

      $.each(data1, function(index, methodObj){
        
          $('#idPAT').val(identifiant);
          $('#nomPAT').val(methodObj.Nom);
          $('#prenomPAT').val(methodObj.Prenom);
          $('#fonctionPAT').val(methodObj.Fonction);
          $('#situationPAT').val(methodObj.Situation_mat);
          $('#nationalitePAT').val(methodObj.Nationalite);
          $('#statutPAT').val(methodObj.Statut);
          $('#embauchePAT').val(methodObj.Date_Embauche);
          $('#contacterPAT').val(methodObj.AContacter);
          $('#degrePAT').val(methodObj.Degre_parent);
          $('#adPAT').val(methodObj.Adresse_AContacter);
          $('#numeroPAT').val(methodObj.Tel_AContacter);


      });

    });


      });

   $('.renouvellement').on('show.bs.modal', function(c) {
    var IdEmploye = $(c.relatedTarget).data('agent_id');
    var statutEmploye = $(c.relatedTarget).data('agent_statut');
    var countR = $(c.relatedTarget).data('agent_renouvelllement');
    var prenom = $(c.relatedTarget).data('agent_prenom');
    var nom = $(c.relatedTarget).data('agent_nom');
    var pn=prenom+' '+nom;

    $('#idEmp').val(IdEmploye);
    $('#IdEmployes').val(IdEmploye);
    $('#pn').val(pn);
    $('#countR').val(countR);
    $('#statut').append('<option value="'+statutEmploye+'"  selected>'+statutEmploye+'</option>');
     });

    //------------------demissionnnerrrrr---------------------------
    $('.modalDemission').on('show.bs.modal', function(q) {
      $('#idD').val('');
      $('#pnD').val('');
      $('#motif').val('');
    var IdD= $(q.relatedTarget).data('agent_idd');
    var prenomD = $(q.relatedTarget).data('agent_prenomd');
    var nomD = $(q.relatedTarget).data('agent_nomd');
    var pn=prenomD+' '+nomD;

    $('#IdD').val(IdD);
    $('#pnD').val(pn);
     });
</script>
<script type="text/javascript">
  $('#formDemission').on('submit',function(evente){
  evente.preventDefault();
  IdD = $('#IdD').val();
  dateDemission = $('#dateDemission').val();
  motif = $('#motif').val();
  $.ajax({
      url: "demissionner",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        IdD:IdD,
        dateDemission:dateDemission,
        motif:motif,
      },
      success:function(response){
        $('.modalDemission').modal('toggle');
        if(response.status==true){
          Swal.fire({
          position: 'center',
          icon: 'success',
          title: response.message,
          showConfirmButton: false,
          timer: 1500

        });
        }
        else{
          Swal.fire({
          icon: 'error',
          html: response.message
        });
        }
        window.location.href = "carriere";
      }
     });
});

// generer le contrat d'un conseiller
function voircontrat(btn) {
  var row = btn.parentNode.parentNode;
  console.log(btn.value);
  
  document.getElementById("contrat").disabled=true;
  document.getElementById("contrat").innerHTML = '<span class="glyphicon glyphicon-repeat fast-right-spinner"></span> <b>Ouverture en cours ...</b>';
      
  $.ajax({
  url: "generercontrat",
  type:"POST",
  data:{
    "_token": "{{ csrf_token() }}",
    contrat:btn.value,
  },
  beforeSend: function(){
     console.log('debut');
  },
  success:function(response){
    if(response.status==true){
      window.open('pdf/Contrat.pdf', '_blank');
     }
  },
  complete:function(data){
      document.getElementById("contrat").disabled=false;
      document.getElementById("contrat").innerHTML = '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>';
      
  },
 });
}


 //completer info pour contrat

 $('#formInfo').on('submit',function(e){
  e.preventDefault();
  CRCId = $('#CRCId').val();
 console.log(CRCId);
  $.ajax({
      url: "saveIntegration",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        CRCId:$('#CRCId').val(),
        pere : $('#pere').val(),
        mere:$('#mere').val(),
        categorie:$('#categorie').val(),
        etab:$('#etab').val(),
        ref : $('#ref').val(),
        type:$('#type').val(),
        numero:$('#numero').val(),
        debut:$('#debut').val(),
        fin:$('#fin').val()
      },
      success:function(response){
        $('.edit').modal('toggle');
        if(response.status==true){
          Swal.fire({
          position: 'center',
          icon: 'success',
          title: response.message,
          showConfirmButton: false,
          timer: 1500

        });
        }
        else{
          Swal.fire({
          icon: 'error',
          html: response.message
        });
        }
        window.location.href = "carriere";
      }
     });
});

</script>

@endsection

