<?php 
include "connection2.php";


if(isset($_POST['addNewProgram']))
{
	//In this conditions add new program
	if(!empty($_POST['addNewProgram']))
	{
		$program=strtolower($_POST['addNewProgram']);
		$val2=str_replace(" ", "", $program);

		$run=$con->prepare("SELECT * FROM program WHERE (program=? OR program=?) AND status!=?");

		$run->bindParam(1,$program,PDO::PARAM_STR);
		$run->bindParam(2,$val2,PDO::PARAM_STR);
		$run->bindValue(3,'delete',PDO::PARAM_STR);


    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        return MsgDisplay('error','Program is Already Exist.....!');
      }
      else
      {
      	$run=$con->prepare("INSERT INTO `program`(`program`) VALUES (?)");
      	if(is_object($run))
      	{
      		$run->bindParam(1,$program,PDO::PARAM_STR);
	        if($run->execute())
	        {
	        	return MsgDisplay('success','Program is Added Successfully.....!','');
	        }
      	}
      }
    }
	}
}
else if(isset($_POST['logOutId']))
{//In this conditions admin ID logout

	session_destroy();
	unset($_SESSION['adminLogin']);
	return MsgDisplay('success','success','');
}
else if(isset($_POST['changeProgramPrivacy']) AND isset($_POST['programID']))
{
	//In this conditions Change Program Privacy like program publish or private
	$programID=$_POST['programID'];
	$status=$_POST['changeProgramPrivacy'];

	$run=$con->prepare("SELECT * FROM program WHERE id=? AND status!=?");

	$run->bindParam(1,$programID,PDO::PARAM_INT);
	$run->bindValue(2,'delete',PDO::PARAM_STR);
    if($run->execute())
    {
      if($run->rowCount()>0)
      {
      	$program=$run->fetch(PDO::FETCH_ASSOC);

      	if($program['status']==$status)
      	{
      		return MsgDisplay('error','('.ucwords($program['status']).') Privacy Already Apply.....!');
      	}

        $run=$con->prepare("UPDATE `program` SET `status`=? WHERE id=?");
      	if(is_object($run))
      	{
      		$run->bindParam(1,$status,PDO::PARAM_STR);
      		$run->bindParam(2,$programID,PDO::PARAM_INT);
	        if($run->execute())
	        {

	        	$run=$con->prepare("UPDATE `courses` SET `c_status`=? WHERE p_id=? AND c_status=?");
		      	if(is_object($run))
		      	{
		      		if($program['status']=='publish')
		      		{
		      			$updateStatus='p_private';
		      			$c_status='publish';
		      		}
		      		else if($program['status']=='private')
		      		{
		      			$updateStatus='publish';
		      			$c_status='p_private';
		      			
		      		}
		      		$run->bindParam(1,$updateStatus,PDO::PARAM_STR);
		      		$run->bindParam(2,$programID,PDO::PARAM_INT);
		      		$run->bindParam(3,$c_status,PDO::PARAM_STR);

			        if($run->execute())
			        {
			        	return MsgDisplay('success','Program Privacy Change Successfully.....!','');
			        }
			      }
	        }
      	}
      }
      else
      {
      	return MsgDisplay('error','Invalid Program Privacy Change.....!');
      }
    }
}
else if(isset($_POST['deleteProgram']) AND isset($_POST['delProgramID']))
{

	//In this conditions delete Program but not permanent delete just despair to admin side
	$programID=$_POST['delProgramID'];
	$run=$con->prepare("SELECT * FROM program WHERE id=?");

	  $run->bindParam(1,$programID,PDO::PARAM_INT);
    if($run->execute())
    {
      if($run->rowCount()>0)
      {
      	$data=$run->fetch(PDO::FETCH_ASSOC);
        $run=$con->prepare("UPDATE `program` SET `status`=? WHERE id=?");
      	if(is_object($run))
      	{
      		$status='delete';
      		$run->bindParam(1,$status,PDO::PARAM_STR);
      		$run->bindParam(2,$programID,PDO::PARAM_INT);
	        if($run->execute())
	        {
	        	$run=$con->prepare("UPDATE `courses` SET `c_status`=? WHERE p_id=? AND c_status IN(?,?,?)");
		      	if(is_object($run))
		      	{
		      		$updateStatus='p_delete';

		      		$run->bindParam(1,$updateStatus,PDO::PARAM_STR);
		      		$run->bindParam(2,$programID,PDO::PARAM_INT);
		      		$run->bindValue(3,'publish',PDO::PARAM_STR);
		      		$run->bindValue(4,'private',PDO::PARAM_STR);
		      		$run->bindValue(5,'p_private',PDO::PARAM_STR);

			        if($run->execute())
			        {
			        	return MsgDisplay('success',' The deletion of the ('.ucwords($data['program']).') program and all related courses was successful......!','');
			        }
			      }
	        }
      	}
      }
      else
      {
      	return MsgDisplay('error','Invalid Program Not Exist.....!');
      }
    }
}
else if(isset($_POST['courseName']) AND isset($_POST['programID']) AND isset($_POST['fee']) AND isset($_POST['duration']) AND isset($_FILES['image']))
{
	//In this conditions add new course

	if(!empty($_POST['courseName']) AND !empty($_POST['programID']) AND !empty($_POST['fee']) AND !empty($_POST['duration']) AND !empty($_FILES['image'])) 
	{
		$p_id=$_POST['programID'];
		$c_name=strtolower($_POST['courseName']);
		$c_fee=$_POST['fee'];
		$c_duration=$_POST['duration'];
		$c_description=$_POST['description'];


		$val1=strtolower($c_name);
		$val2=str_replace(" ", "", $val1);

		$run=$con->prepare("SELECT * FROM courses WHERE (c_name=? OR c_name=?) AND c_status!=?");

		$run->bindParam(1,$val1,PDO::PARAM_STR);
		$run->bindParam(2,$val2,PDO::PARAM_STR);
		$run->bindValue(3,'delete',PDO::PARAM_STR);


    if($run->execute())
    {
      if($run->rowCount()>0)
      {
      	return MsgDisplay('error',ucwords($c_name).' Course Allready Lunch.......!');
      }
    }

		$run=$con->prepare("SELECT * FROM program WHERE id=? AND status=?");
	  $run->bindParam(1,$p_id,PDO::PARAM_INT);
	  $run->bindValue(2,'publish',PDO::PARAM_STR);
    if($run->execute())
    {
      if($run->rowCount()>0)
      {
      	$allowed_ext=array('JPG','jpg','jpeg','GIF','PNG','png');;
		    $exp=explode(".", $_FILES['image']['name']);
		    $end=end($exp);
		    $image_name=mt_rand(1111,9999).'_'.preg_replace('/\s+/', '', $_FILES['image']['name']);
		    $path="../../img/course_img/$image_name";
		    $temp=$_FILES['image']['tmp_name'];

		    if(in_array($end,$allowed_ext))
				{
					if (move_uploaded_file($temp, $path)) 
				  {
				  	$run=$con->prepare("INSERT INTO `courses`(`p_id`, `c_name`, `c_fee`, `c_duration`,`c_description`, `c_image`) VALUES (?,?,?,?,?,?)");

				  	$run->bindParam(1,$p_id,PDO::PARAM_INT);
	          $run->bindParam(2,$c_name,PDO::PARAM_STR);
	          $run->bindParam(3,$c_fee,PDO::PARAM_INT);
	          $run->bindParam(4,$c_duration,PDO::PARAM_STR);
	          $run->bindParam(5,$c_description,PDO::PARAM_STR);
	          $run->bindParam(6,$image_name,PDO::PARAM_STR);

	          if($run->execute())
	          {
	          	return MsgDisplay('success','Course Added Successfully.....!','');
	          }
				  }
				}
				else
				{
					return MsgDisplay('error','Your Image Type is Invalid Only Allowed this Type <br>=> JPG,JPEG,GIF,PNG....!');
				}
      }
      else
	    {
	    	return MsgDisplay('error','Invalid Program Select....!');
	    }
    }
	}
	else
	{
		return MsgDisplay('error','All Field Are Mandatory.......!');
	}
}
else if(isset($_POST['changeCoursePrivacy']) AND isset($_POST['programId']) AND isset($_POST['courseId']))
{
	//In this conditions change course Privacy

	if(!empty($_POST['changeCoursePrivacy']) AND !empty($_POST['programId']) AND !empty($_POST['courseId']))
	{
		$status=$_POST['changeCoursePrivacy'];
		$programId=$_POST['programId'];
		$courseId=$_POST['courseId'];

		if($status=='publish' OR $status=='c_private')
		{
			$run=$con->prepare('SELECT * FROM `courses` WHERE id=? AND p_id=? AND c_status NOT IN(?,?)');
			$run->bindParam(1,$courseId,PDO::PARAM_INT);
			$run->bindParam(2,$programId,PDO::PARAM_INT);
			$run->bindValue(3,'p_delete',PDO::PARAM_STR);
			$run->bindValue(4,'c_delete',PDO::PARAM_STR);

			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$course=$run->fetch(PDO::FETCH_ASSOC);

					if($course['c_status']==$status)
	      	{
	      		return MsgDisplay('error','('.htmlspecialchars(ucwords($course['c_status'])).') Privacy Already Apply.....!');
	      	}

					$run=$con->prepare('UPDATE `courses` SET `c_status`=? WHERE id=? AND p_id=?');

					$run->bindParam(1,$status,PDO::PARAM_STR);
					$run->bindParam(2,$courseId,PDO::PARAM_INT);
			    $run->bindParam(3,$programId,PDO::PARAM_INT);
			    

			    if($run->execute())
			    {
			    	return MsgDisplay('success','Course Privacy Change Successfully.....!','');
			    }
				}
				else
				{
					return MsgDisplay('error','Invalid Course Privacy Change.....!','');
				}
			}
	  }
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!','');

}
else if(isset($_POST['deleteCourse']) AND isset($_POST['programID']) AND isset($_POST['courseID']))
{
	//Delete Course

	$programId=$_POST['programID'];
	$courseId=$_POST['courseID'];

	$run=$con->prepare('SELECT * FROM `courses` WHERE id=? AND p_id=? AND c_status NOT IN(?,?)');
	$run->bindParam(1,$courseId,PDO::PARAM_INT);
	$run->bindParam(2,$programId,PDO::PARAM_INT);
	$run->bindValue(3,'p_delete',PDO::PARAM_STR);
	$run->bindValue(4,'c_delete',PDO::PARAM_STR);

	if($run->execute())
	{
		if($run->rowCount()>0)
		{
			$run=$con->prepare('UPDATE `courses` SET `c_status`=? WHERE id=? AND p_id=?');
			$run->bindValue(1,'c_delete',PDO::PARAM_STR);
			$run->bindParam(2,$courseId,PDO::PARAM_INT);
	    $run->bindParam(3,$programId,PDO::PARAM_INT);
	    
	    if($run->execute())
	    {
	    	return MsgDisplay('success','Course Successfully Deleted.....!','');
	    }
    }
    else
    {
    	return MsgDisplay('error','Invalid Course.....!','');
    }
  }

  return MsgDisplay('error','Something Was Wrong Please Try Again.....!','');
}
else if(isset($_POST['t_name']) AND isset($_POST['t_fatherName']) AND isset($_POST['t_gender']) AND isset($_POST['t_qualification']) AND  isset($_POST['t_email']) AND  isset($_POST['t_phoneNumber']) AND  isset($_POST['t_salery']) AND isset($_FILES['image']) AND isset($_POST['t_bio']))
{

	//add new teacher
	if(!empty($_POST['t_name']) AND !empty($_POST['t_fatherName']) AND !empty($_POST['t_gender']) AND !empty($_POST['t_qualification']) AND  !empty($_POST['t_email']) AND  !empty($_POST['t_phoneNumber']) AND  !empty($_POST['t_salery']) AND !empty($_FILES['image']) AND isset($_POST['t_bio']))
	{

		$name=strtolower($_POST['t_name']);
		$father=strtolower($_POST['t_fatherName']);
		$gender=$_POST['t_gender'];
		$qualification=strtolower($_POST['t_qualification']);
		$email=strtolower($_POST['t_email']);
		$phoneNumber=$_POST['t_phoneNumber'];
		$salery=$_POST['t_salery'];
		$t_bio=strtolower($_POST['t_bio']);


		if(!preg_match('/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/', $phoneNumber)) 
    {
		  return MsgDisplay('error',' Phone number is invalid');
		}

		$run=$con->prepare('SELECT * FROM `teachers` WHERE (t_email=? OR t_phone_number=?) AND t_status=?');
		$run->bindParam(1,$email,PDO::PARAM_STR);
		$run->bindParam(2,$phoneNumber,PDO::PARAM_INT);
		$run->bindValue(3,'employee',PDO::PARAM_STR);

		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$data=$run->fetch(PDO::FETCH_ASSOC);

				if($data['t_phone_number']==$phoneNumber)
				{
					return MsgDisplay('error','Phone Number Already Use Try Anthor Phone Number');
				}
				else if($data['t_email']==$email)
				{
					return MsgDisplay('error','Email Address Already Use Try Anthor Email Address');
				}
			}
		}

    $allowed_ext=array('JPG','jpg','jpeg','GIF','PNG','png');;
    $exp=explode(".", $_FILES['image']['name']);
    $end=end($exp);
    $image_name=mt_rand(1111,9999).'_'.preg_replace('/\s+/', '', $_FILES['image']['name']);
    $path="../../img/teacher_img/$image_name";
    $temp=$_FILES['image']['tmp_name'];

    if(in_array($end,$allowed_ext))
		{

			if (move_uploaded_file($temp, $path)) 
		  {
		  	$run=$con->prepare('INSERT INTO `teachers`(`t_name`, `t_father`, `t_gender`, `t_qualification`, `t_email`, `t_phone_number`, `t_salery`, `t_image`,`t_bio`) VALUES (?,?,?,?,?,?,?,?,?)');

		  	$run->bindParam(1,$name,PDO::PARAM_STR);
		  	$run->bindParam(2,$father,PDO::PARAM_STR);
		  	$run->bindParam(3,$gender,PDO::PARAM_STR);
		  	$run->bindParam(4,$qualification,PDO::PARAM_STR);
		  	$run->bindParam(5,$email,PDO::PARAM_STR);
		  	$run->bindParam(6,$phoneNumber,PDO::PARAM_INT);
		  	$run->bindParam(7,$salery,PDO::PARAM_INT);
		  	$run->bindParam(8,$image_name,PDO::PARAM_STR);
		  	$run->bindParam(9,$t_bio,PDO::PARAM_STR);
		  	if($run->execute())
		  	{
		  		return MsgDisplay('success','Teacher Added Successfully.....!');
		  	}

		  }
		}
		else
	  {
	  	return MsgDisplay('error','Your Image Type is Invalid Only Allowed this Type <br>=> JPG,JPEG,GIF,PNG....!');
	  }
	}
}
else if(isset($_POST['viewTeacherProfile']) AND isset($_POST['teacherId']))
{
	if(!empty($_POST['viewTeacherProfile']) AND !empty($_POST['teacherId']))
	{
		$teacherId=$_POST['teacherId'];

		$run=$con->prepare('SELECT * FROM `teachers` WHERE t_id=? AND t_status=?');
		$run->bindParam(1,$teacherId,PDO::PARAM_INT);
		$run->bindValue(2,'employee',PDO::PARAM_STR);
		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$data=$run->fetch(PDO::FETCH_ASSOC);

					$image='../img/teacher_img/'.$data['t_image'];
				
				$html='<table class="table table-bordered table_style">
                <table class="table table-bordered table-responsive row">
                <tr>
                  <td class="col-md-4"><b>Name</b></td>
                  <td class="col-md-4">
                     '.ucwords(htmlspecialchars($data['t_name'])).'
                  </td>
                </tr>

                <tr>
                  <td class="col-md-4"><b>Father Name</b></td>
                  <td class="col-md-4">
                     '.ucwords(htmlspecialchars($data['t_father'])).'
                  </td>
                </tr>

                <tr>
                  <td class="col-md-4"><b>Gender</b></td>
                  <td class="col-md-4">
                     '.ucwords(htmlspecialchars($data['t_gender'])).'
                  </td>
                </tr>

                <tr>
                  <td class="col-md-4"><b>Qualification</b></td>
                  <td class="col-md-4">'.ucwords(htmlspecialchars($data['t_qualification'])).'</td>
                </tr>

                <tr>
                  <td class="col-md-4"><b>Email Address</b></td>
                  <td class="col-md-4">'.ucwords(htmlspecialchars($data['t_email'])).'</td>
                </tr>

                <tr>
                  <td class="col-md-4"><b>Phone Number</b></td>
                  <td class="col-md-4">'.htmlspecialchars($data['t_phone_number']).'</td>
                </tr>


                <tr>
                  <td class="col-md-4"><b>Monthly Salery</b></td>
                  <td class="col-md-4">'.htmlspecialchars($data['t_salery']).' PKR</td>
                </tr>

              </table><br>

               <b>Teacher Image</b><br>
               <center><img src="'.$image.'" class="img img-responsive img-thumbnail"></center><br>
               <b>Teacher Bio</b><br>
               <p>'.htmlspecialchars($data['t_bio']).'</p>
            </table>';


            return MsgDisplay('success',$html);
			}
			else
			{
				return MsgDisplay('error','Invalid Teacher Profile Vist.....!');
			}
		}
	}
}
else if(isset($_POST['getEditDataTeacher']) AND isset($_POST['teacherId']))
{
	$teacherId=$_POST['teacherId'];
	$run=$con->prepare('SELECT * FROM `teachers` WHERE t_id=? AND t_status=?');
	$run->bindParam(1,$teacherId,PDO::PARAM_INT);
	$run->bindValue(2,'employee',PDO::PARAM_STR);
	if($run->execute())
	{
		if($run->rowCount()>0)
		{
			$data=$run->fetch(PDO::FETCH_ASSOC);

			if($data['t_gender']=='male')
			{
				$gender='&nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" value="male" checked>
        &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio"  value="female" disabled><br><br>';
			}
			else if($data['t_gender']=='female')
			{
				$gender='&nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" name="t_gender" value="male" disabled>
        &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio" name="t_gender" value="female" checked><br><br>';
			}
			$html='
       <b>Name</b><br>
       <input type="text" value="'.htmlspecialchars(ucwords($data['t_name'])).'" placeholder="Enter Name.....!" class="form-control" disabled><br>

       <input type="number" name="teacherEditId" value="'.htmlspecialchars(ucwords($data['t_id'])).'" hidden>

       <b>Father</b><br>
       <input type="text" value="'.htmlspecialchars(ucwords($data['t_father'])).'" placeholder="Enter Father Name.....!" class="form-control" disabled><br>

        <label for="name">Gender</label><br>
        '.$gender.'

        <b>Qualification</b><br>
        <input type="text" name="t_qualification" value="'.htmlspecialchars(ucwords($data['t_qualification'])).'" placeholder="Enter Qualification.....!" class="form-control"><br>

        <b>Email Address</b><br>
        <input type="email" name="editTeacheremail" value="'.htmlspecialchars(ucwords($data['t_email'])).'" placeholder="Enter Email Address.....!" class="form-control"><br>

        <b>Phone Number</b><br>
        <input type="tel" name="t_phoneNumber" value="'.htmlspecialchars(ucwords($data['t_phone_number'])).'" placeholder="Enter Phone Number.....!" class="form-control"><br>

       <b>Salery</b><br>
       <input type="number" name="t_salery" value="'.htmlspecialchars(ucwords($data['t_salery'])).'" placeholder="Enter Salery.....!" class="form-control"><br>

       <b>Bio</b><br>
       <textarea rows="5" cols="3"  name="t_bio" placeholder="Enter About Teacher.....!" class="form-control" required>'.htmlspecialchars(ucwords($data['t_bio'])).'</textarea><br>

       <b>Change Image</b><br>
       <input type="file" name="image"  class="form-control"><br>
       <input type="submit" class="btn btn-success" name="editTeacher">';


      return MsgDisplay('success',$html);
		}
		else
		{
			return MsgDisplay('error','Invalid Teacher Profile Edite.....!');
		}
	}

}
else if(isset($_POST['teacherEditId']) AND isset($_POST['t_qualification']) AND isset($_POST['editTeacheremail']) AND isset($_POST['t_phoneNumber']) AND isset($_POST['t_salery'])  AND isset($_POST['t_bio']) AND isset($_FILES['image']))
{
	//update teacher
	if(!empty($_POST['teacherEditId']) AND !empty($_POST['t_qualification']) AND !empty($_POST['editTeacheremail']) AND !empty($_POST['t_phoneNumber']) AND !empty($_POST['t_salery'])  AND !empty($_POST['t_bio']))
	{

		$teacher_id=$_POST['teacherEditId'];
		$email=strtolower($_POST['editTeacheremail']);
		$qualification=strtolower($_POST['t_qualification']);
		$phoneNumber=$_POST['t_phoneNumber'];
		$salery=$_POST['t_salery'];
		$bio=strtolower($_POST['t_bio']);

		if(!preg_match('/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/', $phoneNumber)) 
    {
		  return MsgDisplay('error',' Phone number is invalid....!');
		}

		$run=$con->prepare('SELECT * FROM `teachers` WHERE (t_email=? OR t_phone_number=?) AND t_status=? AND t_id!=?');
		$run->bindParam(1,$email,PDO::PARAM_STR);
		$run->bindParam(2,$phoneNumber,PDO::PARAM_INT);
		$run->bindValue(3,'employee',PDO::PARAM_STR);
		$run->bindValue(4,$teacher_id,PDO::PARAM_INT);

		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$data=$run->fetch(PDO::FETCH_ASSOC);

				if($data['t_phone_number']==$phoneNumber)
				{
					return MsgDisplay('error','Phone Number Already Use Try Anthor Phone Number');
				}
				else if($data['t_email']==$email)
				{
					return MsgDisplay('error','Email Address Already Use Try Anthor Email Address');
				}
			}
		}

		if(!empty($_FILES['image']['name']))
		{
			$allowed_ext=array('JPG','jpg','jpeg','GIF','PNG','png');;
	    $exp=explode(".", $_FILES['image']['name']);
	    $end=end($exp);
	    $image_name=mt_rand(1111,9999).'_'.preg_replace('/\s+/', '', $_FILES['image']['name']);
	    $path="../../img/teacher_img/$image_name";
	    $temp=$_FILES['image']['tmp_name'];
	    if(in_array($end,$allowed_ext))
			{

				if(move_uploaded_file($temp, $path))
				{
					$run=$con->prepare('UPDATE `teachers` SET `t_qualification`=?,`t_email`=?,`t_phone_number`=?,`t_salery`=?,`t_image`=?,`t_bio`=? WHERE t_id=?');

					$run->bindParam(1,$qualification,PDO::PARAM_STR);
					$run->bindParam(2,$email,PDO::PARAM_STR);
					$run->bindParam(3,$phoneNumber,PDO::PARAM_INT);
					$run->bindParam(4,$salery,PDO::PARAM_INT);
					$run->bindParam(5,$image_name,PDO::PARAM_STR);
					$run->bindParam(6,$bio,PDO::PARAM_STR);
					$run->bindParam(7,$teacher_id,PDO::PARAM_INT);
				}
			}
			else
			{
				return MsgDisplay('error','Your Image Type is Invalid Only Allowed this Type <br>=> JPG,JPEG,GIF,PNG....!');
			}
		}
		else
		{
			$run=$con->prepare('UPDATE `teachers` SET `t_qualification`=?,`t_email`=?,`t_phone_number`=?,`t_salery`=?,`t_bio`=? WHERE t_id=?');

			$run->bindParam(1,$qualification,PDO::PARAM_STR);
			$run->bindParam(2,$email,PDO::PARAM_STR);
			$run->bindParam(3,$phoneNumber,PDO::PARAM_INT);
			$run->bindParam(4,$salery,PDO::PARAM_INT);
			$run->bindParam(5,$bio,PDO::PARAM_STR);
			$run->bindParam(6,$teacher_id,PDO::PARAM_INT);
		}

		if($run->execute())
		{
			return MsgDisplay('success','Teacher Profile Updated Successfully....!');
		}
	}
	else
	{
		return MsgDisplay('error','All Field Are Mandatory.......!');
	}
}
else if(isset($_POST['deleteTeacher']) AND isset($_POST['teacher_id']))
{
	// delete teacher
	$teacher_id=$_POST['teacher_id'];

	$run=$con->prepare('SELECT * FROM `teachers` WHERE t_status=? AND t_id=?');
	
	$run->bindValue(1,'employee',PDO::PARAM_STR);
	$run->bindParam(2,$teacher_id,PDO::PARAM_INT);

	if($run->execute())
	{
		if($run->rowCount()>0)
		{
			$run=$con->prepare('UPDATE `teachers` SET `t_status`=? WHERE t_id=?');
			$run->bindValue(1,'delete',PDO::PARAM_STR);
			$run->bindParam(2,$teacher_id,PDO::PARAM_STR);
			if($run->execute())
			{
				return MsgDisplay('success','Teacher Profile Deleted Successfully.....!');
			}
		}
		else
		{
			return MsgDisplay('error','Invalid Teacher Profile Delete.....!');
		}
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['getProgramCourses']) AND isset($_POST['programID']))
{
	// shift program course get
	$programID=$_POST['programID'];
	if(is_numeric($programID))
	{
		$run=$con->prepare("SELECT * FROM courses WHERE p_id=? AND c_status NOT IN(?,?)");
		$run->bindParam(1,$programID,PDO::PARAM_INT);
		$run->bindValue(2,'p_delete',PDO::PARAM_STR);
		$run->bindValue(3,'c_delete',PDO::PARAM_STR);
	  if($run->execute())
    {
      if($run->rowCount()>0)
      {
      	$html=[];
      	$allCourses=$run->fetchALL(PDO::FETCH_ASSOC);

      	$html[].="<option value=''>Select Course</option>";
      	foreach ($allCourses as $key => $value) 
      	{
      		$html[].='<option value="'.$value['id'].'"">'.ucwords(htmlspecialchars($value['c_name'])).'</option>';
      	}

      	$val=implode(" ",$html);
	      return MsgDisplay('success',$val,'');
      }
      else
      {
      	return MsgDisplay('error','Invalid Course Select.....!');
      }
    }
	}
	else
	{
		return MsgDisplay('error','Invalid Course Select.....!');
	}
}
else if(isset($_POST['startTime']) AND isset($_POST['endTime']) AND isset($_POST['p_id']) AND isset($_POST['c_id']) AND isset($_POST['t_id'])) 
{
	// add new shift
	if(!empty($_POST['startTime']) AND !empty($_POST['endTime']) AND !empty($_POST['p_id']) AND !empty($_POST['c_id']) AND !empty($_POST['t_id'])) 
	{
		if(is_numeric($_POST['p_id']) AND is_numeric($_POST['c_id']) AND is_numeric($_POST['t_id'])) 
		{
			$p_id=$_POST['p_id'];
			$c_id=$_POST['c_id'];
			$t_id=$_POST['t_id'];

			$run=$con->prepare("SELECT * FROM program WHERE id=? AND status!=?");
			$run->bindParam(1,$p_id,PDO::PARAM_INT);
			$run->bindValue(2,'delete',PDO::PARAM_STR);
	    if($run->execute())
	    {
	      if($run->rowCount()>0)
	      {
	      	$run=$con->prepare('SELECT * FROM `courses` WHERE id=? AND p_id=? AND c_status NOT IN(?,?)');
					$run->bindParam(1,$c_id,PDO::PARAM_INT);
					$run->bindParam(2,$p_id,PDO::PARAM_INT);
					$run->bindValue(3,'p_delete',PDO::PARAM_STR);
					$run->bindValue(4,'c_delete',PDO::PARAM_STR);

					if($run->execute())
					{
						if($run->rowCount()>0)
						{

							$start_time = $_POST['startTime'];
							$time_obj = new DateTime($start_time);
							$hour = $time_obj->format('H');
							if ($hour < 12) 
							{
								$shift='Morning';
							} 
							else 
							{
								$shift='Evening';
							}

							$startTime_obj = new DateTime($_POST['startTime']);
							$startTime = $startTime_obj->format('h:i A');
							$endTime_obj = new DateTime($_POST['endTime']);
							$endTime = $endTime_obj->format('h:i A');
              
							$run=$con->prepare('SELECT * FROM `course_allocation` WHERE t_id=?');
							$run->bindParam(1,$t_id,PDO::PARAM_INT);
							if($run->execute())
							{
								if($run->rowCount()>0)
								{
									$teacherTiming=$run->fetchALL(PDO::FETCH_ASSOC);		

									foreach ($teacherTiming as $key => $timingData) 
									{
											$dbStartTime = $timingData['start_time'];
											$dbEndTime = $timingData['end_time'];
									    if (($startTime >= $dbStartTime && $startTime < $dbEndTime) || ($endTime > $dbStartTime && $endTime <= $dbEndTime) || ($startTime <= $dbStartTime && $endTime >= $dbEndTime)) 
									    {
									        return MsgDisplay('error','The selected start and end times overlap with an existing class timing');
									    }
									}
								}
							}

							$run=$con->prepare('INSERT INTO `course_allocation`(`p_id`, `c_id`, `t_id`, `start_time`, `end_time`, `ct_shift`) VALUES (?,?,?,?,?,?)');
							$run->bindParam(1,$p_id,PDO::PARAM_INT);
							$run->bindParam(2,$c_id,PDO::PARAM_INT);
							$run->bindParam(3,$t_id,PDO::PARAM_INT);
							$run->bindParam(4,$startTime,PDO::PARAM_STR);
							$run->bindParam(5,$endTime,PDO::PARAM_STR);
							$run->bindParam(6,$shift,PDO::PARAM_STR);

							if($run->execute())
							{
								return MsgDisplay('success','New Shift Added Successfully.....!');
							}
						}
					}
	      }
	    }
		}
	}
	else
	{
		return MsgDisplay('error','All Field Are Mandatory.....!');
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
}
else if((isset($_POST['updateStartTime']) AND isset($_POST['updateEndTime']) OR isset($_POST['updateTeacherId']) ) AND isset($_POST['course_allocationID']) AND isset($_POST['programID']) AND isset($_POST['courseID']) AND isset($_POST['teacherID'])) 
{
	 // edit shift class time
   $NewStart=$_POST['updateStartTime'];
 	 $NewEnd=$_POST['updateEndTime'];
 	 $NewTeacherId=$_POST['updateTeacherId'];

 	 $programID=$_POST['programID'];
 	 $courseID=$_POST['courseID'];
 	 $teacherID=$_POST['teacherID'];
 	 $course_allocationID=$_POST['course_allocationID'];


	if(!empty($course_allocationID) AND !empty($programID) AND !empty($courseID) AND !empty($teacherID)) 
  {
  	if(is_numeric($course_allocationID) AND is_numeric($programID) AND is_numeric($courseID) AND is_numeric($teacherID)) 
    {
   	 if(!empty($NewStart) AND empty($NewEnd))
   	 {
   	 	return MsgDisplay('error','Please choose class end time.....!');
   	 }
     else if(empty($NewStart) AND !empty($NewEnd))
   	 {
   	 	return MsgDisplay('error','Please choose class start time.....!');
   	 }
   	 else
   	 {
   	 	 if(!empty($NewTeacherId) OR !empty($NewStart) AND !empty($NewEnd))
   	 	 {
   	 	 	  if(!empty($NewStart) AND !empty($NewEnd))
   	 	 	  {
   	 	 	  	$start_time = $NewStart;
						$time_obj = new DateTime($start_time);
						$hour = $time_obj->format('H');
						if ($hour < 12) 
						{
							$shift='Morning';
						} 
						else 
						{
							$shift='Evening';
						}

						$startTime_obj = new DateTime($NewStart);
						$startTime = $startTime_obj->format('h:i A');
						$endTime_obj = new DateTime($NewEnd);
						$endTime = $endTime_obj->format('h:i A');
              
						$run=$con->prepare('SELECT * FROM `course_allocation` WHERE t_id=?');
						$run->bindParam(1,$NewTeacherId,PDO::PARAM_INT);
						if($run->execute())
						{
							if($run->rowCount()>0)
							{
								$teacherTiming=$run->fetchALL(PDO::FETCH_ASSOC);		

								foreach ($teacherTiming as $key => $timingData) 
								{
										$dbStartTime = $timingData['start_time'];
										$dbEndTime = $timingData['end_time'];
								    if (($startTime >= $dbStartTime && $startTime < $dbEndTime) || ($endTime > $dbStartTime && $endTime <= $dbEndTime) || ($startTime <= $dbStartTime && $endTime >= $dbEndTime)) 
								    {
								        return MsgDisplay('error','The selected start and end times overlap with an existing class timing');
								    }
								}
							}
						}
   	 	 	  }

   	 	 	  if(!empty($NewStart) AND !empty($NewEnd) AND empty($NewTeacherId))
   	 	 	  {
							$run=$con->prepare('UPDATE `course_allocation` SET `start_time`=?,`end_time`=?,`ct_shift`=? WHERE ca_id=? AND p_id=? AND c_id=? AND t_id=?');
							$run->bindParam(1,$startTime,PDO::PARAM_STR);
							$run->bindParam(2,$endTime,PDO::PARAM_STR);
							$run->bindParam(3,$shift,PDO::PARAM_STR);
							$run->bindParam(4,$course_allocationID,PDO::PARAM_INT);
							$run->bindParam(5,$programID,PDO::PARAM_INT);
							$run->bindParam(6,$courseID,PDO::PARAM_INT);
							$run->bindParam(7,$teacherID,PDO::PARAM_INT);
   	 	 	  }
   	 	 	  elseif(empty($NewStart) AND empty($NewEnd) AND !empty($NewTeacherId))
   	 	 	  {
							$run=$con->prepare('UPDATE `course_allocation` SET `t_id`=? WHERE ca_id=? AND p_id=? AND c_id=? AND t_id=?');
							$run->bindParam(1,$NewTeacherId,PDO::PARAM_INT);
							$run->bindParam(2,$course_allocationID,PDO::PARAM_INT);
							$run->bindParam(3,$programID,PDO::PARAM_INT);
							$run->bindParam(4,$courseID,PDO::PARAM_INT);
							$run->bindParam(5,$teacherID,PDO::PARAM_INT);
   	 	 	  }
   	 	 	  else if(!empty($NewStart) AND !empty($NewEnd) AND !empty($NewTeacherId))
   	 	 	  {
							$run=$con->prepare('UPDATE `course_allocation` SET `start_time`=?,`end_time`=?,`ct_shift`=?,`t_id`=? WHERE ca_id=? AND p_id=? AND c_id=? AND t_id=?');
							$run->bindParam(1,$startTime,PDO::PARAM_STR);
							$run->bindParam(2,$endTime,PDO::PARAM_STR);
							$run->bindParam(3,$shift,PDO::PARAM_STR);
							$run->bindParam(4,$NewTeacherId,PDO::PARAM_INT);
							$run->bindParam(5,$course_allocationID,PDO::PARAM_INT);
							$run->bindParam(6,$programID,PDO::PARAM_INT);
							$run->bindParam(7,$courseID,PDO::PARAM_INT);
							$run->bindParam(8,$teacherID,PDO::PARAM_INT);
   	 	 	  }

   	 	 	  if($run->execute())
   	 	 	  {
   	 	 	  	return MsgDisplay('success','Shift Updated Successfully......!');
   	 	 	  }
   	 	 }
   	 	 else
   	 	 {
   	 	 	return MsgDisplay('error','At least one field update is mandatory, whether its a time update or a teacher change......!');
   	 	 }
   	 }
    }
	}
}
else if(isset($_POST['deleteShift']) AND isset($_POST['course_allocationID']) AND isset($_POST['programID']) AND isset($_POST['courseID']) AND isset($_POST['teacherID'])) 
{
	 // delete shift class
	 $programID=$_POST['programID'];
 	 $courseID=$_POST['courseID'];
 	 $teacherID=$_POST['teacherID'];
 	 $course_allocationID=$_POST['course_allocationID'];

	if(!empty($course_allocationID) AND !empty($programID) AND !empty($courseID) AND !empty($teacherID)) 
	{
		if(is_numeric($course_allocationID) AND is_numeric($programID) AND is_numeric($courseID) AND is_numeric($teacherID)) 
		{
			$run=$con->prepare('SELECT * FROM `course_allocation` WHERE ca_id=? AND p_id=? AND c_id=? AND t_id=?');
			$run->bindParam(1,$course_allocationID,PDO::PARAM_INT);
			$run->bindParam(2,$programID,PDO::PARAM_INT);
			$run->bindParam(3,$courseID,PDO::PARAM_INT);
			$run->bindParam(4,$teacherID,PDO::PARAM_INT);
			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$teacherTiming=$run->fetchALL(PDO::FETCH_ASSOC);

					$run=$con->prepare('DELETE FROM `course_allocation` WHERE ca_id=? AND p_id=? AND c_id=? AND t_id=?');
					$run->bindParam(1,$course_allocationID,PDO::PARAM_INT);
					$run->bindParam(2,$programID,PDO::PARAM_INT);
					$run->bindParam(3,$courseID,PDO::PARAM_INT);
					$run->bindParam(4,$teacherID,PDO::PARAM_INT);

					if($run->execute())
					{
						return MsgDisplay('success','Class Shift Deleted Successfully......!');
					}
				}
				else
				{
					return MsgDisplay('error','Invalid Teacher Shift Delete......!');
				}
			}
		}
	}
}
else if(isset($_POST['editPendingUser']) AND isset($_POST['userID']))
{
	$userID=$_POST['userID'];

	if(is_numeric($userID))
	{
		$run=$con->prepare('SELECT u.id as userID, u.*, p.*, c.* FROM student u JOIN `program` p ON p.`id` = u.`p_id` JOIN `courses` c ON u.`c_id` = c.`id` WHERE u.`u_status` = ? AND  u.`id` = ? GROUP BY u.id ORDER BY u.`id` DESC');

		$run->bindValue(1,'pending',PDO::PARAM_STR);
		$run->bindValue(2,$userID,PDO::PARAM_STR);
    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $data=$run->fetch(PDO::FETCH_ASSOC);

     
        if($data['gender']=='male')
        {
        	$gender=' &nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" name="gender" value="male" checked>
	              &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio" name="gender" value="female">';
        }
        else
        {
        	$gender=' &nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" name="gender" value="male">
	              &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio" name="gender" value="female" checked>';
        }


        if($data['shifts']=='Morning')
        {
        	$shift='&nbsp;&nbsp;<span style="font-size:18px">Morning</span> <input type="radio" name="shift" value="Morning" checked>
	              &nbsp;&nbsp;<span style="font-size:18px">Evening</span> <input type="radio" name="shift" value="Evening">';
        }
        else
        {
        	$shift='&nbsp;&nbsp;<span style="font-size:18px">Morning</span> <input type="radio" name="shift" value="Morning">
	              &nbsp;&nbsp;<span style="font-size:18px">Evening</span> <input type="radio" name="shift" value="Evening" checked>';
        }

        $html='

         <input type="text" name="pendingUserEdit" value="pendingUserEdit" hidden required>
         <input type="number" name="useID" value="'.$data['userID'].'" hidden required>
         <input type="number" name="p_id" value="'.$data['p_id'].'" hidden required>
         <input type="number" name="c_id" value="'.$data['c_id'].'" hidden required>

	        <div class="form-group">
	          <label for="name">Full Name</label>
	          <input type="text" name="name" value="'.$data['name'].'" class="form-control" placeholder="Enter Name.....!" required>
	        </div>

	        <div class="form-group">
	          <label for="name">Father Name</label>
	          <input type="text" name="fatherName" value="'.$data['father_name'].'"  class="form-control" placeholder="Enter Father Name.....!" required>
	        </div>

	        <div class="form-group">
	          <label for="email">DOB</label>
	          <input type="date" value="'.$data['dob'].'"  name="dob" class="form-control" required>
	        </div>

	        <div class="form-group">
	          <label for="name">Gender</label><br>
	           '.$gender.'
	        </div>


	         <div class="form-group">
	          <label for="address">Current Address</label>
	          <input type="text" name="current_address" value="'.$data['address'].'" class="form-control" placeholder="Enter Current Address....!" required>
	        </div>

	        <div class="form-group">
	          <label for="address">Email Address</label>
	          <input type="email" name="email_address" value="'.$data['email_address'].'" class="form-control" placeholder="Enter Email Address....!" required>
	        </div>

	       
	         <div class="form-group">
	          <label for="address">Phone Number</label>
	          <input type="text" name="phone_number" value="'.$data['phone_number'].'" class="form-control" placeholder="Enter Phone Number....!" required>
	        </div>

	        <div class="form-group">
	          <label for="Shifts">Shifts</label><br>
	            '.$shift.'
	        </div>

	        <div class="form-group">
	          <input type="submit" class="btn btn-primary" value="Enroll Now">
	        </div>';

	        return MsgDisplay('success',$html);
      }
      else
      {
      	return MsgDisplay('error','Invalid User Edit......!');
      }
    }
	}
	else
	{
		return MsgDisplay('error','Invalid User Edit......!');
	}
}
else if(isset($_POST['pendingUserEdit']) AND isset($_POST['name']) AND isset($_POST['fatherName']) AND isset($_POST['dob']) AND isset($_POST['gender']) AND isset($_POST['current_address']) AND isset($_POST['email_address']) AND isset($_POST['phone_number']) AND isset($_POST['shift']) AND isset($_POST['useID']) AND isset($_POST['p_id']) AND isset($_POST['c_id']))
{
	$userId=$_POST['useID'];
	$p_id=$_POST['p_id'];
	$c_id=$_POST['c_id'];
	$userName=strtolower($_POST['name']);
	$fatherName=strtolower($_POST['fatherName']);
	$dob=$_POST['dob'];
	$gender=strtolower($_POST['gender']);
	$current_address=strtolower($_POST['current_address']);
	$email_address=strtolower($_POST['email_address']);
	$phone_number=strtolower($_POST['phone_number']);
	$shift=$_POST['shift'];


	if(!empty($userName) AND !empty($fatherName) AND !empty($dob) AND !empty($gender) AND !empty($current_address) AND !empty($email_address) AND !empty($phone_number) AND !empty($shift) AND !empty($userId) AND !empty($p_id) AND !empty($c_id))
	{
		if(is_numeric($_POST['useID']) AND is_numeric($_POST['p_id']) AND is_numeric($_POST['c_id']))
		{ 
			$run=$con->prepare('SELECT * FROM student WHERE id=? AND p_id=? AND c_id=? AND roll_no IS NULL');
			$run->bindParam(1,$userId,PDO::PARAM_INT);
			$run->bindParam(2,$p_id,PDO::PARAM_INT);
			$run->bindParam(3,$c_id,PDO::PARAM_INT);

			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$data=$run->fetch(pdo::FETCH_ASSOC);
					
					$run=$con->prepare('UPDATE student SET `name`=?,`father_name`=?,`dob`=?,`gender`=?,`email_address`=?,`address`=?,`phone_number`=?,`updated_shift`=? WHERE id=? AND `p_id`=? AND `c_id`=?');

					$run->bindParam(1,$userName,PDO::PARAM_STR);
					$run->bindParam(2,$fatherName,PDO::PARAM_STR);
					$run->bindParam(3,$dob,PDO::PARAM_STR);
					$run->bindParam(4,$gender,PDO::PARAM_STR);
					$run->bindParam(5,$email_address,PDO::PARAM_STR);
					$run->bindParam(6,$current_address,PDO::PARAM_STR);
					$run->bindParam(7,$phone_number,PDO::PARAM_STR);
					$run->bindParam(8,$shift,PDO::PARAM_STR);
					$run->bindParam(9,$userId,PDO::PARAM_INT);
					$run->bindParam(10,$p_id,PDO::PARAM_INT);
					$run->bindParam(11,$c_id,PDO::PARAM_INT);

					if($run->execute())
					{
						return MsgDisplay('success','User Updated Successfully......!');
					}
				}
			}
		}
		else
		{
			return MsgDisplay('error','Invalid User Edit......!');
		}
	}
	else
	{

		return MsgDisplay('error','Invalid User Edit......!');
	}

	return MsgDisplay('error','Something Invalid Was Wrong Please Try Again ......!');
}
else if(isset($_POST['pendingStudentCheck']) AND isset($_POST['userId']) AND isset($_POST['programID']) AND isset($_POST['courseID']))
{
	//check data pending student
	$userId=$_POST['userId'];
  $p_id=$_POST['programID'];
  $c_id=$_POST['courseID'];

  $run=$con->prepare('SELECT * FROM student WHERE id=? AND p_id=? AND c_id=? AND roll_no IS NULL');
	$run->bindParam(1,$userId,PDO::PARAM_INT);
	$run->bindParam(2,$p_id,PDO::PARAM_INT);
	$run->bindParam(3,$c_id,PDO::PARAM_INT);

	if($run->execute())
	{
		if($run->rowCount()>0)
		{
			$data=$run->fetch(PDO::FETCH_ASSOC);
			$email=$data['email_address'];
			$name=$data['name'];
			$fatherName=$data['father_name'];

			$run=$con->prepare('SELECT u.id as userID, u.*, p.*, c.*
							FROM student u
							JOIN `program` p ON p.`id` = u.`p_id`
							JOIN `courses` c ON u.`c_id` = c.`id`
							WHERE email_address=? AND name=? AND father_name=? AND roll_no IS NOT NULL
							GROUP BY c.id
							ORDER BY u.`id` DESC;');

			$run->bindParam(1,$email,PDO::PARAM_STR);
			$run->bindParam(2,$name,PDO::PARAM_STR);
			$run->bindParam(3,$fatherName,PDO::PARAM_STR);

			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$html=[];
					$allData=$run->fetchAll(PDO::FETCH_ASSOC);
					//check($allData);
					$html[].='<div class="userData" style="margin-left: 20px;">
                <center>Based on the data we have, it appears that you may have already enrolled in this academy course before, as the information we have matches that of existing courses, including your email, name, and fathers name. If this is the case, we will assign you the same roll number that you were given in your previous course</center><br>

                <div class="text-center">
                <button type="button" class="btn btn-success btn-sm" onclick="yesStudentAccept(this)">Yes, Assign</button>
               <button type="close" class="btn btn-danger btn-sm" onclick="assignRollNo(this)">New, Assign</button>
               </div><br>


                <table class="table table-bordered table-responsive bg-primary row">
                 <tbody>
                  <tr>
                    <td class="col-md-4"><b>Roll No</b></td>
                    <td class="col-md-4">
                      '.$allData[0]['roll_no'].'
                    </td>
                  </tr>

                  <tr>
                    <td class="col-md-4"><b>Name</b></td>
                    <td class="col-md-4">
                      '.ucwords(htmlspecialchars($allData[0]['name'])).'
                    </td>
                  </tr>

                  <tr>
                    <td class="col-md-4"><b>Father Name</b></td>
                    <td class="col-md-4">
                      '.ucwords(htmlspecialchars($allData[0]['father_name'])).'
                    </td>
                  </tr>

                  <tr>
                    <td class="col-md-4"><b>Email Address</b></td>
                    <td class="col-md-4">
                        '.ucwords(htmlspecialchars($allData[0]['email_address'])).'
                    </td>
                  </tr>
              </tbody></table>';

             $i=1;
            foreach ($allData as $key => $value) 
            {
            	if($run->rowCount()>1)
            	{
            		$no=' <h3>Course No '.$i.'</h3>';
            	}
            	else
            	{
            		$no='';
            	}

            	$html[].='
              <table class="table table-bordered table-responsive bg-primary row">
                '.$no.'
                 <tbody>
                  <tr>
                    <td class="col-md-4"><b>Program Name</b></td>
                    <td class="col-md-4">
                       '.ucwords(htmlspecialchars($value['program'])).'
                    </td>
                  </tr>

                   <tr>
                    <td class="col-md-4"><b>Course Name</b></td>
                    <td class="col-md-4">
                       '.ucwords(htmlspecialchars($value['c_name'])).'
                    </td>
                  </tr>

                  <tr>
                    <td class="col-md-4"><b>Duration</b></td>
                    <td class="col-md-4">'.ucwords(htmlspecialchars($value['c_duration'])).'</td>
                  </tr>
          

                  <tr>
                    <td class="col-md-4"><b>Fee</b></td>
                    <td class="col-md-4">
                      '.ucwords(htmlspecialchars($value['u_fee'])).'
                    </td>
                  </tr>
              </tbody>
             </table>';
             $i++;
            }
           $html[].='</div>';

           $val=implode(" ",$html);
	        return MsgDisplay('success',$val,'');
				}
				else
				{
					 return rollNo($userId,$p_id,$c_id);
				}
			}
		}
	}

}
else if(isset($_POST['pendingStudentAccept']) AND isset($_POST['userId']) AND isset($_POST['programID']) AND isset($_POST['courseID']))
{
	// accept enrollment student by old roll no
	if(is_numeric($_POST['userId']) AND is_numeric($_POST['programID']) AND is_numeric($_POST['courseID']))
  {
  	$userId=$_POST['userId'];
  	$p_id=$_POST['programID'];
  	$c_id=$_POST['courseID'];

  	$run=$con->prepare('SELECT * FROM student WHERE id=? AND p_id=? AND c_id=? AND roll_no IS NULL');
		$run->bindParam(1,$userId,PDO::PARAM_INT);
		$run->bindParam(2,$p_id,PDO::PARAM_INT);
		$run->bindParam(3,$c_id,PDO::PARAM_INT);

		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$data=$run->fetch(PDO::FETCH_ASSOC);
				$email=$data['email_address'];
			  $name=$data['name'];
			  $fatherName=$data['father_name'];


				$run=$con->prepare('SELECT * FROM student WHERE email_address=? AND name=? AND father_name=? AND roll_no IS NOT NULL');

			  $run->bindParam(1,$email,PDO::PARAM_STR);
			  $run->bindParam(2,$name,PDO::PARAM_STR);
			  $run->bindParam(3,$fatherName,PDO::PARAM_STR);

				if($run->execute())
				{
					if($run->rowCount()>0)
					{
						$validData=$run->fetch(PDO::FETCH_ASSOC);
						$run=$con->prepare('UPDATE student SET `roll_no`=?,`u_status`=? WHERE id=? AND p_id=? AND c_id=?');

						$run->bindParam(1,$validData['roll_no'],PDO::PARAM_INT);
						$run->bindValue(2,'enroll',PDO::PARAM_STR);
						$run->bindParam(3,$userId,PDO::PARAM_INT);
						$run->bindParam(4,$p_id,PDO::PARAM_INT);
						$run->bindParam(5,$c_id,PDO::PARAM_INT);

						if($run->execute())
						{
							return MsgDisplay('success','Enrollment successful. Your previous roll number has been assigned.<br><b>Roll No :- </b>'.$validData['roll_no']);
						}
					}
				}
			}
		}

  }

  return MsgDisplay('error','Something Was Wrong Please Try Again');
}
else if(isset($_POST['assignRollNo']) AND isset($_POST['userId'])  AND isset($_POST['programID']) AND isset($_POST['courseID']) ) 
{
	// accept enrollment student by new roll no
	if(!empty($_POST['userId'])  AND !empty($_POST['programID']) AND !empty($_POST['courseID'])) 
	{
		if(is_numeric($_POST['userId'])  AND is_numeric($_POST['programID']) AND is_numeric($_POST['courseID']) ) 
	  {
	  	return rollNo($_POST['userId'],$_POST['programID'],$_POST['courseID']);
	  }
	  else
	  {
	  	return MsgDisplay('error','Invalid User Enrollment.....!');
	  }
	}
	

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');

}
else if(isset($_POST['pendingStudentReject']) AND isset($_POST['userId']) AND isset($_POST['programID']) AND isset($_POST['courseID']))
{
	//reject pending student


	if(is_numeric($_POST['userId']) AND is_numeric($_POST['programID']) AND is_numeric($_POST['courseID']))
	{
		$run=$con->prepare('SELECT * FROM student WHERE id=? AND p_id=? AND c_id=? AND roll_no IS NULL');
	  $run->bindParam(1,$_POST['userId'],PDO::PARAM_INT);
	  $run->bindParam(2,$_POST['programID'],PDO::PARAM_INT);
	  $run->bindParam(3,$_POST['courseID'],PDO::PARAM_INT);

	  if($run->execute())
	  {
	  	if($run->rowCount()>0)
	  	{
	  		$run=$con->prepare('DELETE FROM student WHERE id=? AND p_id=? AND c_id=? AND roll_no IS NULL');
			  $run->bindParam(1,$_POST['userId'],PDO::PARAM_INT);
			  $run->bindParam(2,$_POST['programID'],PDO::PARAM_INT);
			  $run->bindParam(3,$_POST['courseID'],PDO::PARAM_INT);

			  if($run->execute())
			  {
			  	return MsgDisplay('success','User Enrollment Successfully Reject.....!');
			  }
	  	}
	  	else
	  	{
	  		return MsgDisplay('error','Invalid User Enrollment.....!');
	  	}
	  }
	}
	else
	{
		return MsgDisplay('error','Invalid User Enrollment.....!');
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');

}
else if(isset($_POST['newFees']) AND isset($_POST['programId']) AND isset($_POST['courseId']))
{
	if(is_numeric($_POST['newFees']) AND is_numeric($_POST['programId']) AND is_numeric($_POST['courseId']))
	{
		$run=$con->prepare("SELECT * FROM `courses` WHERE `courses`.`c_status` NOT IN(?,?) AND p_id=? AND id=?");

		$run->bindValue(1,'p_delete',PDO::PARAM_STR);
		$run->bindValue(2,'c_delete',PDO::PARAM_STR);
		$run->bindParam(3,$_POST['programId'],PDO::PARAM_INT);
		$run->bindParam(4,$_POST['courseId'],PDO::PARAM_INT);
    if($run->execute())
    {
      if($run->rowCount()>0)
      {
      	$run=$con->prepare('UPDATE `courses` SET `c_fee`=? WHERE p_id=? AND id=?');
		    $run->bindParam(1,$_POST['newFees'],PDO::PARAM_INT);
		    $run->bindParam(2,$_POST['programId'],PDO::PARAM_INT);
		    $run->bindParam(3,$_POST['courseId'],PDO::PARAM_INT);

		    if($run->execute())
		    {
		    	return MsgDisplay('success','Course Fees Change Successfully.....!');
		    }
      }
      else
      {
      	return MsgDisplay('error','Invalid Course Fees Change.....!');
      }
    }
	}
	else
  {
  	return MsgDisplay('error','Invalid Course Fees Change.....!');
  }

  return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['viewStudentProfile']) AND isset($_POST['userId']))
{
	if(!empty($_POST['userId']) AND is_numeric($_POST['userId']))
	{
		$userID=$_POST['userId'];

		$run=$con->prepare('SELECT student.*,`courses`.*,`program`.*,student.updated_at as enrollDate FROM student 
			JOIN `courses` ON `courses`.`id`=student.`c_id`  
			JOIN `program` ON `program`.`id`=student.`p_id` WHERE student.id=?
			ORDER BY `courses`.id DESC');

		$run->bindParam(1,$userID,PDO::PARAM_INT);

		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$userData=$run->fetch(pdo::FETCH_ASSOC);

				if($userData['status']=='private')
				{
					$programStatus='<span class="badge" data-toggle="tooltip" data-placement="top" title="" style="background:#3067EF; float:right" data-original-title="Program is private, the courses associated with the program will also be private">Private</span>';
				}
				else if($userData['status']=='publish')
				{
					$programStatus='<span class="badge" style="background:#6fd96f; float:right">Publish</span>';
				}
				else if($userData['status']=='delete')
				{
					$programStatus='<span class="badge" style="background:#e12b31; float:right">Delete</span>';
				}


				if($userData['c_status']=='publish')
        {
            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#6fd96f; float:right" title="Course is public. it will be visible on the website">Publish</span>';
        }
        else  if($userData['c_status']=='c_private')
        {
            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#3067EF; float:right" title="Course is Private. it will not be visible to visitors">Course Private</span>';
        }
        else if($userData['c_status']=='p_private')
        {
            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" style="background:#B4DF14; float:right" title="Program is private, the courses associated with the program will also be private">Program Private</span>';
        }
        else if($userData['c_status']=='c_delete')
        {
            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#c71c22; float:right" title="Course is Private. it will not be visible to visitors">Course Delete</span>';
        }

				
				if($userData['roll_no']!='')
				{
					$roll_no='<tr>
            <td class="col-md-4"><b>Roll No</b></td>
            <td class="col-md-4">
              '.ucwords(htmlspecialchars($userData['roll_no'])).'
            </td>
          </tr>';
				}
				else
				{
					$roll_no='';
				}


				$html='<table class="table table-bordered table-responsive row">
			           	'.$roll_no.'
          <tr>
            <td class="col-md-4"><b>Name</b></td>
            <td class="col-md-4">
              '.ucwords(htmlspecialchars($userData['name'])).'
            </td>
          </tr>

           <tr>
            <td class="col-md-4"><b>Father Name</b></td>
            <td class="col-md-4">
               '.ucwords(htmlspecialchars($userData['father_name'])).'
            </td>
          </tr>

          <tr>
            <td class="col-md-4"><b>DOB</b></td>
            <td class="col-md-4">'.ucwords(htmlspecialchars($userData['dob'])).'</td>
          </tr>
  

          <tr>
            <td class="col-md-4"><b>Gender</b></td>
            <td class="col-md-4">
               '.ucwords(htmlspecialchars($userData['gender'])).'
            </td>
          </tr>

          <tr>
            <td class="col-md-4"><b>Current Address</b></td>
            <td class="col-md-4">
              '.ucwords(htmlspecialchars($userData['address'])).'
            </td>
          </tr>

           <tr>
            <td class="col-md-4"><b>Email Address</b></td>
            <td class="col-md-4">
               '.ucwords(htmlspecialchars($userData['email_address'])).'
            </td>
          </tr>

          <tr>
            <td class="col-md-4"><b>Phone Number</b></td>
            <td class="col-md-4">'.htmlspecialchars($userData['phone_number']).'</td>
          </tr>

          <tr>
            <td class="col-md-4"><b>Program Name</b></td>
            <td class="col-md-4">'.ucwords(htmlspecialchars($userData['program'])).' '.$programStatus.'</td>
          </tr>

          <tr>
            <td class="col-md-4"><b>Course Name</b></td>
            <td class="col-md-4">'.ucwords(htmlspecialchars($userData['c_name'])).' '.$courseStatus.'</td>
          </tr>

          <tr>
            <td class="col-md-4"><b>Shift</b></td>
            <td class="col-md-4">
               '.htmlspecialchars($userData['updated_shift']).'
            </td>
          </tr>

          <tr>
            <td class="col-md-4"><b>Course Fees</b></td>
            <td class="col-md-4">'.htmlspecialchars($userData['u_fee']).'</td>
          </tr>



          <tr>
            <td class="col-md-4"><b>Enrollment Date</b></td>
            <td class="col-md-4">'.formatDate($userData['enrollDate']).'</td>
          </tr>
         </table><br>';

         return MsgDisplay('success',$html);
			}
		}
	}
	else
	{
		return MsgDisplay('error','Invalid Student Profile.....!');
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['course']) AND isset($_POST['userId']) AND isset($_POST['rollNo']))
{
	//course Decision
	$course=$_POST['course'];
	$userId=$_POST['userId'];
	$rollNo=$_POST['rollNo'];

	if(is_numeric($userId) AND is_numeric($rollNo) AND ($course=='completeCourse' OR $course=='discontinueCourse'))
	{
		$run=$con->prepare('SELECT * FROM student WHERE id=? AND roll_no=? AND u_status=?');
		$run->bindParam(1,$userId,PDO::PARAM_INT);
		$run->bindParam(2,$rollNo,PDO::PARAM_INT);
		$run->bindValue(3,'enroll',PDO::PARAM_STR);
		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$run=$con->prepare('UPDATE student SET `u_status`=? WHERE id=? AND roll_no=? AND u_status=?');
				$run->bindValue(1,$course,PDO::PARAM_STR);
				$run->bindParam(2,$userId,PDO::PARAM_INT);
		    $run->bindParam(3,$rollNo,PDO::PARAM_INT);
		    $run->bindValue(4,'enroll',PDO::PARAM_STR);

		    if($run->execute())
		    {
		    	return MsgDisplay('success','Student Updated Successfully.....!');
		    }
			}
			else
			{
				return MsgDisplay('error','Invalid Student.....!');
			}
		}
	}
	else
	{
		return MsgDisplay('error','Invalid Student.....!');
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
	
}
else if(isset($_POST['payfee']) AND isset($_POST['userId']) AND isset($_POST['rollNo']))
{
	// Get total fees, pay fees, remaning fees;
	$userId=$_POST['userId'];
	$rollNo=$_POST['rollNo'];

	if(!empty($_POST['payfee']) AND !empty($userId) AND !empty($rollNo) AND is_numeric($userId) AND is_numeric($userId))
	{
		$run=$con->prepare('SELECT * FROM student WHERE id=? AND roll_no=? AND u_status=?');
		$run->bindParam(1,$userId,PDO::PARAM_INT);
		$run->bindParam(2,$rollNo,PDO::PARAM_INT);
		$run->bindValue(3,'enroll',PDO::PARAM_STR);
		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$userData=$run->fetchAll(pdo::FETCH_ASSOC);

				$run=$con->prepare('SELECT * FROM `studentsfee` WHERE u_id=? AND f_roll_no=?');
				$run->bindParam(1,$userId,PDO::PARAM_INT);
				$run->bindParam(2,$rollNo,PDO::PARAM_INT);

				if($run->execute())
				{
					if($run->rowCount()>0)
					{
						$payAmount=0;
						$feeData=$run->fetchAll(pdo::FETCH_ASSOC);
						$lastElement = end($feeData);
	          $totalPay = $lastElement['pay_amount'];

						if($run->rowCount()==1)
						{
							$payAmount+=$feeData[0]['pay_amount'];
							$remainingAmount=$userData[0]['u_fee']-$payAmount;
							
						}
						else
						{
							$payAmount=$totalPay;
							$remainingAmount=$userData[0]['u_fee']-$totalPay;
						}

						if($totalPay==$userData[0]['u_fee'])
	          {
	          	$msg='<br><center><p><b>Total Course Fee</b> :- '.$userData[0]['u_fee'].'</p> <p><b>Total Pay Fee</b> :- '.$payAmount.'</p></center>';

			         	return MsgDisplay('newAmount',$msg,'');
	          }
	          else
	          {
	          	return MsgDisplay('success','<p><b>Total Fee</b> :- '.$userData[0]['u_fee'].'</p> <p><b>Total Pay</b> :- '.$payAmount.'</p> <p><b>Remaning Pay</b> :- '.$remainingAmount.'</p>','');
	          }


					}
					else
					{
						return MsgDisplay('success','<p><b>Total Fee</b> :- '.$userData[0]['u_fee'].'</p>','');
					}
				}
				
			}
			else
			{
				return MsgDisplay('error','Invalid Student.....!');
			}
		}
	}
	else
	{
		return MsgDisplay('error','Invalid Student.....!');
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['payAmount']) AND isset($_POST['userId']) AND isset($_POST['rollNo']))
{
	$userId=$_POST['userId'];
	$rollNo=$_POST['rollNo'];
	$inputAmount=intval($_POST['payAmount']);

	if(!empty($_POST['payAmount']) AND !empty($userId) AND !empty($rollNo) AND is_numeric($userId) AND is_numeric($userId) AND is_numeric($inputAmount))
	{
		if($inputAmount<0)
		{
			return MsgDisplay('error','The entered amount is invalid. Please enter a positive amount and not a negative one.....!');
		}

		$run=$con->prepare('SELECT * FROM student WHERE id=? AND roll_no=? AND u_status=?');
		$run->bindParam(1,$userId,PDO::PARAM_INT);
		$run->bindParam(2,$rollNo,PDO::PARAM_INT);
		$run->bindValue(3,'enroll',PDO::PARAM_STR);
		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$userData=$run->fetchAll(pdo::FETCH_ASSOC);

				$run=$con->prepare('SELECT * FROM `studentsfee` WHERE u_id=? AND f_roll_no=?');
				$run->bindParam(1,$userId,PDO::PARAM_INT);
				$run->bindParam(2,$rollNo,PDO::PARAM_INT);

				if($run->execute())
				{
					if($run->rowCount()>0)
					{
						$payAmount=0;
						$feeData=$run->fetchAll(pdo::FETCH_ASSOC);
						$lastElement = end($feeData);
            $totalPay = $lastElement['pay_amount'];

            if($totalPay==$userData[0]['u_fee'])
						{
							return MsgDisplay('error','The total payment has already been made......!');
						}


						$payAmount+=$totalPay+$inputAmount;
						$remainingAmount=$userData[0]['u_fee']-$payAmount;
						


						if($inputAmount>$remainingAmount AND $remainingAmount!=0)
						{
							return MsgDisplay('error','The remaining amount for the course is <b>'.$remainingAmount.',</b> and you have paid <b>'.$inputAmount.'</b>. Please enter the correct amount you want to pay');
						}
						
					}
					else
					{
						if($inputAmount>$userData[0]['u_fee'])
						{
							return MsgDisplay('error','The total fee for the course is <b>'.$userData[0]['u_fee'].'</b>, and you have paid <b>'.$inputAmount.'</b>. Please enter the correct amount you wish to pay');
							
						}
						else
						{
							$payAmount=$inputAmount;
							$remainingAmount=$userData[0]['u_fee']-$inputAmount;

							if($remainingAmount==0 AND $inputAmount==$userData[0]['u_fee'])
							{
								$run=$con->prepare('INSERT INTO `studentsfee`(`u_id`, `f_roll_no`,`fee_pay`, `pay_amount`, `remaining_fee`) VALUES (?,?,?,?,?)');

								$run->bindParam(1,$userId,PDO::PARAM_INT);
		            $run->bindParam(2,$rollNo,PDO::PARAM_INT);
		            $run->bindParam(3,$inputAmount,PDO::PARAM_INT);
								$run->bindParam(4,$payAmount,PDO::PARAM_INT);
								$run->bindParam(5,$remainingAmount,PDO::PARAM_INT);

								if($run->execute())
								{
									return MsgDisplay('fullPaymentAdded','<p><b>Total Fee</b> :- '.$userData[0]['u_fee'].'</p> <p><b>Total Pay</b> :- '.$payAmount.'</p> <p><b>Remaning Pay</b> :- '.$remainingAmount.'</p>','');
								}
							}
							else if($remainingAmount<0)
							{
								return MsgDisplay('error','The remaining amount for the course is <b>'.$remainingAmount.',</b> and you have paid <b>'.$inputAmount.'</b>. Please enter the correct amount you want to pay');
							}
						}
					}

					if($payAmount==$userData[0]['u_fee'] AND $remainingAmount==0)
					{
						$run=$con->prepare('INSERT INTO `studentsfee`(`u_id`, `f_roll_no`,`fee_pay` ,`pay_amount`, `remaining_fee`) VALUES (?,?,?,?,?)');
						$run->bindParam(1,$userId,PDO::PARAM_INT);
            $run->bindParam(2,$rollNo,PDO::PARAM_INT);
            $run->bindParam(3,$inputAmount,PDO::PARAM_INT);
						$run->bindParam(4,$payAmount,PDO::PARAM_INT);
						$run->bindParam(5,$remainingAmount,PDO::PARAM_INT);

						if($run->execute())
						{
							return MsgDisplay('fullPaymentAdded','<p><b>Total Fee</b> :- '.$userData[0]['u_fee'].'</p> <p><b>Total Pay</b> :- '.$payAmount.'</p> <p><b>Remaning Pay</b> :- '.$remainingAmount.'</p>','');

						}
					}
					else
					{
						if(!empty($payAmount) AND !empty($remainingAmount) AND is_numeric($payAmount) AND is_numeric($remainingAmount))
	          {//check('hello');
	          	$run=$con->prepare('INSERT INTO `studentsfee`(`u_id`, `f_roll_no`,`fee_pay`,`pay_amount`, `remaining_fee`) VALUES (?,?,?,?,?)');


							$run->bindParam(1,$userId,PDO::PARAM_INT);
	            $run->bindParam(2,$rollNo,PDO::PARAM_INT);
	            $run->bindParam(3,$inputAmount,PDO::PARAM_INT);
							$run->bindParam(4,$payAmount,PDO::PARAM_INT);
							$run->bindParam(5,$remainingAmount,PDO::PARAM_INT);

							if($run->execute())
							{
								return MsgDisplay('amountAdded','<p><b>Total Fee</b> :- '.$userData[0]['u_fee'].'</p> <p><b>Total Pay</b> :- '.$payAmount.'</p> <p><b>Remaning Pay</b> :- '.$remainingAmount.'</p>','');
							}
	          }
					}
				}
			}
		}
	}
	else
	{
		return MsgDisplay('error','Please Enter the Amount....!');
	}
}
else if(isset($_POST['teacherPaySalery']) AND isset($_POST['teacherId']))
{
	if(is_numeric($_POST['teacherId']))
	{
		$teacherId=$_POST['teacherId'];

		$run=$con->prepare('SELECT * FROM `teachers` WHERE t_id=? AND t_status=?');
		$run->bindParam(1,$teacherId,PDO::PARAM_INT);
		$run->bindValue(2,'employee',PDO::PARAM_STR);

		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$data=$run->fetch(PDO::FETCH_ASSOC);

				$run=$con->prepare('SELECT * FROM `teachersalery` WHERE t_id=? ORDER BY id DESC');
				$run->bindParam(1,$teacherId,PDO::PARAM_INT);


				if($run->execute())
				{
					if($run->rowCount()>0)
					{
						$teacherData=$run->fetch(PDO::FETCH_ASSOC);

						$current_month = date('n'); // Get current month number
						$salery_date_month = date('n', strtotime($teacherData['salery_date'])); // Get month number of salery_date field

						if ($current_month == $salery_date_month) 
						{
						    return MsgDisplay('error','The teacher salary has already been paid this month....!');
						} else 
						{
								if(isset($_POST['dectect']) AND !empty($_POST['dectect']))
								{

									$salery=$data['t_salery']-$_POST['dectect'];
								}
								else
								{
									$salery=$data['t_salery'];
								}

						  $run=$con->prepare('INSERT INTO `teachersalery`(`t_id`, `salery`) VALUES (?,?)');
						  $run->bindParam(1,$teacherId,PDO::PARAM_INT);
						  $run->bindParam(2,$salery,PDO::PARAM_INT);

							if($run->execute())
							{
								return MsgDisplay('success','Teacher Salery Pay Successfully....!');
							}
						}

					}
					else
					{
						if(isset($_POST['dectect']) AND !empty($_POST['dectect']))
								{
									$salery=$data['t_salery']-$_POST['dectect'];
								}
								else
								{
									$salery=$data['t_salery'];
								}


						$run=$con->prepare('INSERT INTO `teachersalery`(`t_id`, `salery`) VALUES (?,?)');
						$run->bindParam(1,$teacherId,PDO::PARAM_INT);
						$run->bindParam(2,$salery,PDO::PARAM_INT);

						if($run->execute())
						{
							return MsgDisplay('success','Teacher Salery Pay Successfully....!');
						}
					}
				}
			}
		}
	}
}
else if(isset($_POST['changePassword']) AND isset($_POST['old_pass']) AND isset($_POST['new_pass']) AND isset($_POST['confirm_pass'])) 
{
	if($_POST['old_pass']=='' AND $_POST['new_pass']=='' AND $_POST['confirm_pass']=='') 
  {
  	return MsgDisplay('error','All Field Are Mandatory ....!');
  }
  else if($_POST['new_pass']!=$_POST['confirm_pass']) 
  {
  	return MsgDisplay('error','Missmatch New Password And Confirm Password ....!');
  }
  else
  {
  	$email=$_SESSION['adminLogin'][1];
	  $run=$con->prepare('SELECT * FROM `admin` WHERE email_address=?');
	  $run->bindParam(1,$email,PDO::PARAM_STR);
	  if($run->execute())
	  {
	  	if($run->rowCount()>0)
	    {
	    	$adminData=$run->fetch(pdo::FETCH_ASSOC);
	    	
	    	if($adminData['password']===$_POST['old_pass'])
	    	{
	    		$run=$con->prepare('UPDATE `admin` SET `password`=? WHERE email_address=?');
		    	$run->bindParam(1,$_POST['new_pass'],PDO::PARAM_STR);
		    	$run->bindParam(2,$email,PDO::PARAM_STR);

		    	if($run->execute())
		    	{
		    		return MsgDisplay('success','Password Change Successfully....!');
		    	}
	    		
	    	}
	    	else
	    	{
	    		return MsgDisplay('error','Old Password is Incorrect ....!');
	    	}
	    }
	    else
	    {
	    	return MsgDisplay('error','Invalid Email Address.....!');
	    }
	  }
  }

  return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
}


?>