var userId;
var programID;
var courseID;
function assignRollNo(event)
{
	$.ajax({
        method:'POST',
        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
        data:{'assignRollNo':'assignRollNo','userId':userId,'programID':programID,'courseID':courseID},
        success:function(response)
        {
        	var response=$.parseJSON(response);

        	if(response.success)
        	{
        		$('.pendingStudentData').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
        	else if(response.error)
        	{
        		$('.pendingStudentData').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
		}
	  });
}

function notAssignMe(event)
{
	$('.pendingStudentData').html('<p><strong>Please assign a roll number to the user.?</p><input type="number" required name="rollNo" id="rollNo" placeholder="Enter roll number.....!" class="form-control"><br><div class="text-center"><button type="button" class="btn btn-success btn-sm yesStudentAccept" onclick="assignRollNo(this)">Enroll Now</button><br>');
}

function yesStudentAccept(event)
{
	$.ajax({
        method:'POST',
        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
        data:{'pendingStudentAccept':'pendingStudentAccept','userId':userId,'programID':programID,'courseID':courseID},
        success:function(response)
        {
        	var response=$.parseJSON(response);

        	if(response.success)
        	{
        		$('.pendingStudentData').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
        	else if(response.error)
        	{
        		$('.pendingStudentData').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
		}
	  });
}

$(function(){


	$('[data-toggle="tooltip"]').tooltip()


	$('.form').on('submit',function(e){
		e.preventDefault();
		var form=$(this);
		submitForm(form);
	 });


    $('.passwordChangeModal,.paySalery,.payfeeModal,.courseDecision, .courseEnroll,.editFeeModel,.studentReject,.studentAccept,.pendingUserEdit, .addProgram, .editProgramModel, .delProgram, .addCourse, .editCourseModel, .delCourse, .addTeacher, .editTeacher, .delTeacher, .addNewShift, .editShift, .delShift').on('hidden.bs.modal', function () {
	   window.location.reload();
	});

	$('.detailCourse').click(function(){
		var id=$(this).attr('c_id');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/files/ajaxRequest.php',
	        data:{'courseDetail':'courseDetail','courseID':id,'admin_request':'admin_request'},
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
	   $('.ajaxCourseDetail').html('');
	});

	$('.deleteProgram').click(function(){

		var id=$(this).attr('programID');

		$('.yesDeleteProgram').click(function(){
			
			$.ajax({
		        method:'POST',
		        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
		        data:{'deleteProgram':'deleteProgram','delProgramID':id},
		        success:function(response){
		        	display=$('.delError');
					show_message(response,display);
				}
			});

		});
	});



	$('.deleteCourse').click(function(){
		var p_id=$(this).attr('programID');
		var c_id=$(this).attr('courseID');

		$('.yesDeleteCourse').click(function(){
			
			$.ajax({
		        method:'POST',
		        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
		        data:{'deleteCourse':'deleteCourse','programID':p_id,'courseID':c_id},
		        success:function(response){
		        	display=$('.delError');
					show_message(response,display);
				}
			});

		});
	});


	$('.deleteTeacher').click(function(){

		var id=$(this).attr('teacherId');


		$('.yesDeleteTeacher').click(function(){
			
			$.ajax({
		        method:'POST',
		        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
		        data:{'deleteTeacher':'deleteTeacher','teacher_id':id},
		        success:function(response){
		        	display=$('.delError');
					show_message(response,display);
				}
			});

		});
	});


	$('.deleteShift').click(function(){
		var classTimingID=$(this).attr('ct_id');
		var programID=$(this).attr('p_id');
		var courseID=$(this).attr('c_id');
		var teacherID=$(this).attr('t_id');

		$('.yesDeleteShift').click(function(){
			

			$.ajax({
		        method:'POST',
		        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
		        data:{'deleteShift':'deleteShift','classTimingID':classTimingID,'programID':programID,'courseID':courseID,'teacherID':teacherID},
		        success:function(response){
		        	display=$('.delError');
					show_message(response,display);
				}
			});

		});
	});


	$('.idLogOut').click(function(){
		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'logOutId':'logOutId'},
	        success:function(response){
	        	var response=$.parseJSON(response);
				window.location.reload();
			}
		})
	});


	$('.editProgram').click(function()
	{
		var programID=$(this).attr('programID');
		$('.formProgram').append('<input type="number" name="programID" value="'+programID+'" hidden>');
	});

	$('.editCourse').click(function()
	{
		var programID=$(this).attr('programID');
		var courseID=$(this).attr('courseID');

		$('.formCourse').append('<input type="number" name="programId" value="'+programID+'" hidden>');
		$('.formCourse').append('<input type="number" name="courseId" value="'+courseID+'" hidden>');
	});


	$(".searchCourseName").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".allCoursesTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	$(".searchProgramName").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".allProgramTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });


	$(".searchTeacherName").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".allTeachersTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });


	$(".searchTimeSlote").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".timeSloteAllData tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	$(".searchPendingStudent").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".pendingStudentAllData tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	$(".searchEnrollStudent").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".enrollStudentAllData tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	$(".searchFeeStudent").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".feeStudentAllData tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	$(".searchTeacherSalery").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $(".dataTeacherSalery tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });
	

	$('.teacherProfile').click(function(){
		var t_id=$(this).attr('teacherId');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'viewTeacherProfile':'viewTeacherProfile','teacherId':t_id,},
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


	$('.studentProfile').click(function(){
		var u_id=$(this).attr('userId');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'viewStudentProfile':'viewStudentProfile','userId':u_id,},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);
	        	if(response.success)
	        	{
	        		$('.studentProfileData').html(response.message);
	        	}
	        	else if(response.error)
	        	{
	        		$('.studentProfileData').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		});
	});


	$('.editDataTeacher').click(function(){
		var t_id=$(this).attr('teacherId');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'getEditDataTeacher':'getEditDataTeacher','teacherId':t_id},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.editProfileTeacher').html(response.message);
	        	}
			}
		});
	});

	$(".shiftProgram").on("change",function(){

		$('.passwordError').html('');
		var programID = $(this).val();
		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'getProgramCourses':'getProgramCourses','programID':programID},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.allCourseProgram').html(response.message);
	        	}
	        	else if(response.error)
	        	{
	        		$('.passwordError').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		});
	});

	$('.editTimeSlote').click(function(){
		var classTimingID=$(this).attr('ct_id');
		var programID=$(this).attr('p_id');
		var courseID=$(this).attr('c_id');
		var teacherID=$(this).attr('t_id');

		$('.shiftEditForm').append('<input type="number" name="classTimingID" value="'+classTimingID+'" hidden> <input type="number" name="courseID" value="'+courseID+'" hidden> <input type="number" name="teacherID" value="'+teacherID+'" hidden> <input type="number" name="programID" value="'+programID+'" hidden>');
	});


	$('.editPendingUser').click(function(){
		var userId=$(this).attr('userId');
		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'editPendingUser':'editPendingUser','userID':userId},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.editPendingUserForm').html(response.message);
	        	}
	        	else if(response.error)
	        	{
	        		$('.editPendingUserForm').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		});
	});

	$('.pendingStudentAccept').click(function(){

		userId=$(this).attr('userId');
		programID=$(this).attr('p_id');
		courseID=$(this).attr('c_id');

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'pendingStudentCheck':'pendingStudentCheck','userId':userId,'programID':programID,'courseID':courseID},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.pendingStudentData').html(response.message);
	        	}
	        	else if(response.error)
	        	{
	        		$('.pendingStudentData').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		  });
	});

	$('.pendingStudentReject').click(function(){
		userId=$(this).attr('userId');
		programID=$(this).attr('p_id');
		courseID=$(this).attr('c_id');

		$('.yesRejectStudent').click(function(){
			$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{'pendingStudentReject':'pendingStudentReject','userId':userId,'programID':programID,'courseID':courseID},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.delError').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");;
	        	}
	        	else if(response.error)
	        	{
	        		$('.delError').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		  });
		})
	});

	$('.editfees').click(function(){
		programID=$(this).attr('programID');
		courseID=$(this).attr('courseID');

		
		$('.editFeesForm').append('<input type="number" name="programId" value="'+programID+'" hidden>');
		$('.editFeesForm').append('<input type="number" name="courseId" value="'+courseID+'" hidden>');
	});

	$('.decisionCourse').click(function(){
		var userId=$(this).attr('userId');
		var rollNo=$(this).attr('rollNo');

		$('.yesCompleteCourse').click(function(){
			$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{course:'completeCourse','userId':userId,'rollNo':rollNo},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.courseDecision_error').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");;
	        	}
	        	else if(response.error)
	        	{
	        		$('.courseDecision_error').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		  });
		});

		$('.yesDiscontinueCourse').click(function(){
			$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{course:'discontinueCourse','userId':userId,'rollNo':rollNo},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.courseDecision_error').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");;
	        	}
	        	else if(response.error)
	        	{
	        		$('.courseDecision_error').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		  });
		});
	
	});

	var rollNo;
	$('.payStudent').click(function(){
		userId=$(this).attr('userId');
	    rollNo=$(this).attr('rollNo');

	    $.ajax({
        method:'POST',
        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
        data:{payfee:'totalCalculation','userId':userId,'rollNo':rollNo},
        success:function(response)
        {
        	var response=$.parseJSON(response);

        	if(response.success)
        	{
        		if(response.newAmount)
        		{
        		   $('.payfeeBody').html(response.newAmount);
        		}

        		$('.totalCalculation').html(response.message);
        	}
        	else if(response.error)
        	{
        		$('.payfeeBody').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
		}
	  });
	});

	$('.yesAmountPayCourse').click(function(){
		var payAmount=$('#payfee').val();

	    $.ajax({
        method:'POST',
        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
        data:{'payAmount':payAmount,'userId':userId,'rollNo':rollNo},
        success:function(response)
        {
        	var response=$.parseJSON(response);

        	if(response.success)
        	{
        		if(response.amountAdded)
        		{
        			$('.totalCalculation').html(response.amountAdded);
        		}

        		$('.payAmout_error').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
        	else if(response.error)
        	{
        		$('.payAmout_error').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
        	}
		}
	  });
	});

	$('.teacherPaySalery').click(function(){
		var teacherId=$(this).attr('teacherId');

		$('.yesPaySalery').click(function(){
			

			var dectect=$('#dectect').val();

			$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{teacherPaySalery:'teacherPaySalery','teacherId':teacherId,'dectect':dectect},
	        success:function(response)
	        {
	        	var response=$.parseJSON(response);

	        	if(response.success)
	        	{
	        		$('.paySalery_error').html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");;
	        	}
	        	else if(response.error)
	        	{
	        		$('.paySalery_error').html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	        	}
			}
		  });
		});
	});

	$('#btnChangePassword').click(function(){

		var old_pass=$('#old_pass').val();
		var new_pass=$('#new_pass').val();
		var confirm_pass=$('#confirm_pass').val();

		$.ajax({
	        method:'POST',
	        url:window.location.origin+'/academy/admin/files/ajaxRequest.php',
	        data:{changePassword:'changePassword','old_pass':old_pass,'new_pass':new_pass,'confirm_pass':confirm_pass},
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


function submitForm(form)
{
	var footer=form.parent('.modal-body').next('.modal-footer');
	var file1=form.get(0).image;
	if (file1===undefined || file1==null || file1==='') 
	{	
		$.ajax({
		url:form.attr('action'),
		method:form.attr('method'),
		data:form.serialize(),
		success:function(response){
			show_message(response,footer);
		}

      });

	}
	else
	{
		var formData = new FormData($(form)[0]);

		$.ajax({
			method:form.attr('method'),
			url:form.attr('action'),
			data:formData,
			success:function(response){
				show_message(response,footer);
			},
			cache: false,
		    contentType: false,
		    processData: false,

		});
   }		
}

function show_message(response,display)
{
	var response=$.parseJSON(response);

	if (response.success) 
	{
		if (response.signout)
		{
			setTimeout(function(){
				window.location.reload();
			},2000);
		}
		else if (response.url) 
		{
			setTimeout(function(){
				window.location=response.url;
			},2000);
		}

		display.html("<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	}
	else if(response.error)
	{
		display.html("<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>"+response.message+"</p>");
	}

}

});