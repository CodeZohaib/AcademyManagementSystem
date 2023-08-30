jQuery(document).ready(function() {
	
	$('.detailCourse').click(function(){
		var id=$(this).attr('c_id');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/files/ajaxRequest.php',
	        data:{'courseDetail':'courseDetail','courseID':id},
	        success:function(response){
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.ajaxCourseDetail').html(response.message);
	        	}
				

				if(response.error)
				{
					$('.ajaxCourseDetail').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
				}
			}
		});
	});


	$('.viewCourseDetail').on('hidden.bs.modal', function () {
	  $('.courseEnroll').css('overflow-y', 'auto');
	});


	$('.applyCourse').click(function(){
		var c_id=$(this).attr('c_id');
		var p_id=$(this).attr('p_id');

		$('.applyCourseForm').append('<input type="number" name="programID" value="'+p_id+'" hidden><input type="number" name="courseID" value="'+c_id+'" hidden>');
	});

	$('.applyCourseForm').on('submit',function(e){
		e.preventDefault();

		var form=$(this);
		$.ajax({
	        url:form.attr('action'),
			method:form.attr('method'),
			data:form.serialize(),
	        success:function(response){
	        	var response=$.parseJSON(response);	

	        	if(response.success)
	        	{
	        		$('.passwordError').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}

	        	if(response.error)
	        	{
	        		$('.passwordError').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		});
	});

		$('.teacherProfile').click(function(){
		var t_id=$(this).attr('teacherId');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/files/ajaxRequest.php',
	        data:{'viewTeacherProfile':'viewTeacherProfile','userView':'userView','teacherId':t_id,},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.teacherProfileData').html(response.message);
	        	}
			}
		});
	});


	$('.viewCourseDetail').on('hidden.bs.modal', function () {
	   $('.ajaxCourseDetail').html('');
	});

	$('.courseEnroll, .forgortpassword').on('hidden.bs.modal', function () {
	   window.location.reload();
	});

	$('#btnforgotPassword').click(function(){
		
		  var emailAddress=$('#forgotPasswordVal').val();

			$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/files/ajaxRequest.php',
	        data:{forgotPassword:'forgotPassword','emailAddress':emailAddress},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.passwordError').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");;
	        	}
	        	else if(response.error)
	        	{
	        		$('.passwordError').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		  });
		});

});


function applyCourse(event) 
{
  var c_id = $(event).attr('c_id');
  var p_id = $(event).attr('p_id');

  $('.applyCourseForm').append('<input type="number" name="programID" value="' + p_id + '" hidden><input type="number" name="courseID" value="' + c_id + '" hidden>');
}
