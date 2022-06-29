@extends('layouts.layout')

 @section('formationIni') 


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Formation initiale
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li> -->
        <li class="active">Formation initiale</li>
      </ol>
    </section>

    <!-- Main content -->
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
          <form class="form" method="post" role="form" action="searchInitiale">
              <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
              {{ csrf_field() }} 
              
            <div class="col-md-5">
            <div class="form-group">
                <label>Face to face du:</label>
          <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control input-sm" id="periodeFacetoface" name="periodeFacetoface">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group">
                <label>Formation</label>
                <select id="formation" name="formation" class="form-control select2">
                  <option value="" disabled selected>Sélectionner la formation</option>
                    @foreach ($donneesFormation as $data)
                     <option value="{{  $data->Activites_Description  }}">{{ $data->Activites_Description }}</option>
                  @endforeach
                  </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Statut Formation </label>
                 <select id="statutFormation" name="statutFormation" class="form-control select2" style="width: 100%;">
                  <option value="" disabled selected>Sélectionner le statut</option>
                  <option value="Nouveau">Nouveau</option>
                  <option value="KO">KO</option>
                </select>
              </div>

              </div>

              <div class="col-md-2">
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-sm pull-right" style="background-color: #7cc404; color: white;margin-top:23px">Rechercher</button>
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
              <h3 class="box-title">Liste des candidats en formation initiale</h3>
            </div>
            <div class="box-body">
              <div class="row">



              



<div class="col-md-10 pull-left"></div>
                 <div class="col-md-2 pull-right">

  <a type="button" id="ajouterFI" name="ajouterFI" title="Selectionner d'abord les conseillers concernés" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-default" class="btn btn-round  btn-block btn-md btn-flat">
    <h4 style="color: #7cc404;"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter une formation initiale</h4></a>
  </div>
                 <table id="example2" class="table table-bordered table-hover"  style="width:100%">
                <thead style="background-color: #555555; color: white;">
                <tr>
                  <th>Id_Candidat</th>
                  <th>Id_CRC</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Date et lieu de naissance</th>
                  <th>Date Face2face</th>
                  <th>Statut Candidat</th>
                  <th>Formation</th>
                  <th>Periode Formation</th>
                  <th>Note Formation</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                 @foreach ($donneesFI as $FI) 
                        <tr> 
                           <td>{{$FI->Id_Candidat}}</td>
                           <td>{{$FI->CRC_Agents_Id}}</td>
                           <td>{{$FI->Nom}}</td>
                           <td> {{$FI->Prenom}} {{$FI->Prenom2}} {{$FI->Prenom3}} {{$FI->Prenom4}}</td> 
                           <td> {{$FI->Date_naissance }} {{$FI->Lieu_naissance }}</td> 
                           <td> {{$FI->Date_Face2face }}</td>
                           <td> {{$FI->Statut_Candidat}}</td> 
                           <td> {{$FI->Formation}}</td>
                           @if($FI->Formation != '')
                          <td> {{$FI->DateDebut}}  au  {{$FI->DateFin}}</td>
                          @endif
                          @if($FI->Formation == '')
                            <td></td> 
                          @endif
                           <td> {{$FI->Note_Formation}}</td>


                           @if($FI->Formation == '')
                              <td>Pas de formation</td> 
                           @endif 
                           @if($FI->Formation != '')
                              <td><button class="btn btn-sm" style="background-color: #7cc404; color: #555555;" title="Infos de la formation" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-NoteFormation" data-agent_id="{{ $FI->Id_Candidat }}" data-agent_idcrc="{{ $FI->CRC_Agents_Id }}" data-agent_nom="{{$FI->Nom }}" data-agent_prenom="{{$FI->Prenom}}" data-agent_formation="{{$FI->Formation}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </button>
                        </td>
                        <!-- ---------------------------------------------Modal pour ajouter note de formation  ----------------------------------------------------------->

                           @endif

                        </tr>
                 @endforeach

                </tbody>
                <tfoot>
                <tr></tr>
                </tfoot>
              </table>
              <div class="modal fade" id="modal-NoteFormation" tabindex="-1" role="dialog" aria-hidden="true" >
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="formSave" name="formSave" class="form" method="post" role="form" action="">
                <input type="hidden" style="" name="identifiantCRC" id="identifiantCRC" value="">  
              {{ csrf_field() }} 
              <div class="modal-header" style="background-color: #555555; color: #7cc404; text-align:center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Evaluation sur la formation suivie</h3>
              </div>
              <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
              <div class="form-group">
                <label>Identifiant</label>
                <input type="number" class="form-control input-sm" id="identifiantForm" name="identifiantForm" readonly="readonly" >
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
                <label>Intitule de la formation</label>
                 <input type="text" class="form-control input-sm" id="nomformation" name="nomformation" readonly="readonly"  >
              </div>

              </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Statut Formation </label>
                 <select id="statutFI" onchange="verification()" name="statutFI" class="form-control input-sm" style="width: 100%;" required>
                  <option value="" disabled selected>Selectionner le statut</option>
                  <option value="OK">OK</option>
                  <option value="KO">KO</option>
                </select>
              </div>

              </div>
              
              <div class="col-md-6">
              <div class="form-group">
                <label>Note de fin de formation</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </div>
                  <input id="noteFormation" name="noteFormation" type="number" class="form-control input-sm" min="1" required>
                </div>
                
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>Date d'entrée en Prod</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php $max= date("Y-m-d"); ?>
                  <input id="dateEntreeProd" name="dateEntreeProd"  type="date" class="form-control input-sm" required>
                </div>

                
              </div>
              </div>
              <div class="col-md-12">
              <div class="form-group">
                <label>Résultat du comité</label>
                  <textarea id="resultatComite" name="resultatComite" rows="4" class="form-control" style="resize: none" required></textarea>
                </div>
                
              </div>
              
                
              
             
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn pull-left" style="background-color: #555555; color: white;" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn" style="background-color: #7cc404; color: white;">Enrégistrer</button>
              </div>

               </form>
              </div>
              
              
            </div>
          
          </div>




</div>



          <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="formAjoutFormation" name="formAjoutFormation" class="form" method="post" role="form" action="">
              <input type="hidden" name="idSelected" id="idSelected">
              <input type="hidden" name="nbRows" id="nbRows">
              {{ csrf_field() }} 

              <div class="modal-header" style="background-color: #555555; color: #7cc404;text-align:center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Détails de la formation initiale à suivre</h3>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col-md-12">
                <div class="col-md-12">
              <div class="form-group">
                <label>Intitule de la formation</label>
                <select id="fi" name="fi" class="form-control select2" style="width: 100%;" required>
                  <option value="" disabled selected>Sélectionner la formation</option>

                  @foreach ($donneesFormation as $data)
                     <option value="{{$data->Activites_Description}}">{{ $data->Activites_Description }}</option>
                  @endforeach
                  </select>
              </div>
            </div>
              <div class="col-md-12">
              <div class="form-group">
                <label>Periode Formation</label>
                <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control input-sm" id="periodeFormation" name="periodeFormation" required>
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
              </div>
                
              </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn pull-left" style="background-color: #555555; color: white;" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn" style="background-color: #7cc404; color: white;">Enrégistrer les détails de la formation</button>
              </div>

               </form>
              </div>
            </div>
          </div> 
     
        </div>

                 </div> 
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
<script type="text/javascript">
 $('#periodeFacetoface').daterangepicker({
   opens: 'left',
 });
</script>
  <script>
  //$(function () {
     $(document).ready(function() {

     var tab=$('#example2').DataTable({
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
                return 'Formation initiale '+dateString;
            },
           },
],
        
'columnDefs': [
        {
         'targets': 0,
         'checkboxes': {
            'selectRow': true
          }
      }
],
'select': {
      'style': 'multi'
   },
        
order: [[ 1, 'asc' ]]

}); 


