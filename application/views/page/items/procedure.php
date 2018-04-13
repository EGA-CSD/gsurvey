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
	  <?=$pagetitle?> (รหัสหน่วยงาน <?=$data['ORG_CODE']?>)
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<form id="form-submit-food" class="form-horizontal" action="<?=base_url()?>items/add" method="POST" enctype="multipart/form-data">
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
						<label class="col-sm-2 control-label">กระทรวง</label>
						<div class="col-sm-6">
							<p style="margin-top: 7px;"><?php echo $data['MINISTRY_NAME']?:'ไม่พบข้อมูล';?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">กรม</label>
						<div class="col-sm-6">
							<p style="margin-top: 7px;"><?php echo $data['DEPARTMENT_NAME']?:'ไม่พบข้อมูล';?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">หน่วยงาน</label>
						<div class="col-sm-6">
							<p style="margin-top: 7px;"><?php echo $data['ORG_NAME']?:'ไม่พบข้อมูล';?></p>
							<div class="form-group">
								<p class="col-sm-2" style="color:red;"><b>แก้ไขล่าสุด</b></p>
								<div class="col-sm-10">
									<ul>
										<li><p><b>สมชาย ใจดี</b> เมื่อวันที่ 11/04/2561 , 12:30 น. (ข้อมูลตัวอย่าง)</p></li>
										<li><p><b>สมชาย ใจดี</b> เมื่อวันที่ 11/04/2561 , 12:30 น. (ข้อมูลตัวอย่าง)</p></li>
										<li><p><b>สมชาย ใจดี</b> เมื่อวันที่ 11/04/2561 , 12:30 น. (ข้อมูลตัวอย่าง)</p></li>
									</ul>
									
								</div>
							</div>	
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 control-label">ส่วนงานบริการภาครัฐ</label>
						<div class="col-sm-10">
							<h5 style="color: red;"><b>ยืนยันกระบวนการหรือคู่มือหน่วยงานของท่านกรุณากรอก<?=$pagetitle?> ดังนี้<b></h5>
							<table class="table table-striped">
								<thead>
									<tr class="active">
										<th class="text-center" style="width: 5%;" rowspan="2">#</th>
										<th rowspan="2" style="width: 20%;">กระบวนการ/คู่มือหน่วยงาน</th>
										<th colspan="2" style="width: 50%; text-align:center;">ยืนยันกระบวนงาน</th>
									</tr>
									<tr  class="active">
										<th style="width: 20%; text-align:center;">
											<label style="margin-right: 15px;">
												<input type="radio" name="boxAll" class="minimal btn-check-boxAll" value="0"> ใช้(ทั้งหมด)
											</label>
										</th>
										<th style="width: 20%;text-align:center">
											<label style="margin-right: 15px;">
												<input type="radio" name="boxAll" class="minimal btn-check-boxAll" value="1"> ไม่ใช้(ทั้งหมด)
											</label>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($data['procedure_name'])){
										$i=1;
										foreach($data['procedure_name'] as $pro){
											echo '<tr id="tr-line-'.$i.'">';
												echo '<td class="text-center">'.$i.'</td>';
												echo '<td>';
													echo $pro['PRO_NAME'];
													echo '<input type="hidden" name="PRO_CODE[]" value="'.$pro['PRO_CODE'].'">';
													echo '<input type="hidden" id="input-doc-'.$pro['PRO_CODE'].'" class="input-value-active" name="is_active[]" value="" >';
												echo '</td>';
												echo '<td style = "text-align:center;">';
													echo '<label style="margin-right: 15px;">';
													echo '<input type="radio" name="is_check'.$i.'[]" class="minimal btn-check-box check-box-line-0" value="1" data-line="'.$i.'" data-id="'.$pro['PRO_CODE'].'">';
												echo '</label>';
												echo '</td>';
												echo '<td style = "text-align:center;">';
													echo '<label style="margin-right: 15px;">';
														echo '<input type="radio" name="is_check'.$i.'[]" class="minimal btn-check-box check-box-line-1" value="0" data-line="'.$i.'" data-id="'.$pro['PRO_CODE'].'">';
													echo '</label>';

												echo '</td>';
											echo '</tr>';
										$i++;
										}
									}
									?>
								</tbody>
							</table>
							
						</div>
					</div>
					
				</div>
				<!-- /.box-body -->
				<div class="box-footer text-right">
					<button type="button" id="btn-submit-food" class="btn btn-success btn-flat">หน้าถัดไป <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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

	$("#btn-submit-food").click(function(){
		var i = 0;
		$(".input-value-active").each(function(){
			if($(this).val() == ""){
				i++;
			}
		});

		if(i > 0){
			alert('กรุณายืนยันกระบวนงานหรือคู่มือของหน่วยงานของท่าน เหลืออีก '+i+' ข้อ');
			return false;
		}else{
			$("#form-submit-food").submit();
		}
	});

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
	
	$('.btn-check-box').on('ifChanged', function () {
		if($(this).is(':checked')){
			 $("#tr-line-"+$(this).attr('data-line')).find("#input-doc-"+$(this).attr('data-id')).val($(this).val());
		}else{
			 $("#tr-line-"+$(this).attr('data-line')).find("#input-doc-"+$(this).attr('data-id')).val($(this).val());
		}
	});

	$('.btn-check-boxAll').on('ifChanged', function () {
		if($(this).val() == '0'){
			$(".check-box-line-"+$(this).val()).iCheck('check');
		}else{
			$(".check-box-line-"+$(this).val()).iCheck('check');
		}
		
	});
	
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 1500);
</script>
 <script src="<?=base_url()?>/assets/js/hierarchy.js"></script>