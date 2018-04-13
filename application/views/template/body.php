<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>แบบสำรวจหน่วยงานภาครัฐ</title>
  <!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/select2/dist/css/select2.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/all.css">
	<!-- validate -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/validate/css/validator.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- jQuery 3 -->
	<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?=base_url()?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<!-- daterangepicker -->
	<script src="<?=base_url()?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes)
	<script src="<?=base_url()?>assets/dist/js/pages/dashboard.js"></script> -->
	<!-- AdminLTE for demo purposes -->
	<script src="<?=base_url()?>assets/dist/js/demo.js"></script>

	<!-- Select2 -->
	<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- iCheck 1.0.1 -->
	<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

	<!-- DataTables -->
	<script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<!-- validate -->
	<script src="<?=base_url()?>assets/bower_components/validate/js/jquery.form-validator.js"></script>
	<script src="<?=base_url()?>assets/bower_components/validate/js/security.js"></script>
	<script src="<?=base_url()?>assets/bower_components/validate/js/file.js"></script>

</head>
<!--<body class="hold-transition skin-blue sidebar-mini">-->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
	
	<?php $this->load->view('template/'.$header);?>
	<?php $this->load->view('template/'.$menu);?>
	<?php $this->load->view('page/'.$content);?>
	<?php $this->load->view('template/'.$footer);?>
<script>
  $(function () {
    $('#example1').DataTable()
   
	$('.select2').select2();
	
	$(document).on('mouseover','[data-toggle="tooltip"]', function(){
		$(this).tooltip('show');
	});
	
  })
</script>
</body>
</html>