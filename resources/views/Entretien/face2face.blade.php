  @extends('layouts.layout')

@section('face2face') 


    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Etape 2: Face 2 Face
        </h1>
        <ol class="breadcrumb">
          <!-- <li><a href="dashboard"><i class="fa fa-dashboard"></i> Accueil</a></li> -->
          <li class="active">Face to Face</li>
        </ol>
      </section>

      
      <section class="content">
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
            <form class="form" method="post" role="form" action="searchFacetoFace">
                {{ csrf_field() }} 
            <div class="col-md-4">

               <div class="form-group">
                  <label>Période Entretien</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control input-sm pull-right" id="periodeEntretien" name="periodeEntretien">
                  </div>
                </div>
           
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Parrainage</label>
                  <select id="parrainageAgent" name="parrainageAgent" class="form-control select2">
                    <option value="" disabled selected>Select parrainage</option>
                      <option value="Oui">Oui</option>
                      <option value="Non">Non</option>
                    </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Disponibilité</label>
                  <select id="dispoAgent" name="dispoAgent" class="form-control select2">
                    <option value="" disabled selected>Select disponibilité</option>
                    <option value="Pas disponible">Pas disponible</option>
                      <option value="Immédiate">Immédiate</option>
                      <option value="Dans un mois">Dans un mois</option>
                    </select>
                </div>   
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Statut Face2Face </label>
                   <select id="statutFacetoFace" name="statutFacetoFace" class="form-control select2" style="width: 100%;">
                    <option value="" disabled selected>Select statut</option>
                    <option value="Nouveau">Nouveau</option>
                    <option value="KO">KO</option>
                  </select>
                </div>

                </div>

                <div class="col-md-2">
                  
                <div class="form-group">
                  <button type="submit" class="btn btn-block pull-right btn-sm" style="background-color: #7cc404; color: white;margin-top:25px;">Rechercher</button>
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
                <h3 class="box-title">Liste des candidats</h3>
              </div>
              <div class="box-body">
                        
                <table id="example2" class="table table-bordered table-hover">
                  <thead style="background-color: #555555; color: white;">
                  <tr>
                    <th>Id Candidat</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Date et lieu naissance</th>
                    <th>Profil</th>
                    <th>Parrainage</th>
                    <th>Date EntretienTel</th>
                    <th>Disponibilité</th>
                    <th>Statut FF</th>
                    <th>Face to Face</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($donneesFF as $FF) 
                          <tr>
                            <td>{{$FF->Id_Candidat}}</td>
                             <td> {{$FF->Nom }}</td> 
                             <td> {{$FF->Prenom}} {{$FF->Prenom2}} {{$FF->Prenom3}} {{$FF->Prenom4}}</td> 
                             <td> {{$FF->Date_naissance }}  {{$FF->Lieu_naissance }}</td> 
                             <td> {{$FF->Profil }}</td>
                             <td> {{$FF->Parrainage }}</td>
                             <td> {{$FF->Date_EntretienTel }}</td> 
                             <td> {{$FF->Disponibilite}}</td> 
                             <td> {{$FF->Statut_Candidat}}</td> 
                             <td><button class="btn" style="background-color: #7cc404; color: #555555;" data-toggle="modal" data-target="#facetoface-modal" data-backdrop="static" data-keyboard="false" data-agent_id="{{ $FF->Id_Candidat }}"
                              data-agent_nom="{{$FF->Nom }}" data-agent_prenom="{{$FF->Prenom}}" data-agent_dt="{{$FF->DateEntretien}}" title="infos face to face">
                                  <i class="fa fa-handshake-o" aria-hidden="true"></i>
                            </button> 
                          </td>
                          </tr>
                          @endforeach
                  
                  
                  </tbody>
                  <tfoot>
                    <tr></tr>
                  </tfoot>
                </table>
              
            
          
          
        </div>
        </div>
        </div>
  </div>



  <!-- ------------------------------------------------Modal face 2 face------------------------------------------------------------------------------------ -->
  <div class="modal fade" id="facetoface-modal" tabindex="-1" role="dialog" aria-hidden="true" >
    <form method="post" role="form" action="" id="formFF" name="formFF">
            {{ csrf_field() }}

            <div class="modal-dialog">
              <div class="modal-content">
              <input type="hidden" name="nomFF" id="nomFF">
              <input type="hidden" name="prenomFF" id="prenomFF">
                <div class="modal-header" style="background-color: #555555; color: #7cc404;text-align:center">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Informations relatives au face to face</h3>
                  <h5 class="modal-title" id="info"></h5>
                </div>
                <div class="modal-body">
               <div class="col-md-6">
                <div class="form-group">
                  <label>Identifiant</label>
                  <input type="number" class="form-control input-sm" id="identifiantFF" name="identifiantFF" readonly="readonly" >
                </div> 
                </div> 

                 <div class="col-md-6">
                <div class="form-group">
                  <label>Prenom et Nom</label>
                   <input type="text" class="form-control input-sm" id="prenomNom" name="prenomNom" readonly="readonly"  >
                </div>

                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Date Face2face</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" id="dateFF" min="" name="dateFF" max="<?php echo date('Y-m-d') ?>" required>
                  </div>
                 
                </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                  <label>Statut Face2Face</label>
                  <select id="statutAgentFF" name="statutAgentFF" class="form-control" required>
                    <option value="" selected disabled>Sélectionner le statut</option>
                    <option value="KO">KO</option>
                    <option value="OK">OK</option>
                  </select>
                </div>
                  </div>
              
                <div class="col-md-12">
                <div class="form-group">
                  <label>Résultat Face2Face</label>
                  <textarea class="form-control" id="resultatFF" name="resultatFF" rows="3" style="resize: none" required></textarea>
                </div>
              </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="background-color: #555555; color: white;">Annuler</button>
                  <button id="submitButton" name="submitButton" type="submit" class="btn" style="background-color: #7cc404; color: white;">Enrégistrer</button>
                </div>

                 
                </div>
                
              </div>
              </form>
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
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
<script src="{{ asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'lengthMenu': [[15, 25, 50, -1], [15, 25, 50, 'All']],
        
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
                  return 'Face to face '+dateString;
              },
             },
          ],
      });
    });
  </script>
    <script>
  $('#dateSaisieDebut').datepicker({
    format: 'yyyy-mm-dd',
        autoclose: true
      });
  $('#dateSaisieFin').datepicker({
    format: 'yyyy-mm-dd',
        autoclose: true
      });

  $('#periodeEntretien').daterangepicker();

  </script>

  <script >
    $('.select2').select2();



    $('#facetoface-modal').on('show.bs.modal', function(e) {
      //get data-id attribute of the clicked element
          $('#identifiantFF').val('');
          $('#prenomNom').val('');
          $('#dateFF').val('');
          document.getElementById("submitButton").disabled=false;
          document.getElementById("submitButton").textContent = "Enrégistrer";

          var Id = $(e.relatedTarget).data('agent_id');
          var nom = $(e.relatedTarget).data('agent_nom');
          var prenom = $(e.relatedTarget).data('agent_prenom');
          var pn=prenom+' '+nom;
          var dateFF = $(e.relatedTarget).data('agent_dateff');
          var statut  = $(e.relatedTarget).data('agent_statutff');
          
          $('#identifiantFF').val(Id);
          $('#prenomNom').val(pn);
          $('#nomFF').val(nom);
          $('#prenomFF').val(prenom);

          document.getElementById("dateFF").setAttribute("min", $(e.relatedTarget).data('agent_dt'));
  });
  </script>
<script>
  $('#formFF').on('submit',function(e){
      e.preventDefault();
      var identifiantFF =$('#identifiantFF').val();
      var dateFF=$('#dateFF').val();
      var statutAgentFF=$('#statutAgentFF').val();
      var resultatFF=$('#resultatFF').val();
      
      document.getElementById("submitButton").disabled=true;
      document.getElementById("submitButton").textContent = "Enrégistrement en cours ...";
      
  $.ajax({
      url: "saveFacetoface",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        identifiantFF:identifiantFF,
        dateFF:dateFF,
        statutAgentFF:statutAgentFF,
        resultatFF:resultatFF,
      },
      success:function(response){
        if(response.status==true){
          $('#facetoface-modal').hide();
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
          document.getElementById("submitButton").disabled=false;
          document.getElementById("submitButton").textContent = "Enrégistrer";
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