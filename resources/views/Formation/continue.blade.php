  @extends('layouts.layout')

   @section('formationC') 


   <!-- Content Wrapper. Contains page content -->


    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Formation Continue
        </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Formation Continue</li>
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
                <div class="col-md-9 pull-left"></div>
                   <div class="col-md-3 pull-right">

    <!-- <a type="button" id="button" name="button" data-toggle="modal" data-target=".modal-default" class="btn btn-round  btn-block btn-md btn-flat"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter une formation continue</a> -->

    </div>
             <table id="example2" class="table table-bordered table-hover"  style="width:100%">
                  <thead>
                  <tr>
                    <th>Identifiant CRC</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Date et lieu de naissance</th>
                    <th>Formation initiale</th>
                    <th>Continue</th>
                    <th>Période Formation Continue</th>      
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>0020</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  </tbody>

                  <tfoot>
                    <tr></tr>
                  </tfoot>

                </table>

                 <div class="modal fade" id="modal-default" >
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="form" method="post" role="form" action="">
                <!-- <input type="hidden" name="idSelected" id="idSelected">
                <input type="hidden" name="nbRows" id="nbRows"> -->
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
                  <select id="formation" name="formation" class="form-control select2" style="width: 100%;" required="required">
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
                    <input type="text" class="form-control input-sm" id="periodeFormation" name="periodeFormation" required="required">
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>Enrégistrer</button>
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
    <script>
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
  </script>

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
  @endsection