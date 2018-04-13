<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">
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
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>Request  </b>Password</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="login-box-msg">ลืมรหัสผ่าน</h4>

	<form action="<?=base_url()?>login/authen" method="post" autocomplete="off">
		<?php
			$message		= @$this->session->flashdata('message');
			$message_title 	= @$this->session->flashdata('message_title');
			$message_check	= @$this->session->flashdata('message_check');
			
			if(isset($message) && isset($message_title) && isset($message_check)){
				echo '<div class="alert alert-'.$message_check.' alert-dismissible">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
					echo '<h4><i class="icon fa fa-exclamation-circle"></i> '.$message_title.'</h4>';
					echo $message;
				echo '</div>';
				@$this->session->unset_userdata('message');
				@$this->session->unset_userdata('message_title');
				@$this->session->unset_userdata('message_check');
			}
		?>
		<div class="form-group has-feedback">
			<input type="text" class="form-control" name="user_request" data-validation="required" placeholder="เบอร์โทรศัพท์ หรือ อีเมล์ที่ลงทะเบียนไว้">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>
		
		
        <div class="row">
            <div class="col-xs-2 col-centered"></div>
            <div class="col-xs-8 col-centered">	<button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-hand-pointer-o"></i> เปลี่ยนรหัสผ่าน</button></div>
            <div class="col-xs-2 col-centered"></div>
        </div>
	</form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- validate -->
<script src="<?=base_url()?>assets/bower_components/validate/js/jquery.form-validator.js"></script>
<script src="<?=base_url()?>assets/bower_components/validate/js/security.js"></script>
<script src="<?=base_url()?>assets/bower_components/validate/js/file.js"></script>
<script>
	 $.validate({
		modules: 'security, file',
		onModulesLoaded: function () {
			$('input[name="pass_confirmation"]').displayPasswordStrength();
		}
	});

	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 2000);
</script>

</body>
</html>
