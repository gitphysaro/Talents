@extends('layouts.layout')

 @section('dashboard') 


 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tableau de bord
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li> -->
        <li class="active">Tableau de bord</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <!-- <span class="info-box-icon bg-aqua"><i class="fa fa-phone"></i></span> -->
            <span class="info-box-icon" style="color:white;background-color:#555555;"><i class="fa fa-phone"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Entretien Telephonique</span>
              <span class="info-box-number">{{$entretienTel}}</span>
            </div>
           
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="color:white;background-color:#7cc404;"><i class="fa fa-handshake-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Face to Face</span>
              <span class="info-box-number">{{$face2face}}</span>
            </div>
           
          </div>
        </div>

        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="color:#7cc404;background-color:#555555;"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Formation initiale</span>
              <span class="info-box-number">{{$formation}}</span>
            </div>
           
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background: #7899A6; color: white" ><i class="fa fa-leanpub"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Formation continue</span>
              <span class="info-box-number">{{$continue}}</span>
            </div>
           
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="color:#555555;background-color:white;">
            <div class="inner">
              <h3>{{$carriere}}</h3>

              <h4>Carriere</h4>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="carriere" class="small-box-footer">Plus d'info<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="color:white;background-color:#7cc404;">
            <div class="inner">
              <h3>{{$pat}}</h3>

              <h4>Personnel administratif et technique</h4>
            </div>
            <div class="icon">
              <i class="fa fa-files-o"></i>
            </div>
            <a class="small-box-footer">Plus d'info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="color:#7cc404;background-color:#555555;">
            <div class="inner">
              <h3>{{$production}}</h3>

              <h4>Production</h4>
            </div>
            <div class="icon">
              <i class="fa fa-certificate"></i>
            </div>
            <a href="production" class="small-box-footer">Plus d'info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background: #7899A6; color: white">
            <div class="inner">
              <h3>{{$arretContrat}}</h3>

              <h4>Arret contrat / Demission</h4>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a class="small-box-footer">Plus d'info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
      </div>


    </section>
  </div>

  @stop

@section('scripts')
<script src="{{asset('js/jqueryv2.js')}}"></script> 
 <script src="{{ asset('js/bootstrap.min.js')}}"></script>

@endsection