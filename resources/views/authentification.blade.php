<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRC | Outil RH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/font-awesome/css/font-awesome.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/Ionicons/css/ionicons.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/AdminLTE.min.css")}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/skins/_all-skins.min.css")}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/morris.js/morris.css")}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/jvectormap/jquery-jvectormap.css")}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">

  <link rel="stylesheet" href="css/crc.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>





<body>


<div class="top-content">
            
            <div class="inner-bg">

                <div class="container">
                  
                    

                        <div class="col-sm-6 col-sm-offset-3 text">
                            

                            
                            
                            <h1 style="text-align:center;"><strong style="color:#059CD6">CENTRE RELATION CLIENT</strong> </h1>
                            <h2 style="text-align:center;">Suivi Carrière CCx</h2>
                        
                    </div>

                    <div id ="formm">
                    <!-- <div class="row"> -->
                        <div class="col-sm-6 col-sm-offset-3 text">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Authentification</h3>

                                    
                                   <!--  <p>Enter your login and password to log on:</p> -->
                                </div>
                                <!-- <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div> -->
                            





                            <div class="form-bottom">
                            <form class="login-form" role="form" method="POST" action="connecter">
                        {{ csrf_field() }} 

                      

                                    <div class="form-group">
                                        <label>Login</label>
                                      <input id="login" type="number" name="login" placeholder="Login..." value="" class="form-username form-control">
                                       

                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input id="password" type="password" name="password" placeholder="Password..." class="form-password form-control">
                               
                                    </div>

                                      @if(isset ($errorVar))  
       <div class="alert alert-danger alert-dismissable" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Echec: <small>Login ou mot de passe incorrect. Veuillez réessayer!</small></strong> 
                          
                          </div>
      @endif

                                    <div class="form-group">
                                    <button type="submit" class="btn pull-right">Se connecter</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                     <!--    </div>
                    </div> -->
</div>
                  </div>

                </div>
                </div>
            </div>
            
        </div>








<!-- jQuery 3 -->
<script src="{{ asset("AdminLTE/bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("AdminLTE/bower_components/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset("AdminLTE/bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{ asset("AdminLTE/bower_components/morris.js/morris.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{ asset("AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>
<!-- jvectormap -->
<script src="{{ asset("AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{ asset("AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{ asset("AdminLTE/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{ asset("AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
<!-- datepicker -->
<script src="{{ asset("AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}" ></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
<!-- Slimscroll -->
<script src="{{ asset("AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}" ></script>
<!-- FastClick -->
<script src="{{ asset("AdminLTE/bower_components/fastclick/lib/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("AdminLTE/dist/js/adminlte.min.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("AdminLTE/dist/js/pages/dashboard.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("AdminLTE/dist/js/demo.js")}}"></script>

<script type="text/javascript">
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
</body>

</html>