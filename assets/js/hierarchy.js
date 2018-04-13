   
$("#level1").change(function(){
	var searchThis = $(this).val();
	var other = '';
	$.ajax({
		type: "POST",
		url: post_url,
		dataType : "json",
		data : { 
			 code 		: $(this).val()
			,action 	:"department" 
	},success: function(result){
			var opt ="<option value='' selected='selected'>เลือกกรม</option>"; // Create Element
			$.each(result.data.department,function(key,val){ // วน Loop array json
				opt+="<option value='"+val['DEPARTMENT_CODE']+"'>"+val['DEPARTMENT_NAME']+"</option>"; // เพิ่ม Option เข้าไปในตัวแปร
			});
			//opt+='<option value="Other">อื่นๆ</option>';
			$("select#level2").html(opt);
		}
	});
	// console.log(searchThis);
	// if(searchThis == 'Other'){
	// 	$('#text-ministry-other').show();
	// 	other += '<input type="text" id="ministry_other" class="form-control" name="ministry_other" value="" data-validation="required" placeholder="ระบุชื่อกระทรวง">';
	// 	other += '<span class="glyphicon glyphicon-edit form-control-feedback"></span>';
	// 	$("#text-ministry-other").html(other);
	// 	get_validate(); // เช็ค validate	
	// }else{
	// 	$("#text-ministry-other").hide().removeClass('has-error');
	// 	$("#text-ministry-other").html(other);
	// }
});

$("#level2").change(function(){
	var other = '';
	var searchThis = $(this).val();
	$.ajax({
		type: "POST",
		url: post_url,
		dataType : "json",
		data : { 
			 code 		: $(this).val()
			,action 	: "organize" 
	},success: function(result){
			var opt ="<option value='' selected='selected'>เลือกหน่วยงาน</option>"; // Create Element
			$.each(result.data.organize,function(key,val){ // วน Loop array json
				opt+="<option value='"+val['ORG_CODE']+"'>"+val['ORG_NAME']+"</option>"; // เพิ่ม Option เข้าไปในตัวแปร
			});
			//opt+='<option value="Other">อื่นๆ</option>';
			$("select#level3").html(opt);
		}
	});
	
	// if(searchThis == 'Other'){
	// 	$('#text-department-other').show();
	// 	other += '<input type="text" id="department_other" class="form-control" name="department_other" value="" data-validation="required" placeholder="ระบุชื่อกรม">';
	// 	other += '<span class="glyphicon glyphicon-edit form-control-feedback"></span>';
	// 	$("#text-department-other").html(other);
	// 	get_validate(); // เช็ค validate
	// }else{
	// 	$("#text-department-other").hide().removeClass('has-error');
	// 	$("#text-department-other").html(other);
	// }

});

$("#level3").change(function(){
	// var other = '';
	// var searchThis = $(this).val();
	
	// if(searchThis == 'Other'){
	// 	$('#text-organize-other').show();
	// 	other += '<input type="text" id="organize_other" class="form-control" name="organize_other" value="" data-validation="required" placeholder="ระบุชื่อหน่วยงาน">';
	// 	other += '<span class="glyphicon glyphicon-edit form-control-feedback"></span>';
	// 	$("#text-organize-other").html(other);
	// 	get_validate(); // เช็ค validate
	// }else{
	// 	$("#text-organize-other").hide().removeClass('has-error');
	// 	$("#text-organize-other").html(other);
	// }

});
$("#register").click(function(){

	var message = '';
	

	var organize_code = $('#level3').find('option:selected').val();
	var user_email = $('#user_email').val();


	$.ajax({
		type: "POST",
		url: post_url,
		dataType : "json",
		data : { 
			 code 		: organize_code
			,action 	: "verifyuser" 
	},success: function(result){
			
		$.each(result.data.verifyuser,function(key,val){ // วน Loop array json
		
			$('#display_form_register').hide();

			$('#messages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();

			message += "<h4  style = 'text-align: center'>คุณทำการได้ลงทะเบียนเรียบร้อยแล้ว</h4><br>";
			message += "<div style='font-size:120%;'><br >UserName สำหรับเข้าระบบของคุณคือ<font color='blue'><strong> " +val['USERNAME']+"</strong></font>";
			message += "<br>และรหัสผ่านคือ <font color='blue'><strong>" +val['PASSWORD']+"</font></strong>";
			message += "<br>ระบบได้ส่ง username/password ไปที่ <strong><font color='blue'>" +user_email+ " </font></strong>ที่คุณได้ทำการลงทะเบียนไว้ เรียบร้อยแล้ว<br></div>";
		
			$('#messages_content').html(message);
			$('#modal').modal('show');


		
		});
		}
	});

	
});

function get_validate(){
	$.validate({
		modules: 'security, file',
		onModulesLoaded: function () {
			$('input[name="pass_confirmation"]').displayPasswordStrength();
		}
	});
}