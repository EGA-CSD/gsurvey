<?php
$message		= $this->session->flashdata('message');
$message_title = $this->session->flashdata('message_title');
$message_check = $this->session->flashdata('message_check');
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<?=$pagetitle?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<form id="form-submit-food" class="form-horizontal" action="<?=base_url()?>users/saveedit" method="POST" enctype="multipart/form-data">
					<div class="box-body">
					<?php
						if(isset($message) && isset($message_title) && isset($message_check)){
							echo '<div class="alert alert-'.$message_check.' alert-dismissible">';
								echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
								echo '<h4><i class="icon fa fa-check"></i> '.$message_title.'</h4>';
								echo $message;
							echo '</div>';
							$this->session->unset_userdata('message');
							$this->session->unset_userdata('message_title');
							$this->session->unset_userdata('message_check');
						}
					?>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">ชื่อ-สกุล </label>
						<div class="col-sm-3">
							<input type="text" class="form-control user_name" name="user_name" value="<?=$data['user_name']?>" data-validation="required" placeholder="กรุณาระบุชื่อ-สกุล">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ที่อยู่</label>
						<div class="col-sm-3">
							<textarea rows="5" class="form-control user_addrass" name="user_addrass" placeholder="กรุณาระบุที่อยู่"><?=$data['user_addrass']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ตำแหน่ง</label>
						<div class="col-sm-3">
							 <select id="user_type_code" class="form-control select2" name="user_type_code" data-validation="required" style="width: 100%;">
								<option value="" selected="selected">เลือกตำแหน่ง</option>
								<?php
								if(isset($data['user_type'])){
									foreach($data['user_type'] as $type){
										if($data['user_type_code'] == $type['user_type_code']){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										echo '<option value="'.$type['user_type_code'].'" '.$selected.'>'.$type['user_type_name'].'</option>';
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">หมายเลขโทรศัพท์</label>
						<div class="col-sm-3">
							 <input type="text" class="form-control" name="user_tel" value="<?=$data['user_tel']?>" data-validation="required" placeholder="กรุณาระบุหมายเลขโทรศัพท์ "  maxlength="10">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ไปรษณีย์</label>
						<div class="col-sm-3">
							 <input type="text" class="form-control" name="user_post" value="<?=$data['user_post']?>" data-validation="required" placeholder="กรุณาระบุไปรษณีย์ "  maxlength="5">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">อัพโหลดรูปภาพ</label>
						<div class="col-sm-5">
							 <img class="url-img img-thumbnail" src="<?=$data['user_img']?>" style="width:30%" alt="...">
							 <input type="hidden" name="user_img_path" value="<?=$data['user_img_path']?>">
							 <input type="file" id="user_img" class="form-control" name="user_img" style="margin-top: 10px;" placeholder="กรุณาระบุอัพโหลดรูปภาพ ">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ชื่อผู้ใช้งานระบบ</label>
						<div class="col-sm-3">
							 <input type="text" class="form-control" name="user_login_name" value="<?=$data['user_login_name']?>" placeholder="กรุณาระบุชื่อผู้ใช้งานระบบ " readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">รหัสผ่าน</label>
						<div class="col-sm-3">
							 <input type="text" class="form-control" name="user_login_pass" value="<?=$data['user_login_pass']?>" placeholder="กรุณาระบุรหัสผ่าน " readonly>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<input type="hidden" name="user_code" value="<?=$data['user_code']?>">
					<button type="submit" id="btn-submit-food" class="btn btn-success btn-flat"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึกข้อมูล</button>
					<a href="<?=base_url();?>users" class="btn btn-default btn-flat">
						<i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ</a>
				</div>
				<!-- /.box-footer -->
				</form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
<script>
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
	
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
	}, 1500);
</script>
