@extends('layouts.layout')

 @section('addAgent') 




  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Saisie d'un CV
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="dashboard"><i class="fa fa-dashboard"></i> Accueil</a></li> -->
        <li class="active">Saisie d'un CV</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <div class="box box-default">
        <div class="box-header with-border">
          <h2 class="box-title">Formulaire de saisie</h2>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          
<form class="form" id="formSaisieCV" name="formSaisieCV" method="post" role="form" action="">
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
                <input id="nomAgent" onkeydown="if(event.keyCode==32) return false;" name="nomAgent" type="text" class="form-control input-sm" required="required" placeholder="Saisir le nom">
                
              </div>
              <div class="form-group">
                <label>Prénom 1 <strong style="color:red;">*</strong></label>
                <input id="prenom1" onkeydown="if(event.keyCode==32) return false;" name="prenom1" type="text" class="form-control input-sm" required="required" placeholder="Saisir le prénom 1">
              </div>
              <div class="form-group">
                <label>Prénom 2</label>
                <input id="prenom2" onkeydown="if(event.keyCode==32) return false;" name="prenom2" type="text" class="form-control input-sm"  placeholder="Saisir le prénom 2">
              </div>
              <div class="form-group">
                <label>Prénom 3</label>
                <input id="prenom3" onkeydown="if(event.keyCode==32) return false;" name="prenom3" type="text" class="form-control input-sm"  placeholder="Saisir le prénom 3">
              </div>
              
              
            </div>
            <div class="col-md-3">
            <div class="form-group">
                <label>Prénom 4</label>
                <input id="prenom4" onkeydown="if(event.keyCode==32) return false;" name="prenom4" type="text" class="form-control input-sm" placeholder="Saisir le prénom 4">
              </div>
            
              <div class="form-group">
                <label>Date de naissance <strong style="color:red;">*</strong></label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control input-sm" id="datenaissAgent" name="datenaissAgent" required="required" placeholder="Selectionner la date de naissance" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                </div>
              
              </div>
              <div class="form-group">
                <label>Lieu de naissance <strong style="color:red;">*</strong></label>
                <input id="lieunaissAgent" name="lieunaissAgent" type="text" class="form-control input-sm" placeholder="Saisir le lieu de naissance">
              
              </div>
              <div class="form-group">
                <label>Genre <strong style="color:red;">*</strong></label>
                <select id="sexeAgent" name="sexeAgent" class="form-control select2" style="width: 100%;" required>
                  <option value="" disabled selected>Selectionner le genre</option>
                  <option value="Femme">Femme</option>
                  <option value="Homme">Homme</option>
                </select>
              </div>
              
            </div>

            <div class="col-md-3">
            
              <div class="form-group">
                <label>Situation matrimoniale</label>
                <select id="smAgent" name="smAgent" class="form-control select2" style="width: 100%;">
                  <option value="" disabled selected>Selectionner la situation matrimoniale</option>
                  <option value="Célibataire">Célibataire</option>
                  <option value="Marié(e)">Marié(e)</option>
                  <option value="Divorcé(e)">Divorcé(e)</option>
                  <option value="Veuf(e)">Veuf(e)</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nationalité <strong style="color:red;">*</strong></label>
                <select id="nationaliteAgent" name="nationaliteAgent" class="form-control select2" style="width: 100%;" required="required" >
                  <option value="" disabled selected>Selectionner la nationalité</option>
                  @foreach ($listenationalite as $data )
                     <option value="{{$data->Nationalites}}">{{ $data->Nationalites}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group" >
                <label style="margin-top:4px;">Téléphone 1 <strong style="color:red;">*</strong></label>
                <div class="input-group">
                <?php $pays=''; ?>
                  @if(Auth::user()->CentreUser == 1) 
                  <?php $pays='sn'; ?>
                  @elseif(Auth::user()->CentreUser == 5) 
                  <?php $pays='ma'; ?>
                  @endif
                  <input id="telAgent1" onkeydown="if(event.keyCode==32) return false;" name="telAgent1" type="tel" class="form-control input-sm" required="required" placeholder="Saisir le numero de telephone 1" 
                  pattern="[7]{1}[0-9]{8}" maxlength="9"  title="9 digits" style="width:200%;" required/>
                 
                </div>  
              </div>
              <div class="form-group" style="margin-top:-5px;">
                <label style="margin-top:0px;">Téléphone 2</label>
                <div class="input-group">
                  <input id="telAgent2" pattern="[7]{1}[0-9]{8}" style="width:200%;" onkeydown="if(event.keyCode==32 ) return false;" name="telAgent2" type="tel" class="form-control input-sm"  placeholder="Saisir le numero de telephone 2">
                </div>  
              </div>
              </div>

              <div class="col-md-3">
              <div class="form-group">
                <label>Email <strong style="color:red;">*</strong></label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input id="emailAgent" onkeydown="if(event.keyCode==32) return false;" name="emailAgent" type="email" class="form-control input-sm" required="required" placeholder="Saisir l'adresse email" required="required">
              </div>
              </div>
                <div class="form-group">
                <label>Adresse <strong style="color:red;">*</strong></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </div>
                <input id="adresseAgent" name="adresseAgent" type="text" class="form-control input-sm" placeholder="Saisir l'adresse">
              </div>
              </div>
              <div class="form-group">
                <label>Ville <strong style="color:red;">*</strong></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </div>
                <input id="ville" name="ville" type="text" class="form-control input-sm" placeholder="Saisir la ville" required>
              </div>
              </div>
              <div class="form-group">
                <label>Code Postal</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </div>
                <input id="cp" name="cp" type="text" class="form-control input-sm" placeholder="Saisir le code postal">
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
                <select id="niveauAgent" name="niveauAgent" class="form-control select2">
                    <option value="" disabled selected>Selectionner le niveau</option>
			<option value="Bfem">Bfem</option>
                    <option value="Bac">Bac</option>
                    <option value="Bac + 1">Bac + 1</option>
                    <option value="Bac + 2">Bac + 2</option>
                    <option value="Bac + 3">Bac + 3</option>
                    <option value="Bac + 4">Bac + 4</option>
                    <option value="Bac + 5">Bac + 5</option>
                  </select>
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-group">
                <label>Formation suivie</label>
                <input id="competenceAgent" name="competenceAgent" type="text" class="form-control input-sm" placeholder="Saisir la formation suivie">
                
              </div>
              </div>
              

            <div class="col-md-3">
              
              <div class="form-group">
                <label>Expérience centre d'appel</label>
                <select id="experienceAgent" name="experienceAgent" class="form-control select2">
                  <option value="" disabled selected>Selectionner l'experience CA</option>
                    <option value="Pas d'expérience"> Pas d'expérience</option>
                    <option value="0 - 1an">0 - 1an</option>
                    <option value="1 - 3ans">1 - 3ans</option>
                    <option value="3ans et plus">3ans et plus</option>
                  </select>
              </div>
              
              </div>
              <div class="col-md-3">
              
              <div class="form-group">
                <label>Langues</label>
               <select class="form-control select2" id="langue" name="langue[]" multiple="multiple"
                        style="width: 100%;">
                    <option value="" disabled selected>Selectionner les langues</option>    
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
          <h3 class="box-title">Autres infos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            

             <div class="col-md-3">
              <div class="form-group">
                <label>Source du CV</label>
                <select id="sourceCVAgent" name="sourceCVAgent" class="form-control select2" style="width: 100%;">
                  <option value="" disabled selected>Selectionner la source</option>
                  <option value="En ligne">En ligne</option>
                  <option value="Dépot physique">Dépot physique</option>
                </select>
                
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label>Parrainage</label>
                <select id="parrainage" name="parrainage" class="form-control select2" required="required" style="width: 100%;">
                  <option value="" disabled selected>Selectionner le parrainage</option>
                  <option value="Oui">Oui</option>
                  <option value="Non">Non</option>
                </select>
              </div>
              </div>

            </div>
             </div>

            <div class="col-md-8"></div>
            <div class="col-md-2">
                <div class="form-group">
                <label></label>
                       <button type="button" class="btn btn-block pull-right btn-sm" style="background-color: #555555; color: white" id="annuler"  value="Annuler" onclick="location.href='dashboard'">Annuler</button>
                </div>
                </div>
              <div class="col-md-2">
                <div class="form-group">
                <label></label>
                        <button type="submit" id="ajouter" name="ajouter" class="btn btn-block pull-right input-sm" style="background-color: #7cc404; color: white;">Sauvegarder</button>
                </div>
                </div>
</form>
          </div>
        </div>
        </div>
        </div>
    </section>
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
<script src="{{ asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script type="text/javascript">
  window.setTimeout(function() {
    $(".alert").fadeTo(00, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
 <script >
$('#datenaissAgent').datepicker({
  format: 'yyyy-mm-dd',
      autoclose: true,
      showInputs: false,
    });
$('.select2').select2();
</script>

<script type="text/javascript">
$('#formSaisieCV').on('submit',function(e){
  e.preventDefault();
      var  prenom1=$('#prenom1').val();
        prenom2=$('#prenom2').val();
        prenom3=$('#prenom3').val();
        prenom4=$('#prenom4').val();
        nomAgent=$('#nomAgent').val();
        datenaissAgent=$('#datenaissAgent').val();
        lieunaissAgent=$('#lieunaissAgent').val();
        telAgent1=$('#telAgent1').val();
        telAgent2=$('#telAgent2').val();
        adresseAgent=$('#adresseAgent').val();
        ville=$('#ville').val();
        cp=$('#cp').val();
        nationaliteAgent=$('#nationaliteAgent').val();
        
        document.getElementById("annuler").disabled=true;
        document.getElementById("ajouter").disabled=true;
        document.getElementById("ajouter").textContent = "Sauvegarde du cv en cours ...";
  $.ajax({
      url: "saveCV",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        prenom1:$('#prenom1').val(),
        prenom2:$('#prenom2').val(),
        prenom3:$('#prenom3').val(),
        prenom4:$('#prenom4').val(),
        nomAgent:$('#nomAgent').val(),
        sexeAgent:$('#sexeAgent').val(),
        emailAgent:$('#emailAgent').val(),
        datenaissAgent:$('#datenaissAgent').val(),
        lieunaissAgent:$('#lieunaissAgent').val(),
        telAgent1:phoneInput.getNumber(),
        telAgent2:phoneInput2.getNumber(),
        adresseAgent:$('#adresseAgent').val(),
        ville:$('#ville').val(),
        cp:$('#cp').val(),
        nationaliteAgent:$('#nationaliteAgent').val(),
        niveauAgent:$('#niveauAgent').val(),
        experienceAgent:$('#experienceAgent').val(),
        sourceCVAgent:$('#sourceCVAgent').val(),
        parrainage:$('#parrainage').val(),
        competenceAgent:$('#competenceAgent').val(),
        langue:$('#langue').val(),
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
<script>
   const phoneInputField = document.querySelector("#telAgent1");
   const phoneInputField2 = document.querySelector("#telAgent2");
   var variableRecuperee = <?php echo json_encode($pays); ?>;
   preferredCountries=[];
   if(variableRecuperee=='ma'){
      preferredCountries= ["ma"];
     }
     else if(variableRecuperee=='sn'){
      preferredCountries= ["sn"];
    }
   const phoneInput = window.intlTelInput(phoneInputField, {
    preferredCountries: preferredCountries,
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
const phoneInput2 = window.intlTelInput(phoneInputField2, {
    preferredCountries: preferredCountries,
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
 </script>

@endsection