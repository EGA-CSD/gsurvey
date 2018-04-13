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
				<form id="form-submit-food" class="form-horizontal" action="<?=base_url()?>items/saveadd" method="POST" enctype="multipart/form-data">
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
						</div>
					</div>
					<div class="form-group" style="padding-top: 20px;">
						<label class="col-sm-2 control-label">รายละเอียดผู้ให้ข้อมูล</label>
						<div class="col-sm-3" >
							<input type="text" class="form-control" name="user_card" value="" data-validation="required" maxlength ="13" placeholder="ระบุชื่อ">
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="user_card" value="" data-validation="required" maxlength ="13" placeholder="ระบุนามสกุล">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-6">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-envelope"></span> 
								</div>
								<input class="form-control" id="email" name="email" type="text" placeholder="ระบุ email ที่ใช้ในการติดต่อ"/>
							</div>				
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-6">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-phone"></span> 
								</div>
								<input class="form-control" id="tel" name="email" type="text" placeholder="ระบุเบอร์โทรศัพท์ ที่ใช้ในการติดต่อ"/>
							</div>
							<hr>
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
									<?php
									if(isset($data['document'])){
										$row = count($data['document']);
									}
									?>
									<tr class="active">
										<th rowspan="2" class="text-center" style="width: 5%;">#</th>
										<th rowspan="2" style="width: 50%;">กระบวนการ/คู่มือหน่วยงาน</th>
										<th colspan="<?=$row?>" class="text-center" style="width: 30%;">เอกสาร</th>
									</tr>
									<tr class="active">
										<?php
										if(isset($data['document'])){
											for($y=0; $y < $row; $y++){
												echo '<th style="width: 20%;">';
													echo '<label style="margin-right: 15px;">';
														echo '<input type="checkbox" class="minimal all-active" value="'.$y.'">&nbsp&nbsp ทั้งหมด';
													echo '</label>';
												echo '</th>';
											}
										}
										?>

									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($data['procedure_name'])){
										$i=1;
										foreach($data['procedure_name'] as $pro){
											echo '<tr id="tr-line-'.$i.'">';
												echo '<td class="text-center">'.$i.'</td>';
												echo '<td>'.$pro['PRO_NAME'];
													echo '<input type="hidden" name="PRO_CODE[]" value="'.$pro['PRO_CODE'].'">';
												echo '</td>';
											
												if(isset($data['document'])){
													$x=0;
													foreach($data['document'] as $doc){
													echo '<td>';
														echo '<label style="margin-right: 15px;">';
															echo '<input type="checkbox" name="is_active" class="minimal btn-check-box check-box-line-'.$x.'" value="" data-line="'.$i.'" data-id="'.$doc['DOC_ID'].'">&nbsp&nbsp '.$doc['DOC_NAME'];
															echo '<input type="hidden" class="input-doc-'.$doc['DOC_ID'].' input-box-line-'.$x.'" name="DOC_ID_'.$x.'[]" value="N">';
														echo '</label>';
														$x++;
													echo '</td>';
													}
												}
												
											echo '</tr>';
										$i++;
										}
									}
									
									?>
									
									
								</tbody>
							</table>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ปัญหาและอุปสรรค</label>
						<div class="col-sm-6" style="margin-top: 7px;">
							<?php
							if(isset($data['problem'])){
								foreach($data['problem'] as $item){
									echo '<p>';
										echo '<label style="margin-right: 15px;">';
											echo '<input type="checkbox" name="PROB_ID[]" class="minimal" value="'.$item['PROB_ID'].'"><span>&nbsp&nbsp '.$item['PROB_NAME'].'</span>';
										echo '</label>';
									echo '</p>';
								}
							}
							?>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="<?=base_url()?>items/procedure" class="btn btn-primary btn-flat"><i class="fa fa-arrow-circle-left"></i> ย้อนกลับ</a>
					<button type="submit" id="btn-submit-food" class="btn btn-success btn-flat"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึกข้อมูล</button>					
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
	
	$('.btn-check-box').on('ifChanged', function () {
		if($(this).is(':checked')){
			 $("#tr-line-"+$(this).attr('data-line')+" label").find(".input-doc-"+$(this).attr('data-id')).val('Y');
		}else{
			 $("#tr-line-"+$(this).attr('data-line')+" label").find(".input-doc-"+$(this).attr('data-id')).val('N');
		}
		
	});

	$('.all-active').on('ifChanged', function () {
		if($(this).is(':checked')){
			$(".check-box-line-"+$(this).val()).iCheck('check');
			$(".input-box-line-"+$(this).val()).val('Y');
		}else{
			$(".check-box-line-"+$(this).val()).iCheck('uncheck');
			$(".input-box-line-"+$(this).val()).val('N');
		}
	});
	
	
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 1500);
</script>
 <script src="<?=base_url()?>/assets/js/hierarchy.js"></script>