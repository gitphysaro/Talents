@extends('layouts.layout')

 @section('ficheEmploye') 


 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fiche Employe
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="carriere"><i class="fa fa-dashboard"></i> Carriere</a></li>
        <li class="active">Fiche Employe</li>
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
          <h2 class="box-title" style="color: #187AAC">Rechercher les informations d'un CC</h2>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form class="form" method="post" role="form" action="searchIdCC">
              <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
              {{ csrf_field() }}
              <!-- @if(isset($varInfos))
                  <input type="hidden" name="varInfos" id="varInfos" value="{{ $varInfos }}">
                    
              @endif -->

            
            <div class="form-group row">
              <div class="col-md-3"></div>
                <label class="col-md-1 col-form-label ">Identifiant du CC</label>
                <div class="col-md-2">
                 <input type="number" class="form-control input-sm" id="idCC" name="idCC" min="1" required="required" placeholder="Saisir l'Id du CC à badger"> 

                </div>
                <div class="col-md-2">
                <button type="submit" class="btn btn-block pull-right btn-sm"  style="background-color: #187AAC; color: white">Rechercher</button>
                </div>
              </div>

</form>
</div>
</div>



          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>

    @stop
@section('scripts')

        <script type="text/javascript">
        $(function () {
            // Initialisation des DateTimePicker
            $('#datetimepicker1').datetimepicker({ locale: 'fr', format: 'HH:mm:ss' });
            $('#datetimepicker2').datetimepicker({ locale: 'fr', format: 'HH:mm:ss' });
            $('#datetimepicker3').datetimepicker({ locale: 'fr', format: 'HH:mm:ss' });
            $('#datetimepicker4').datetimepicker({ locale: 'fr', format: 'HH:mm:ss' });
 
        });
    </script>
<script >
  $('.select2').select2();
  $('#periodeFormation').daterangepicker({
        locale: {
            format: 'YYYY/MM/DD',  
        }
 });
</script>
@endsection