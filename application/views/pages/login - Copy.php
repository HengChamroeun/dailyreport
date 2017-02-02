<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Customs Daily Report Login</title>
      <link href="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo theme('img/site/favicon.ico');?>">
  <link rel="stylesheet" href="<?php echo css('login/style.css');?>">
  <link href="<?php echo css('css/bootstrap.min.css')?> rel="stylesheet">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
	<!--login modal-->
<div id="login" class="container">
    		<div class="row center-panel ">
       			 <div class="col-sm-6 col-md-4 col-md-offset-4 text-center">
                        <div class="col-lg-12 gray-lighter-bg animated fadeInDown panel-body-only custom-check">
                            <div class="avatar avatar-md"><img src="<?php echo base_url('assets/files/customs_logo.jpg');?>" alt="Ryan" class="img-circle" width="100"></div>
								<h2 class="form-signin-heading">Please login</h2>
                                <form class="left-inner-addon" method='post'>
                                    <input type="text" class="form-control" placeholder="User Name" name='username' required autofocus>	
									<br/>									
                                    <input type="password" name='password' class="form-control" placeholder="Password" required>

									<br/>
                                   <input class="btn btn-lg btn-primary btn-block" name='submit' type="submit" value='Sign in'>
                                         
									<br/>
									<label style='text-align:left;padding-left:25px;' class="checkbox" for="remember_me">
                                        <input type="checkbox" name="remember_me" id='remember_me' value="remember_me">Remember me
                                    </label>
                                </form><span class="clearfix"></span>
                      </div>
            	 
               </span></div>
        	</div>
  		 </div>
</body>
</html>
