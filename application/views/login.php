<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eliteadmin.themedesigner.in/demos/eliteadmin-material/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Sep 2016 09:20:17 GMT -->
<head>
<base href="<?php echo base_url();?>" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Publyfe Admin</title>
<!-- Bootstrap Core CSS -->
<link href="assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="assets/admin/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="assets/admin/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="assets/admin/css/colors/default.css" id="theme"  rel="stylesheet">

<style>
    .form-control{
        color:#f6f0f0;
    }
    
/*    body{
        background-image: url("../reservation/assets/admin/images/assets/landscape1.jpg");
        height: 657px;
        padding: 33px;
        color: #ccc;
        width: 1351px;
    }*/
</style>

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
  </svg>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
      <div class="white-box" style="background:#2f2d2d;">
      <form class="form-horizontal form-material" id="loginform" action="login/checkLogin" method="post">
	
			
        <div class="form-group text-center">
          <div class="col-xs-12">
              <img src="assets/images/logo.png" style="width: 50%;" alt="login">
          </div>
        </div>
          <h3 class="box-title m-b-20 text-center" style="color: #fff;">Sign In</h3>
		<?php if(isset($error)){?>
			<div class="alert alert-danger"><?php echo $error;?></div>
		<?php } ?>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="email" required="" placeholder="Email Address">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password" required="" placeholder="Password">
          </div>
        </div>
<!--        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Remember me </label>
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
        </div>-->
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        
<!--        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
          </div>
        </div>-->
      </form>
      <form class="form-horizontal" id="recoverform" action="http://eliteadmin.themedesigner.in/demos/eliteadmin-material/index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="assets/admin/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap Core JavaScript -->
<script src="assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="assets/admin/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="assets/admin/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="assets/admin/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="assets/admin/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="assets/admin/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

<!-- Mirrored from eliteadmin.themedesigner.in/demos/eliteadmin-material/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Sep 2016 09:20:17 GMT -->
</html>
