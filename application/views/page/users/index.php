
<?php
$message			= $this->session->flashdata('message');
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

            <div class="box-header">
				<a href="<?=base_url();?>users/add" class="btn btn-success btn-flat"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อมูล</a>
				<button type="button" id="btn-delete-item" class="btn btn-danger btn-flat hidden"><i class="fa fa-trash-o" aria-hidden="true"></i> ลบข้อมูล</button>
            </div>
            <!-- /.box-header -->
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
				<table id="example1" class="table table-bordered table-striped table-item">
                <thead>
					<tr>
						<th style="width:5%">
							<label>
								<input type="checkbox" id="select-all" class="minimal">
							</label>
						</th>
						<th>ชื่อพนักงาน</th>
						<th>เอบร์โทรศัพท์</th>
						<th>ตำแหน่ง</th>
						<th>สถานะ</th>
						<th style="width:5%">Action</th>
					</tr>
                </thead>
                <tbody>
					<?php
					
					if(isset($data['user'])){
						foreach($data['user'] as $item){
							echo '<tr>';
								echo '<td>';
									echo '<label>';
										echo '<input type="checkbox" class="minimal select-by-item" value="'.$item['user_code'].'"  data-name-item="'.$item['user_name'].'">';
									echo '</label>';
								echo '</td>';
								echo '<td>'.$item['user_name'].'</td>';
								echo '<td>'.$item['user_tel'].'</td>';
								echo '<td>'.$item['user_type_name'].'</td>';
								echo '<td>'.$item['is_active'].'</td>';
								echo '<td>';
									echo '<a href="'.base_url().'users/edit/?code='.base64_encode($item['user_code']).'" class="btn btn-warning btn-flat" data-toggle="tooltip" title="แก้ไขข้อมูล">';
										echo '<i class="fa fa-edit" aria-hidden="true"></i>';
									echo '</a>';
								echo '</td>';
							echo '</tr>';
						}
					}
					
					?>
					
				</tbody>
				</table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  
   <div class="modal fade" id="modal-confirm-delete">
		<div class="modal-dialog">
			<div class="modal-content">
			<form id="form-submit-food" class="form-horizontal" action="<?=base_url()?>users/delete" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">ยืนยันการลบข้อมูล</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-center">รายการที่ต้องการลบจำนวน <small id="text-total-delete-item" class="label bg-red">0</small> รายการ</h4>
					<ul id="text-confirm-food-item" class="nav nav-pills nav-stacked">
						
					</ul>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-flat">
						<i class="fa fa-check-square-o" aria-hidden="true"></i> ยืนยันการลบ</button>
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> ปิดหน้าต่าง</button>
				</div>
				</from>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
		
  <script>
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
    });
	
	$('#select-all').on('ifChecked', function(event){
		$('.table-item tbody .select-by-item').iCheck('check');
		$('#btn-delete-item').removeClass('hidden');
	});
	
	$('#select-all').on('ifUnchecked', function (event) {
		$('.table-item tbody .select-by-item').iCheck('uncheck');
		$('#btn-delete-item').addClass('hidden');
	});
	
	$('.table-item tbody .select-by-item').on('ifChecked', function(event){
		if($('.table-item tbody .select-by-item').filter(":checked").length > 0){
			$('#btn-delete-item').removeClass('hidden');
		}
	});
	
	$('.table-item tbody .select-by-item').on('ifUnchecked', function (event) {
		if($('.table-item tbody .select-by-item').filter(":checked").length < 1){
			$('#btn-delete-item').addClass('hidden');
		}
	});
	
	$('#btn-delete-item').click(function(){
		var html ='';
		$('#text-total-delete-item').text($('.table-item tbody .select-by-item').filter(":checked").length);
		$($('.table-item tbody .select-by-item').filter(":checked")).each(function(){
			html += '<li>';
				html += '<a href="javascript:void(0)">';
					html += '<i class="fa fa-check-square-o text-light-blue"></i> '+$(this).attr('data-name-item');
				html += '</a>';
				html += '<input type="hidden" name="item_code[]" value="'+$(this).val()+'">';
			html += '</li>';
		});
		
		$('#text-confirm-food-item').html(html);
		$('#modal-confirm-delete').modal('show');
	});

	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 1500);
	
  </script>
 

