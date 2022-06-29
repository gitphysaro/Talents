@extends('layouts.layout')

 @section('ficheET') 


 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fiche Candidat: Etape entretien téléphonique
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li><a href="entretienTel"><i class="fa fa-phone"  aria-hidden="true"></i> Entretien Téléphonique</a></li>
        <li class="active">Fiche Candidat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
 @foreach ($infos as $data) 
<div class="box box-default">
        <div class="box-header with-border">
          <h2 class="box-title">Détails du CV de l'agent: <b style="color: #7cc404">{{$data->Id_Candidat}}</b></h2>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
         
<form method="post" role="form" id="formSaisieCV" name="formSaisieCV" action="">
                     <input type="hidden" name="idCandidat" id="idCandidat" value="{{$data->Id_Candidat}}">
{{ csrf_field() }} 

        <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Informations personnelles</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-3">
              <div class="form-group">
                <label>Nom <strong style="color:red;">*</strong></label>
                <input id="nomAgent" name="nomAgent" onkeydown="if(event.keyCode==32 || event.keyCode==86) return false;" type="text" class="form-control input-sm" required="required" value="{{$data->CRC_Agents_Nom}}">
                </div>
              <div class="form-group">
                <label>Prénom 1 <strong style="color:red;">*</strong></label>
                <input id="prenomAgent1" onkeydown="if(event.keyCode==32 || event.keyCode==86) return false;" name="prenomAgent1" type="text" class="form-control input-sm" required="required"  value="{{$data->CRC_Agents_Prenom}}">
              </div>
              
              <div class="form-group">
                <label>Prénom 2 </label>
                <input id="prenomAgent2" onkeydown="if(event.keyCode==32 || event.keyCode==86) return false;" name="prenomAgent2" type="text" class="form-control input-sm"  placeholder="Saisir le prénom 2" value="{{$data->CRC_Agents_Prenom2}}">
              </div>
              <div class="form-group">
                <label>Prénom 3</label>
                <input id="prenomAgent3" onkeydown="if(event.keyCode==32 || event.keyCode==86) return false;" name="prenomAgent3" type="text" class="form-control input-sm"  placeholder="Saisir le prénom 3" value="{{$data->CRC_Agents_Prenom3}}">
              </div>
              
            </div>
            <div class="col-md-3">
            <div class="form-group">
                <label>Prénom 4</label>
                <input id="prenomAgent4" onkeydown="if(event.keyCode==32 || event.keyCode==86) return false;" name="prenomAgent4" type="text" class="form-control input-sm" placeholder="Saisir le prénom 4" value="{{$data->CRC_Agents_Prenom4}}">
              </div>
            
              <div class="form-group">
                <label>Date de naissance <strong style="color:red;">*</strong></label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datenaissAgent" name="datenaissAgent" required="required" value="{{$data->CRC_Agents_Datenaiss}}">
                </div>
              
              </div>
              <div class="form-group">
                <label>Lieu de naissance <strong style="color:red;">*</strong></label>
                <input id="lieunaissAgent" name="lieunaissAgent" type="text" class="form-control input-sm" required="required" value="{{$data->CRC_Agents_Lieunaiss}}">
                
              
              </div>
              <div class="form-group">
                <label>Genre <strong style="color:red;">*</strong></label>
                <select id="sexeAgent" name="sexeAgent" class="form-control select2" style="width: 100%;" required="required">
                @if($data->CRC_Agents_Sexe =='Femme')
                  <option value="{{$data->CRC_Agents_Sexe}}" selected>{{$data->CRC_Agents_Sexe}}</option>
                  <option value="Homme">Homme</option>
                  @elseif($data->CRC_Agents_Sexe =='Homme')
                  <option value="Femme">Femme</option>
                  <option value="{{$data->CRC_Agents_Sexe}}" selected>{{$data->CRC_Agents_Sexe}}</option>
                 @else
                 <option value="" disabled selected>Sélectionner le genre</option>
                 <option value="Femme">Femme</option>
                 <option value="Homme">Homme</option>
                 @endif
                </select>
              </div>
            </div>

            <div class="col-md-3">
            <div class="form-group">
                <label>Situation matrimoniale</label>
                <select id="smAgent" name="smAgent" class="form-control select2" style="width: 100%;" required="required">
                  <option value="Célibataire">Célibataire</option>
                  <option value="Marié(e)">Marié(e)</option>
                  <option value="Divorcé(e)">Divorcé(e)</option>
                  <option value="Veuf(e)">Veuf(e)</option>
                  <option value="{{$data->CRC_Agents_Situationmat}}" selected>{{$data->CRC_Agents_Situationmat}}</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nationalité <strong style="color:red;">*</strong></label>
                <select id="nationaliteAgent" name="nationaliteAgent" class="form-control input-sm" style="width: 100%;">
                  
                  @foreach ($listenationalite as $d )
                  @if($data->CRC_Agents_Nationalite == $d->Nationalites )
                  <option value="{{$data->CRC_Agents_Nationalite}}" selected>{{$data->CRC_Agents_Nationalite}}</option>
                  @else
                     <option value="{{$d->Nationalites}}">{{ $d->Nationalites}}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              

              <div class="form-group">
                <label>Téléphone1 <strong style="color:red;">*</strong></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input id="telAgent1" name="telAgent1" disabled type="number" class="form-control input-sm" required="required" value="{{$data->CRC_Agents_Tel_1}}">
                </div>
              </div>
              <div class="form-group">
                <label>Téléphone2</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input id="telAgent2" name="telAgent2" disabled type="number" class="form-control input-sm" value="{{$data->CRC_Agents_Tel_2}}">
                </div>
              </div>
              

              </div>

              <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input id="emailAgent" name="emailAgent" type="email" class="form-control input-sm"   value="{{$data->CRC_Agents_Email}}" required="required">
              </div>
              </div>
                <div class="form-group">
                <label>Adresse <strong style="color:red;">*</strong></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </div>
                 <input id="adresseAgent" name="adresseAgent" type="text" class="form-control input-sm" value="{{$data->CRC_Agents_Adresse}}">
               </div>
              </div>
              <div class="form-group">
                <label>Ville <strong style="color:red;">*</strong></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </div>
                <input id="villeAgent" name="villeAgent" type="text" class="form-control input-sm" placeholder="Saisir la ville" value="{{$data->CRC_Agents_Ville}}" required>
              </div>
              </div>
              <div class="form-group">
                <label>Code Postal</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </div>
                <input id="cpAgent" name="cpAgent" type="text" class="form-control input-sm" placeholder="Saisir le code postal" value="{{$data->CRC_Agents_CP}}">
              </div>
              </div>
              </div>

          </div>
          </div>
          <br/>

          <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Compétences</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            

          <div class="col-md-3">
                 <div class="form-group">
                <label>Niveau d'étude</label>
                <select id="niveauAgent" name="niveauAgent" class="form-control select2" >
                  @if($data->CRC_Agents_Niveau=='')
                  <option value="" disabled selected>Sélectionner le niveau</option>
                  @endif
                  @foreach($listeNiveau as $l)
                  @if($l->Niveau==$data->CRC_Agents_Niveau)
                  <option value="{{$data->CRC_Agents_Niveau}}"  selected>{{$data->CRC_Agents_Niveau}}</option>
                  @else
                  <option value="{{$l->Niveau}}" >{{$l->Niveau}}</option>
                  @endif
                  @endforeach
                  </select>
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-group">
                <label>Formation suivie</label>
                <input id="competenceAgent" name="competenceAgent" type="text" class="form-control input-sm" value="{{$data->CRC_Agents_Competence}}">
                
              </div>
              </div>
            <div class="col-md-3">
              
              <div class="form-group">
                <label>Expérience centre d'appel</label>
                <select id="experienceAgent" name="experienceAgent" class="form-control select2">
                @if($data->CRC_Agents_ExperienceCA=='')
                  <option value="" disabled selected>Sélectionner l'experience</option>
                  @endif
                  @foreach($listeExperience as $l)
                  @if($l->Exp==$data->CRC_Agents_ExperienceCA)
                  <option value="{{$data->CRC_Agents_ExperienceCA}}"  selected>{{$data->CRC_Agents_ExperienceCA}}</option>
                  @else
                  <option value="{{$l->Exp}}" >{{$l->Exp}}</option>
                  @endif
                  @endforeach
                    
                  </select>
              </div>
              
              </div>
               <div class="col-md-3">
              
              <div class="form-group">
                <label>Langues</label>
               <select class="form-control select2" id="langueAgent" name="langueAgent[]" multiple="multiple"
                        style="width: 100%;">
                        
                    <option value="{{$data->CRC_Agents_Langues}}" selected>{{$data->CRC_Agents_Langues}}</option>
                    
                    <option value="Français">Français</option>
                    <option value="Anglais">Anglais</option>
                    <option value="Autres">Autres</option>
            </select>
              </div>
              </div>

            </div>
             </div>
             <br/>

         <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Autres</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            

             <div class="col-md-3">
              <div class="form-group">
                <label>Source du CV</label>
                <select id="sourceCVAgent" name="sourceCVAgent" class="form-control select2" style="width: 100%;">
                   @if($data->CRC_Agents_SourceCV =='En ligne')
                  <option value="{{$data->CRC_Agents_SourceCV}}" selected>{{$data->CRC_Agents_SourceCV}}</option>
                  <option value="Dépot physique">Dépot physique</option>
                  @elseif($data->CRC_Agents_SourceCV =='Dépot physique')
                  <option value="{{$data->CRC_Agents_SourceCV}}" selected>{{$data->CRC_Agents_SourceCV}}</option>
                  <option value="En ligne">En ligne</option>
                  @else
                  <option value="" disabled selected>Sélectionner la source</option>
                  <option value="En ligne">En ligne</option>
                  <option value="Dépot physique">Dépot physique</option>
                  @endif
                </select>
                
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label>Parrainage</label>
                <select id="parrainageAgent" name="parrainageAgent" class="form-control select2" style="width: 100%;">
                  
                  @if($data->CRC_Agents_Parrainage =='Oui')
                  <option value="{{$data->CRC_Agents_Parrainage}}" selected>{{$data->CRC_Agents_Parrainage}}</option>
                  <option value="Non">Non</option>
                  @elseif($data->CRC_Agents_Parrainage =='Non')
                  <option value="{{$data->CRC_Agents_Parrainage}}" selected>{{$data->CRC_Agents_Parrainage}}</option>
                  <option value="Oui">Oui</option>
                  @else
                  <option value="" disabled selected>Sélectionner le parrainage</option>
                  <option value="Oui">Oui</option>
                  <option value="Non">Non</option>
                  @endif
                </select>
              </div>
              </div>

            </div>
             </div>

            <div class="col-md-7"></div>
            <div class="col-md-2">
                <div class="form-group">
                <label></label>
                       <button type="button" id="fermer" name="fermer" class="btn btn-block pull-right btn-sm" style="background-color: #555555; color: white"  value="Fermer la fiche" onclick="location.href='entretienTel'">Fermer la fiche</button>
                </div>
                </div> 
              <div class="col-md-3">
                <div class="form-group">
                <label></label>
                        <button type="submit" id="maj" name="maj" class="btn btn-block pull-right btn-sm" style="background-color: #7cc404; color: white">Mettre à jour le CV</button>
                </div>
                </div>
