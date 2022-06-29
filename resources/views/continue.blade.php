  @extends('layouts.layout')

   @section('formationC') 


   <!-- Content Wrapper. Contains page content -->


    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Continue
        </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Continue</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Liste des conseillers</h3>
              </div>
              <div class="box-body">
                <div class="col-md-10 pull-left"></div>
                   <div class="col-md-2 pull-right">

     <a type="button" id="button" name="button" data-toggle="modal" data-target="#modal-default" class="btn btn-round  btn-block btn-md btn-flat pull"
      title="Veuillez choisir les ccx"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter une formation continue</a> 

    </div>
             <table id="example2" class="table table-bordered table-hover"  style="width:100%">
                  <thead>
                  <tr>
                    <th>Identifiant CRC</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Formation initiale</th>
                    <th>Entrée Prod</th>
                    <th>Continue</th>
                    <th>Période Formation Continue</th>      
                  </tr>
                  </thead>
                  <tbody>
                 @foreach ($donneesFC as $FC) 
                        <tr> 
                           <td>{{$FC->Id_CRC}}</td>
                           <td> {{$FC->Nom }}</td> 
                           <td> {{$FC->Prenom }}</td> 
                           <td> {{$FC->Initiale }}</td>
                           <td> {{$FC->Entree_Prod }}</td>
                           <td> </td> 
                           <td> </td>
                         </tr>

                  @endforeach
             
                  </tbody>

                  <tfoot>
                    <tr></tr>
                  </tfoot>

                </table>

                 <div class="modal fade" id="modal-default" >
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="form" method="post" role="form" action="saveContinue">
                 <input type="text" name="idSelected" id="idSelected" required>
                <input type="hidden" name="nbRows" id="nbRows">
                {{ csrf_field() }} 

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Détails de la formation continue à suivre</h4>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-12">
                  <div class="col-md-12">
                <div class="form-group">
                  <label>Intitule de la formation</label>
                  <select id="continue" name="continue" class="form-control select2" style="width: 100%;" required="required">
                    <option value="" disabled selected>Select formation</option>

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
                    <input type="text" class="form-control input-sm" id="periodeContinue" name="periodeContinue" required="required">
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
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Enrégistrer</button>
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
    </div>

  @stop
  @section('scripts')
<!--     <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      });
    });
  </script> -->

  <script>
  //$(function () {
     $(document).ready(function() {


    //$('#example1').DataTable();
     var tab=$('#example2').DataTable({
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
                return 'Formation continue'+dateString;
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
    

$('#button').click( function (e) {
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
<script>


  $('#periodeContinue').daterangepicker({
   opens: 'right',
 });
</script>

  <script src="{{ asset("js/jquery-3.3.1.js")}}"></script>
  <script src="{{ asset("js/jquery.dataTables.min.js")}}"></script>
  <script src="{{ asset("js/dataTables.bootstrap.min.js")}}"></script>
  <script src="{{ asset("js/dataTables.buttons.min.js")}}"></script>
  <script src="{{ asset("js/buttons.flash.min.js")}}"></script>
  <script src="{{ asset("js/jszip.min.js")}}"></script>
  <script src="{{ asset("js/pdfmake.min.js")}}"></script>
  <script src="{{ asset("js/vfs_fonts.js")}}"></script>
  <script src="{{ asset("js/buttons.html5.min.js")}}"></script>
  <script src="{{ asset("js/buttons.print.min.js")}}"></script>
  <script src="{{ asset("js/dataTables.select.min.js")}}"></script>
  @endsection