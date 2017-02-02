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
    <link href="<?php echo base_url('assets/theme/plugins/datatable/css/jquery.dataTables.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/fonts.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/theme/plugins/pikaday/pikaday.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/theme/plugins/dialog/css/bootstrap-dialog.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/theme/plugins/dialog/css/bootstrap-dialog.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/theme/plugins/datepicker/bootstrap-datetimepicker.css'); ?>" rel="stylesheet">
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <?php if($this->router->fetch_class() === 'home'){ ?>
     <link href="<?php echo base_url('assets/theme/css/admin-home.css'); ?>" rel="stylesheet">
     <?php } ?>

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

    <div class="container admin">

	  <div id="custom-bootstrap-menu" class="navbar navbar-default trevenues"   role="navigation">
		<div class="container-fluid trevenues">
			<div class="navbar-header trevenues">
			<img style='max-height:50px;' src='<?php echo base_url('assets/files/customs_logo.gif') ?>'/>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-menubuilder">
				<ul class="nav navbar-nav navbar-left trevenues menuhover">
					<li role="presentation"><a class="menuhover" href="<?php echo base_url('admin'); ?>">ទំព័រដើម</a></li> <!--class="active"-->
					<li role="presentation"><a href="<?php echo base_url('admin/report'); ?>">របាយការណ៍</a></li>
					<!--<li role="presentation"><a href="<?php echo base_url('admin/internal_planning'); ?>">ផែនការ</a></li>-->
					<!--<li role="presentation"><a href="<?php echo base_url('admin/branch'); ?>">សាខា</a></li>-->
					<!--<li role="presentation"><a href="<?php echo base_url('admin/office'); ?>">ការិយាល័យ</a></li>-->
					<li role="presentation"><a href="<?php echo base_url('admin/revenue_history'); ?>">ប្រវត្តិកែតម្រូវចំណូលពន្ធ</a></li>
					<li role="presentation"><a href="<?php echo base_url('admin/monthly_item_revenues_front'); ?>">ចំណូលពន្ធតាមមុខទំនិញ</a></li>
					<li role="presentation"><a href="<?php echo base_url('admin/monthly_revenues_b_front'); ?>">ពន្ធជាបន្ទុករដ្ឋ</a></li>
					<li role="presentation"><a href="<?php echo base_url('admin/monthly_revenues_front'); ?>">ចំណូលតាមប្រភេទពន្ធ</a></li>
					<!--<li role="presentation"><a href="<?php echo base_url('admin/users'); ?>">អ្នកប្រើប្រាស់</a></li>!-->
					<li class="trevenues"><a href="<?php echo base_url('password_reset') ?>">ប្តូរពាក្យសំងាត់</a>
					<li role="presentation"><a href="<?php echo base_url('authentication') ?>">ចាកចេញ</a></li>
				</ul>
			</div>
		</div>
	</div>

	<style>
	body{font-family:KHMER MEF1}
		a.menuhover:hover{
			background-color: black;
		}
	</style>