$('#ajouterFI').click( function (e) {
        var oData = tab.rows('.selected').data();
        $('#nbRows').val(oData.length);
        var idselected='';
        for (var i=0; i < oData.length ;i++){
          idselected= idselected+ ","+oData[i][0]; 
        }
        $('#idSelected').val(idselected);
    } );
  });


</script>
<script language="JavaScript">
function verification()
{
  var selected = $('#statutFI').val();
  var dateEntree =document.getElementById("dateEntreeProd");
  
  if(selected=="KO")
{
 // document.getElementById("dateEntreeProd").required = false;
 dateEntree.removeAttribute('required');
 console.log("ko  date non requis");
}
else
{
 // document.getElementById("dateEntreeProd").required = true;
  dateEntree.setAttribute('required', '');
  console.log("ok date requis");
}
}

</script>
<script>
  $('#datepicker').datepicker({
      autoclose: true
    });
  $('#dateFormation').datepicker({
      autoclose: true
    });
  $('#periodeFormation').daterangepicker({
   opens: 'left',
   locale: { cancelLabel: 'Clear' }

 });
</script>

<script>
  $('.select2').select2();

  $('.modal-default').modal();


</script>
<script>
   $('#modal-NoteFormation').on('show.bs.modal', function(a) {
    $('#identifiantForm').val('');
        $('#identifiantCRC').val('');
        $('#prenomNom').val('');
        $('#nomformation').val('');
        var Id = $(a.relatedTarget).data('agent_id');
        var nom = $(a.relatedTarget).data('agent_nom');
        var prenom = $(a.relatedTarget).data('agent_prenom');
        var pn=prenom+' '+nom;
        var formation = $(a.relatedTarget).data('agent_formation');
        var idcrc = $(a.relatedTarget).data('agent_idcrc');
        
        $('#identifiantForm').val(Id);
        $('#identifiantCRC').val(idcrc);
        $('#prenomNom').val(pn);
        $('#nomformation').val(formation);
      });
</script>

<script>
$('#formSave').on('submit',function(e){
      e.preventDefault();
      
  $.ajax({
      url: "saveNote",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        identifiantForm:$('#identifiantForm').val(),
        identifiantCRC:$('#identifiantCRC').val(),
        statutFI:$('#statutFI').val(),
        noteFormation:$('#noteFormation').val(),
        dateEntreeProd:$('#dateEntreeProd').val(),
        resultatComite:$('#resultatComite').val(),
      },
      success:function(response){
        if(response.status==true){
          $('#modal-NoteFormation').hide();
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

$('#formAjoutFormation').on('submit',function(e){
      e.preventDefault();
      var variable=$('#idSelected').val();
      //console.log($('#periodeFormation').val());
      //console.log($('#fi').val());
      if(variable==''){
        Swal.fire({
          icon: 'error',
          html: "Veuillez d'abords sélectionner des conseillers dans le tableau"
        });
      }else{
  $.ajax({
      url: "saveFormation",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        idSelected:$('#idSelected').val(),
        fi:$('#fi').val(),
        periodeFormation:$('#periodeFormation').val(),
        nbRows:$('#nbRows').val(),
      },
      success:function(response){
        if(response.status==true){
          $('#modal-default').hide();
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
    }  
});
</script>



@endsection

