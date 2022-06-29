<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PHY | TALENTS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">

<!-- <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css')}}"> -->
<link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/select.dataTables.min.css')}}">


  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
 
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css')}}">

  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/_all-skins.min.css')}}">

  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/morris.js/morris.css')}}">
  
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/jvectormap/jquery-jvectormap.css')}}">
 
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css')}}">

  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/select2/dist/css/select2.min.css')}}">
  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />


  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

  <style>

.pagination>.active>a,
.pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover
{
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #7cc404;
    border-color: #7cc404;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: #555555;
  color: black!important;
  border-radius: 4px;
  border: 1px solid #828282;
}
 
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: #7cc404;
  color: black!important;
}


</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a class="logo" style="background-color: #7cc404;">
      <span class="logo-mini"><b>PHY</b></span>
      <span class="logo-lg"><b>PHY</b> TALENTS</span>
    </a>
    <nav class="navbar navbar-static-top" style="background-color: #7cc404;">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
                  <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-outline-primary btn-flat btn-lg" style="color: white">
                                                     <i class="fa fa-sign-out" aria-hidden="true">Deconnexion</i>
                                            
                  </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">@csrf</form> 
              
          
          
  
      </div>
    </nav>
  </header>
  <aside class="main-sidebar" style="background-color: #555555;">
    <section id="nav" class="sidebar" style="background-color: #555555;">
      <div class="user-panel">
        <div class="pull-left image" style="margin-top:5px;">
          <img src="images/logo_.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->prenom}} {{ Auth::user()->nom}}</p>
          <a ><i class="fa fa-circle text-success" style="color:#7cc404;"></i> En ligne</a>
        </div>
      </div>
    @if (Auth::user()->accessLevel == 6 || Auth::user()->accessLevel == 2)
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="background:white;color:#374850;margin-top:15px;">MENU</li>

        <li class="">
          <a href="dashboard">
            <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
          </a>
        </li>
        <li class="">
          <a href="addAgent">
            <i class="fa fa-plus" ></i> <span>Saisie CV</span>
          </a>
        </li>
        <li class="">
          <a href="entretienTel">
            <i class="fa fa-phone"  aria-hidden="true"></i> <span>Entretien téléphonique</span>
          </a>
        </li>
        <li class="">
          <a href="face2face">
            <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
            <i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Face 2 Face</span>
          </a>
        </li>
        <li class="">
          <a href="initiale">
            <i class="fa fa-graduation-cap" ></i> <span>Formation initiale</span>
          </a>
        </li>
        <li class="">
          <a href="production">
            <i class="fa fa-certificate" aria-hidden="true"></i> <span>Production</span>
          </a>
        </li>
        <li class="">
          <a href="carriere">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>Carriere</span>
          </a>
        </li>
      </ul>
      @endif


    </section>




    </aside>

        
    

@yield('dashboard') 
@yield('addAgent')
@yield('formationIni') 
@yield('production')  
@yield('carriere') 
@yield('ficheET')
@yield('entretienTel')
@yield('face2face')






<!-- <script src="{{ asset("js/jquery.min.js")}}"></script>

<script src="{{ asset("js/bootstrap.min.js")}}"></script> -->



<!-- <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script> -->





  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>PHY TALENTS Version</b> 2.1
    </div>

    <p><span class="glyphicon glyphicon-copyright-mark"></span> <?php echo date('Y');?> - PHYSARO</p>
  </footer>

</div>








<!-- <script src="{{ asset("AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>



<script src="{{ asset("AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>



<script src="{{ asset("AdminLTE/bower_components/moment/min/moment.min.js")}}"></script>


<script src="{{ asset("AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js")}}"></script> -->


 <!-- <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> -->


<!-- Morris.js charts -->
<!-- <script src="{{ asset("AdminLTE/bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{ asset("AdminLTE/bower_components/morris.js/morris.min.js")}}"></script>

<script src="{{ asset("AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>

<script src="{{ asset("AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{ asset("AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>

<script src="{{ asset("AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js")}}"></script>

<script src="{{ asset("AdminLTE/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{ asset("AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>

<script src="{{ asset("AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}" ></script>

<script src="{{ asset("AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>

<script src="{{ asset("AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}" ></script>

<script src="{{ asset("AdminLTE/bower_components/fastclick/lib/fastclick.js")}}"></script>

<script src="{{ asset("AdminLTE/dist/js/adminlte.min.js")}}"></script>

<script src="{{ asset("AdminLTE/dist/js/pages/dashboard.js")}}"></script>

<script src="{{ asset("AdminLTE/dist/js/demo.js")}}"></script>
<script src="{{ asset("js/sweetalert.min.js")}}"></script> -->

    <!-- Include this after the sweet alert js file -->
    <!-- @include('sweet::alert') -->

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
<script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('AdminLTE//bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('AdminLTE/bower_components/moment/min/moment.min.js')}}"></script>

<script>
  $(function() {
     var pgurl = window.location.href.substr(window.location.href
.lastIndexOf("/")+1);

     $("#nav ul li a").each(function(){
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).addClass("active");
          const note = document.querySelector('.active');
          note.style.color = '#7cc404';
     })
});
</script>



@yield('scripts')

</body>
</html>