</form>
          </div>
        </div>



          <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Détails de l'entretien téléphonique</h3>
          <?php $max= date("Y-m-d"); ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
<div class="box-body">
  <form method="post" id="formET" name="formET" role="form" action="">
        <input type="hidden" name="idCandidatET" id="idCandidatET" value="{{$data->Id_Candidat}}">
        {{ csrf_field()}} 

        @if(isset ($statutETNouveau)) 
         
              <div class="col-md-3">
              <div class="form-group">
                <label>Date Entretien <strong style="color:red;">*</strong></label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  
                <input type="date" class="form-control input-sm pull-right" id="dateEntretien" name="dateEntretien" max="{{$max}}" required>
               
                  
                </div>
                
              </div>
              </div> 
              <div class="col-md-3">
                <div class="form-group">
                <label>Statut de l'agent <strong style="color:red;">*</strong></label>
                <select id="statutAgentEnt" name="statutAgentEnt" class="form-control select2"   style="width: 100%;" required>
                  <option value="" selected disabled>Sélectionner le statut</option>
                  <option value="KO">KO</option>
                  <option value="OK">OK</option>
                </select>
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label>Profil <strong style="color:red;">*</strong></label>
                <select id="profilAgentEnt" name="profilAgentEnt" class="form-control select2" style="width: 100%;" required>
                  <option value="" selected disabled >Sélectionner le profil</option>
                  <option value="Emission d'appel">Emission d'appel</option>
                  <option value="Réception d'appel">Réception d'appel</option>
                   <option value="Back office">Back office</option>
                </select>
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label>Disponibilité <strong style="color:red;">*</strong></label>
                <select id="dispoAgent" name="dispoAgent" class="form-control select2" style="width: 100%;" required> 
                    <option value="" selected disabled> Sélectionner la disponibilité </option>
                    <option value="Pas disponible">Pas disponible</option>
                    <option value="Immédiate">Immédiate</option>
                    <option value="Dans un mois">Dans un mois</option>
                </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label> Résultat de l'entretien </label>
                <textarea id="resultatET" name="resultatET" rows="4" cols="125" placeholder="Saisir un commentaire" style="resize: none" required>
                  
                </textarea>
              </div>
              </div>

           
  @endif         

  @if(isset ($statutETKO))  
             <div class="col-md-3">
              <div class="form-group">
                <label>Date Entretien </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="date" class="form-control input-sm pull-right" id="dateEntretien" name="dateEntretien" required value="{{$data->CRC_ET_Date}}"  max="{{$max}}">
                </div>
              </div>
              </div> 

              <div class="col-md-3">
                <div class="form-group">
                <label>Statut de l'agent</label>
                <select id="statutAgentEnt" name="statutAgentEnt" class="form-control select2" required style="width: 100%;">
                
                  <option value="{{$data->CRC_ET_Statut}}" selected>{{$data->CRC_ET_Statut}}</option>
                  <option value="OK">OK</option>
                </select>
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label>Profil</label>
                <select id="profilAgentEnt" name="profilAgentEnt" class="form-control select2" style="width: 100%;" required>
                  <option value="{{$data->CRC_ET_Profil}}" selected>{{$data->CRC_ET_Profil}}</option>
                  <option value="Emission d'appel">Emission d'appel</option>
                  <option value="Réception d'appel">Réception d'appel</option>
                  <option value="Back office">Back office</option>
                </select>
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label>Disponibilité</label>
                <select id="dispoAgent" name="dispoAgent" class="form-control select2" style="width: 100%;" required>
                 
                  <option value="{{$data->CRC_ET_Dispo}}" selected>{{$data->CRC_ET_Dispo}}</option>
                 
                    <option value="Pas disponible">Pas disponible</option>
                    <option value="Immédiate">Immédiate</option>
                    <option value="Dans un mois">Dans un mois</option>

                </select>
              </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                <label>Résultat de l'entretien</label>
                  <textarea id="resultatET" name="resultatET" rows="4" cols="125" style="resize: none" value="{{$data->CRC_ET_Resultat}}" required>{{$data->CRC_ET_Resultat}}</textarea>
                </div>
                </div>

 @endif  
              <div class="col-md-7"></div>
            <div class="col-md-2">
                <div class="form-group">
                <label></label>
                       <button type="button" class="btn btn-block pull-right btn-sm" style="background-color: #555555; color: white"  value="Annuler" onclick="location.href='../entretienTel'">Annuler</button>
                </div>
                </div>
              <div class="col-md-3">
                <div class="form-group">
                <label></label>
                        <button type="submit" class="btn btn-block pull-right btn-sm" style="background-color: #7cc404; color: white">Enrégistrer les données de l'entretien</button>
                </div>
                </div>
              </form>
            </div>

            
             </div>
