<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customs Daily Report Login</title>
      <link href="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo theme('img/site/favicon.ico');?>">
  <link href="<?php echo css('css/bootstrap.min.css')?> rel="stylesheet">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
	<!--login modal-->
<div id="login_container">

<form class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2 col-xs-12" method='post'>
	<div style='margin-top:15px;'>
		<img style='max-height:100px;' src='<?php echo base_url('assets/files/customs_logo.gif') ?>'/>
	</div>
	<div style='margin-top:15px;'>
		<h2>Customs Daily Report &copy;</h2>
	</div>
   <div class="form-group">
        <input type="text" class="form-control input-lg" name='username' placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control input-lg" name='password' placeholder="Password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary btn-lg btn-block" type='submit' name='submit' value='Sign In'>
		<br/>
        <span class="pull-left"><label for='remember_me'><input type='checkbox' name='remember_me' id='remember_me'> Remember me</label></span>
        <!--<span class="pull-right"><a href="#">Need help?</a></span> -->
    </div>
	<div style='margin-top:50px;border-top:1px solid #ccc;'>Copyrights &copy; GDCE <?php echo date('Y',time()); ?> Developed by NPT Team</div>
</form>
</div>
<style>
#login_container{
	text-align:center;
}
</style>
</body>
</html>
