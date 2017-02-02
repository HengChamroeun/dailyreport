<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ប្រព័ន្ធរបាយការណ៍ចំណូលប្រចាំថ្ងៃ</title>
      <link href="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo theme('img/site/favicon.ico');?>">
  <link href="<?php echo css('css/bootstrap.min.css')?> rel="stylesheet">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <script>

        $('#username').autocomplete = 'off';
        $('#password').autocomplete = 'off';
  </script>
</head>
<body>
	<!--login modal-->
<div id="login_container">

<form class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2 col-xs-12" style='margin-top:50px;' method='post' autocomplete="off">
	<div style='margin-top:15px;'>
		<img style='max-height:100px;' src='<?php echo base_url('assets/files/customs_logo.gif') ?>'/>
	</div>
	<div style='margin-top:15px;'>
		<h3 style='font-family:KHMER MEF2'>ប្រព័ន្ធរបាយការណ៍ចំណូលប្រចាំថ្ងៃ</h3>
	</div>
   <div class="form-group">
        <input type="text" class="form-control input-lg" name='username' id='username' style='font-family: arial' placeholder="ឈ្មោះអ្នកប្រើ">
    </div>
    <div class="form-group">
        <input type="password" class="form-control input-lg" style='font-family: arial' id='password' name='password' placeholder="លេខកូដសម្ងាត់">
    </div>
    <div class="form-group">
        <input class="btn btn-primary btn-lg btn-block" type='submit' name='submit' value='ចូល'>
		<br/>
        <span class="pull-left"><label for='remember_me'><input type='checkbox' name='remember_me' id='remember_me'> រក្សាលេខកូដសម្ងាត់</label></span>
        <!--<span class="pull-right"><a href="#">Need help?</a></span> -->
    </div>
	<div style='margin-top:50px;border-top:1px solid #ccc;padding:7px;'><p> រក្សាសិទ្ធិ <span style="font-family:courier">&copy;</span> <?php echo numberKH(date('Y',time())); ?><br> ក្រុមការងារគម្រោងជាតិប្រព័ន្ធស្វ័យប្រវត្តិកម្មទិន្នន័យគយ</p></div>
</form>
</div>



<style>
body{font-family: KHMER MEF1}
#login_container{
	text-align:center;
}
</style>
</body>
</html>
