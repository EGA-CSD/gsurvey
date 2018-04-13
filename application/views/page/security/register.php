<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
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
	
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/EasyAutocomplete-1.3.5/easy-autocomplete.css">
	
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
	
	<script src="<?=base_url()?>assets/bower_components/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"></script> 
	
</head>
<style>
.ui-autocomplete {
	cursor	: pointer; 
	height	: 120px;
	width	: 245px;
	overflow-y	: auto;
	background-color	: #fff;
	border		: 1px solid #7A9CD3;
	padding-left: 10px;
}
										
.right-inner-addon {
	position: relative;
	padding-left: 4px
}

.right-inner-addon input {
	padding-right: 30px;    
}

.right-inner-addon i {
	position: absolute;
	right: 0px;
	padding: 10px 12px;
	pointer-events: none;
}
</style>
<body class="hold-transition login-page">
<div class="register-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>Register </b>(ลงทะเบียน)</a>
  </div>
  <!-- /.login-logo -->
   <div class="login-box-body" id = "display_form_register">
    <!--<h4 class="login-box-msg">ฟอร์มลงทะเบียน</h4>-->

	<form class="form-horizontal" action="<?=base_url()?>login/saveadd" method="post" autocomplete="off" enctype="multipart/form-data">
		<?php
			$message		= $this->session->flashdata('message');
			$message_title 	= $this->session->flashdata('message_title');
			$message_check	= $this->session->flashdata('message_check');
			
			if(isset($message) && isset($message_title) && isset($message_check)){
				echo '<div class="alert alert-'.$message_check.' alert-dismissible">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
					echo '<h4><i class="icon fa fa-exclamation-circle"></i> '.$message_title.'</h4>';
					echo $message;
				echo '</div>';
				$this->session->unset_userdata('message');
				$this->session->unset_userdata('message_title');
				$this->session->unset_userdata('message_check');
			}
			
		?>
		<div class="form-group has-feedback">
			<div class="col-sm-12">
				<h4><b>ฟอร์มลงทะเบียน</b></h4>
				<hr>
			</div>
		</div>
		<div class="form-group has-feedback">
			<label class="col-sm-4 control-label">ชื่อหน่วยงาน</label>
			<div class="col-sm-8">
				<input id="trigger-event" class="form-control"  placeholder="ระบุชื่อหน่วยงาน" style="width: 90%;" data-validation="required"/>
				<input type="hidden" id="text-id" name="ORG_CODE">
				<div id="text-ministry-other" class="form-group col-sm-12 well" style="display:none;margin-top: 7px;width: 92%;padding: 10px;margin-left: 1px;"></div>
			</div>
		</div>
		
		<div class="form-group has-feedback">
			<label class="col-sm-4 control-label">ชื่อผู้ขอข้อมูล</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="NAME" id = "NAME"  value="" data-validation="required" maxlength ="13" placeholder="ระบุชื่อ">
				<span class="glyphicon glyphicon-edit form-control-feedback"></span>
			</div>
		</div>
		<div class="form-group has-feedback">
			<label class="col-sm-4 control-label">นามสกุล</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="LASNAME" id = "LASNAME"  value="" data-validation="required" maxlength ="13" placeholder="ระบุนามสกุล">
				<span class="glyphicon glyphicon-edit form-control-feedback"></span>
			</div>
		</div>
		<div class="form-group has-feedback">
			<div class="col-sm-12">
				<h4><b>ช่องทางติดต่อ</b></h4>
				<hr>
			</div>
		</div>
		<div class="form-group has-feedback">
			<label class="col-sm-4 control-label">อีเมล (เพื่อรับ user/password)</label>
			<div class="col-sm-8">
				<input type="email" class="form-control"  name="EMAIL" id = "EMAIL" value="" data-validation="required" placeholder="ระบุอีเมล">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
		</div>
		<div class="form-group has-feedback">
			<label class="col-sm-4 control-label">หมายเลขโทรศัพท์</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="TEL"  value="" data-validation="required" maxlength ="10" placeholder="ระบุหมายเลขโทรศัพท์">
				<span class="glyphicon glyphicon-phone form-control-feedback"></span>
			</div>
		</div>
		
		<div class="row">
			<!-- /.col -->
			<div class="col-xs-3">
				<input type="hidden" name="user_type_code" value="5A7F14B70BB44">
				<button type="submit" id = "register" class="btn btn-primary btn-block btn-flat"><i class="fa fa-hand-pointer-o"></i> ลงทะเบียน</button>
			</div>
			<!--<div class="col-xs-6">
				<a href="<?=base_url();?>login" class="btn btn-primary btn-block btn-flat"><i class="fa fa-edit"></i> เข้าสู่ระบบ</a>
			</div>-->
			<!-- /.col -->
		</div>
	</form>

  </div>
  <!-- /.login-box-body -->

    <div id="messages" class="hide" role="alert" style = "background-color: #3cd168 !important;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div id="messages_content">
		</div>
	</div>
  

</div>
<!-- /.login-box -->

<script>
	
	/// parmiter 
	var post_url = '<?=base_url()?>apis';
	 
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
	
	var options = {

		url: function(phrase) {
			return post_url;
		},

		getValue: function(element) {
			console.log(element);
			return element.ORG_NAME;
		},
		ajaxSettings: {
			method: "POST",
			data: {
				dataType: "json"
			}
		},
		preparePostData: function(data) {
			data.code = $("#trigger-event").val();
			data.action = 'organize';
			return data;
		},
		list: {
			onSelectItemEvent: function() {
				var value = $("#trigger-event").getSelectedItemData().ORG_NAME;
				var id = $("#trigger-event").getSelectedItemData().ORG_CODE;
				var department = $("#trigger-event").getSelectedItemData().DEPARTMENT_CODE;
				var ministry = $("#trigger-event").getSelectedItemData().MINISTRY_CODE;
				get_organizedetail(department,ministry);
				$('#text-id').val(id);
			}	
		},
			maxNumberOfElements: 10
		,match: {
			enabled: true
		},
		requestDelay: 400
	};
$("#trigger-event").easyAutocomplete(options);


function get_organizedetail(department,ministry){
	$.ajax({
		type: "POST",
		url: post_url,
		dataType : "json",
		data : { 
			 department : department
			,ministry 	: ministry
			,action 	: "organizedata" 
		},success: function(result){
			console.log(result);
			var html ='';
			html += '<p><b>กรม</b></p>';
			html += '<p>'+result.DEPARTMENT_NAME+'</p>';
			html += '<p><b>กระทรวง</b></p>';
			html += '<p>'+result.MINISTRY_NAME+'</p>';
			$('#text-ministry-other').html(html);
			$('#text-ministry-other').show();
		}
	});
}

</script>
<script>
  $(function () {
	$('.select2').select2();
  })
</script>
 <script src="<?=base_url()?>assets/js/hierarchy.js"></script>
</body>
</html>
