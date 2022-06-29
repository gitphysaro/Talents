@extends('layouts.layout')

 @section('entretienTel') 


 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Entretien téléphonique
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li> -->
        <li class="active">Entretien Téléphonique</li>
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
          <form class="form" method="post" role="form" action="searchEntTel">
        {{ csrf_field() }} 
         @if(isset($valeurSearch))
                  <input type="hidden" name="valeurSearch" id="valeurSearch" value="{{ $valeurSearch }}">
                    
         @endif

          <div class="col-md-5">
              
              <div class="form-group">
                <label>CV saisi du:</label>
                <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control input-sm" id="periodeSaisieCV" name="periodeSaisieCV">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
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
                <label>Statut Entretien </label>
                 <select id="statutEntretienTel" name="statutEntretienTel" class="form-control select2" style="width: 100%;" >
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
              <table id="example2" name="example2" class="table table-bordered table-hover" style="width:100%">
                <thead style="background-color: #555555; color: white;">
                <tr>
                  <th>Id Candidat</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Date et lieu de naissance</th>
                  <th>Niveau</th>
                  <th>Domaine de competence</th>
                  <th>Langues</th>
                  <th>Parrainage</th>
                  <th>Date Saisie CV</th>
                  <th>Statut Candidat</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach ($donneesET as $ET) 
                        <tr>
                        
                           <td>{{$ET->Id_Candidat}}</td>
                           <td> {{$ET->Nom }}</td> 
                           <td> {{$ET->Prenom}} {{$ET->Prenom2}} {{$ET->Prenom3}} {{$ET->Prenom4}}</td> 
                           <td> {{$ET->Date_naissance }} {{$ET->Lieu_naissance }}</td> 
                           <td> {{$ET->Niveau }}</td>
                           <td> {{$ET->Domaine_de_competence}}</td>
                          <td> {{$ET->Langues}}</td>
                          <td>{{$ET->Parrainage}}</td>
                          <td>{{$ET->Date_SaisieCV}}</td>
                          <td> {{$ET->Statut_Candidat}}</td> 
                          <form class="form" id="formVoirFiche" method="post" role="form" action="voirfiche">
                            {{ csrf_field() }} 
                           <td><button style="background-color: #7cc404; color: #555555;" class="btn btn-sm" type="submit" id="voirFiche" name="voirFiche" value="{{$ET->Id_Candidat}}" title="Ouvrir la fiche du candidat"><i class="fa fa-id-card-o" aria-hidden="true"></i> Ouvrir la fiche</button></td>
                        </form>
                        </tr>
                        @endforeach
                 
                
                </tbody>
                <tfoot>
                 <tr>
                </tr> 
                </tfoot>
              </table>
 </div> 
           
              
            </div>
            <!-- /.box-body -->
          
       
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
   //$(document).ready(function() {
  //  var persistance=$('#valeurSearch').val();
  //  console.log(persistance);
  //  var result=persistance.split(" ");
    //var periode=result[0];
    //var end=result[1];
   // var parrainage=result[1];
   // var statut=result[2];
    //$('#periodeSaisieCV').val(periode);
   // $('#periodeSaisieCV').datepicker('setDate' , periode);
   // $('#dateSaisieFin').val(end);
  //  $('#parrainageAgent').val(parrainage);
    //$('#statutEntretienTel').val(statut);
//});
/*   $('#dateSaisieDebut').datepicker({
              locale: 'fr',
              format: 'yyyy-mm-dd',
              autoclose: true
            });
$('#dateSaisieFin').datepicker({
              locale: 'fr',
              format: 'yyyy-mm-dd',
              autoclose: true,
              useCurrent: false
            });*/


</script>
<script type="text/javascript">
 $('#periodeSaisieCV').daterangepicker({
   opens: 'left',
  //  locale: { cancelLabel: 'Annuler',
  //            applyLabel: 'Appliquer'
  //           }
  //  locale: {
  //    format: 'DD/MM/YYYY'
  // }
 });
</script>
<!-- <script>
$('#formSaisieCV').on('submit',function(e){
      e.preventDefault();
      var voirFiche=$('#voirFiche').val();
      
  $.ajax({
      url: "voirfiche",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        voirFiche:voirFiche,
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
        }).then((result) => {
          location.reload();
        });
        }
      },
     });  
});

</script> -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
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
                return 'Entretien Telephonique '+dateString;
            },
           },
        ],
    });
  });
</script>


<script >
  $('.select2').select2();
</script>





@endsection