@endforeach
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>

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
<script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('AdminLTE//bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
<script src="{{ asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script >
  $('.select2').select2();

$('#datenaissAgent').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
</script>
<script>
$('#formET').on('submit',function(e){
      e.preventDefault();
      var statutAgentEnt =$('#statutAgentEnt').val();
      var idCandidatET=$('#idCandidatET').val();
      var dateEntretien=$('#dateEntretien').val();
      var profilAgentEnt=$('#profilAgentEnt').val();
      var dispoAgent=$('#dispoAgent').val();
      var resultatET=$('#resultatET').val();
      
  $.ajax({
      url: "enregistrerET",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        idCandidatET:idCandidatET,
        dateEntretien:dateEntretien,
        statutAgentEnt:statutAgentEnt,
        profilAgentEnt:profilAgentEnt,
        dispoAgent:dispoAgent,
        resultatET:resultatET,
      },
      success:function(response){
        if(response.status==true){
          Swal.fire({
          icon: 'success',
          html: response.message,
          confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> Ok',
        }).then((result) => {
          //location.reload();
          window.location.href = 'entretienTel';
        });
        }
        else{
          Swal.fire({
          icon: 'error',
          html: response.message
        });
        }
      },
     });  
});
$('#formSaisieCV').on('submit',function(e){
  e.preventDefault();  
 document.getElementById("fermer").disabled=true;
 document.getElementById("maj").disabled=true;
 document.getElementById("maj").textContent = "Mise à jour du cv en cours ...";
  $.ajax({
      url: "updateCV",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        idCandidat:$('#idCandidat').val(),
        prenomAgent1:$('#prenomAgent1').val(),
        prenomAgent2:$('#prenomAgent2').val(),
        prenomAgent3:$('#prenomAgent3').val(),
        prenomAgent4:$('#prenomAgent4').val(),
        nomAgent:$('#nomAgent').val(),
        sexeAgent:$('#sexeAgent').val(),
        emailAgent:$('#emailAgent').val(),
        datenaissAgent:$('#datenaissAgent').val(),
        lieunaissAgent:$('#lieunaissAgent').val(),
        telAgent1:$('#telAgent1').val(),
        telAgent2:$('#telAgent2').val(),
        adresseAgent:$('#adresseAgent').val(),
        villeAgent:$('#villeAgent').val(),
        cpAgent:$('#cpAgent').val(),
        nationaliteAgent:$('#nationaliteAgent').val(),
        niveauAgent:$('#niveauAgent').val(),
        experienceAgent:$('#experienceAgent').val(),
        sourceCVAgent:$('#sourceCVAgent').val(),
        parrainageAgent:$('#parrainageAgent').val(),
        competenceAgent:$('#competenceAgent').val(),
        langueAgent:$('#langueAgent').val(),
        smAgent:$('#smAgent').val(),
      },
      success:function(response){
        if(response.status==true){
          Swal.fire({
          icon: 'success',
          html: response.message,
          confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> Ok',
        }).then((result) => {
          location.reload();
        });
        }
        else{
          Swal.fire({
          icon: 'error',
          html: response.message
        });
        }
      },
     });  
});
</script>
@endsection