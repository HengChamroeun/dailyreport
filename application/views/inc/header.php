<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $app_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/css/jumbotron-narrow.css" rel="stylesheet">
	 <link href="<?php echo base_url('assets/theme/css/fonts.css'); ?>" rel="stylesheet">
	 <link href="<?php echo base_url('assets/theme/plugins/pikaday/pikaday.css'); ?>" rel="stylesheet">
	 <link href="<?php echo base_url('assets/theme/plugins/dialog/css/bootstrap-dialog.css'); ?>" rel="stylesheet">
	 <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/theme/plugins/datatable/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/js/ie-emulation-modes-warning.js"></script>
	    <script src="<?php echo base_url('assets/theme/js/jquery.min.js'); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
	<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
		<div class="container-fluid​ trevenues">
			<div class="navbar-header"><!-- <a class="navbar-brand" href="#">Customs Daily Report</a>-->
			<img style='max-height:50px;' src='<?php echo base_url('assets/files/customs_logo.gif') ?>'/>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-menubuilder">
				<ul class="nav navbar-nav">
					<li class="trevenues"><a href="<?php echo base_url() ?>">ចំណូលពន្ធប្រចាំថ្ងៃ</a>
					<li class="trevenues"><a href="<?php echo base_url('revenue_by_item') ?>">ពន្ធតាមមុខទំនិញ</a>
                  	<li class="trevenues"><a href="<?php echo base_url('monthly_revenues') ?>">ពន្ធគ្រប់ប្រភេទ</a>
                  	<li class="trevenues"><a href="<?php echo base_url('monthly_revenues_b_front') ?>">ពន្ធជាបន្ទុករដ្ឋ</a>
					<li class="trevenues"><a href="<?php echo base_url('password_reset') ?>">ប្តូរពាក្យសំងាត់</a>
					<li class="trevenues"><a href="<?php echo base_url('authentication') ?>">ចាកចេញ</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
