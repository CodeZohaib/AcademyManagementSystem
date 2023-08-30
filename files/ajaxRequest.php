<?php 

include "function.php";
//check($_POST);
if(isset($_POST['courseDetail']) AND isset($_POST['courseID']))
{
	//view course detail
	if(!empty($_POST['courseDetail']) AND !empty($_POST['courseID']))
	{
		if(is_numeric($_POST['courseID']))
		{
			$courseID=$_POST['courseID'];

			//check($_POST);
			if (isset($_POST['admin_request']))
           {
		    $run=$con->prepare('SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` JOIN `course_allocation` ON `courses`.`id`=`course_allocation`.`c_id` JOIN `teachers` ON `teachers`.`t_id`=`course_allocation`.`t_id` WHERE `courses`.`id`=? ORDER BY `courses`.id DESC');
				
				$run->bindParam(1,$courseID,PDO::PARAM_INT);
			} 
			else
			{
				$run=$con->prepare('SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` JOIN `course_allocation` ON `courses`.`id`=`course_allocation`.`c_id` JOIN `teachers` ON `teachers`.`t_id`=`course_allocation`.`t_id` WHERE `program`.`status` NOT IN(?,?) AND `courses`.`c_status` NOT IN(?,?,?,?) AND `courses`.`id`=? ORDER BY `courses`.id DESC');

				$run->bindValue(1,'private',PDO::PARAM_STR);
				$run->bindValue(2,'delete',PDO::PARAM_STR);
				$run->bindValue(3,'p_private',PDO::PARAM_STR);
				$run->bindValue(4,'c_private',PDO::PARAM_STR);
				$run->bindValue(5,'p_delete',PDO::PARAM_STR);
				$run->bindValue(6,'c_delete',PDO::PARAM_STR);
				$run->bindParam(7,$courseID,PDO::PARAM_INT);

			}  

			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$total=$run->rowCount();
					$html=[];
					$data=$run->fetchAll(PDO::FETCH_ASSOC);

					//check($data);
					if(isset($_POST['admin_request']))
					{
						if($data[0]['status']=='private')
						{
							$programStatus='<span class="badge" data-toggle="tooltip" data-placement="top" title="" style="background:#3067EF; float:right" data-original-title="Program is private, the courses associated with the program will also be private">Private</span>';
						}
						else if($data[0]['status']=='publish')
						{
							$programStatus='<span class="badge" style="background:#6fd96f; float:right">Publish</span>';
						}
						else if($data[0]['status']=='delete')
						{
							$programStatus='<span class="badge" style="background:#e12b31; float:right">Delete</span>';
						}


						if($data[0]['c_status']=='publish')
				        {
				            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#6fd96f; float:right" title="Course is public. it will be visible on the website">Publish</span>';
				        }
				        else if($data[0]['c_status']=='c_private')
				        {
				            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#3067EF; float:right" title="Course is Private. it will not be visible to visitors">Course Private</span>';
				        }
				        else  if($data[0]['c_status']=='p_private')
				        {
				            $courseStatus='<span  class="badge" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" style="background:#B4DF14; float:right" title="Program is private, the courses associated with the program will also be private">Program Private</span>';
				        }
				        else if($data[0]['c_status']=='c_delete')
				        {
				            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#c71c22; float:right" title="Course is Private. it will not be visible to visitors">Course Delete</span>';
				        }
					}
					else
					{
						$programStatus='';
						$courseStatus='';
					}

					$html[].='<p>This includes information on the course being taught, the teacher who is instructing, and the schedule/timing of the class</p><br>
		            <table class="table table-bordered table-responsive row">
		             <center><b>Course Detail</b><center>
		              <tr>
		                <td class="col-md-4"><b>Program Name</b></td>
		                <td class="col-md-4">
		                   '.ucwords(htmlspecialchars($data[0]['program'])).' '.$programStatus.'
		                </td>
		              </tr>

		               <tr>
		                <td class="col-md-4"><b>Course Name</b></td>
		                <td class="col-md-4">
		                    '.ucwords(htmlspecialchars($data[0]['c_name'])).' '.$courseStatus.'
		                </td>
		              </tr>

		              <tr>
		                <td class="col-md-4"><b>Duration</b></td>
		                <td class="col-md-4">'.ucwords(htmlspecialchars($data[0]['c_duration'])).'</td>
		              </tr>
		      

		              <tr>
		                <td class="col-md-4"><b>Fee</b></td>
		                <td class="col-md-4">
		                   '.ucwords(htmlspecialchars($data[0]['c_fee'])).'
		                </td>
		              </tr></table><center><b>Class Shift Detail</b><center>';

		              $i=1;
		              foreach ($data as $key => $value) 
		              {
		                 if($total==1)
		                 {
		                 	$count='';
		                 }
		                 else
		                 {
		                 	$count='<center><b>Shift '.$i.'</b><center><br>';
		                 } 

		                if (isset($_POST['admin_request']))
			            {
					    $image='../img/teacher_img/'.$value['t_image'];
						} 
						else
						{
							$image='img/teacher_img/'.$value['t_image'];
						}  

			              $html[].= '<table class="table table-bordered table-responsive row">
			              '.$count.'
			              <tr>
			                <td class="col-md-4"><b>Class Time</b></td>
			                <td class="col-md-4"><b>'.$value['ct_shift'].' &nbsp;&nbsp;</b> '.$value['start_time'].' <b>To</b> '.$value['end_time'].'</td>
			              </tr>

			              <tr>
			                <td class="col-md-4"><b>Teacher Name</b></td>
			                <td class="col-md-4">
			                   '.ucwords(htmlspecialchars($value['t_name'])).'
			                </td>
			              </tr>

			              <tr>
			                <td class="col-md-4"><b>Teacher Qualification</b></td>
			                <td class="col-md-4">'.ucwords(htmlspecialchars($value['t_qualification'])).'</td>
			              </tr>

			              <tr>
			                <td class="col-md-4"><b>Teacher Image</b></td>
			                <td class="col-md-4"><center><img src="'.$image.'" class="img img-responsive img-thumbnail"></center></td>
			              </tr></table>
			            ';

			            $i++;
			        }

			        $html[].='<b>Course Description</b><br>
			             <p>'.ucwords(htmlspecialchars($data[0]['c_description'])).'</p><br>';

			        $html[].='<a href="" p_id="'.$value['p_id'].'" c_id="'.$value['id'].'" data-target=".courseEnroll" class="btn btn-primary applyCourse"  data-toggle="modal" onclick="applyCourse(this)">Enroll</a>';
		            $val=implode(" ",$html);

		            //check($val);
	                return MsgDisplay('success',$val,'');

				}
				else
				{
					if(isset($_POST['admin_request']))
		          {
		          	$msg='Teacher detail and class timing are not added....!';
		          	$run=$con->prepare("SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` WHERE  `courses`.`id`=? ORDER BY `courses`.id DESC");

								$run->bindParam(1,$courseID,PDO::PARAM_INT);
		          }
		          else
		          {
		          	$msg='Teacher detail and class timing are currently not available and that you apologize for any inconvenience this may cause. It also informs the user to check back later as you are working to provide the complete information as soon as possible';

						   $run=$con->prepare("SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` WHERE `program`.`status` NOT IN(?,?) AND `courses`.`c_status` NOT IN(?,?,?,?) AND `courses`.`id`=? ORDER BY `courses`.id DESC");

						    $run->bindValue(1,'private',PDO::PARAM_STR);
								$run->bindValue(2,'delete',PDO::PARAM_STR);
								$run->bindValue(3,'p_private',PDO::PARAM_STR);
								$run->bindValue(4,'c_private',PDO::PARAM_STR);
								$run->bindValue(5,'p_delete',PDO::PARAM_STR);
								$run->bindValue(6,'c_delete',PDO::PARAM_STR);
								$run->bindParam(7,$courseID,PDO::PARAM_INT);

		          }

			
			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$data=$run->fetchAll(PDO::FETCH_ASSOC);
					//check($data);
					if(isset($_POST['admin_request']))
					{
						if($data[0]['status']=='private')
						{
							$programStatus='<span class="badge" data-toggle="tooltip" data-placement="top" title="" style="background:#3067EF; float:right" data-original-title="Program is private, the courses associated with the program will also be private">Private</span>';
						}
						else if($data[0]['status']=='publish')
						{
							$programStatus='<span class="badge" style="background:#6fd96f; float:right">Publish</span>';
						}
						else if($data[0]['status']=='delete')
						{
							$programStatus='<span class="badge" style="background:#e12b31; float:right">Delete</span>';
						}


						if($data[0]['c_status']=='publish')
		        {
		            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#6fd96f; float:right" title="Course is public. it will be visible on the website">Publish</span>';
		        }
		        else  if($data[0]['c_status']=='c_private')
		        {
		            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#3067EF; float:right" title="Course is Private. it will not be visible to visitors">Course Private</span>';
		        }
		        else  if($data[0]['c_status']=='p_private')
		        {
		            $courseStatus='<span  class="badge" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" style="background:#B4DF14; float:right" title="Program is private, the courses associated with the program will also be private">Program Private</span>';
		        }
		        else if($data[0]['c_status']=='c_delete')
		        {
		            $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#c71c22; float:right" title="Course is Private. it will not be visible to visitors">Course Delete</span>';
		        }
					}
					else
					{
						$programStatus='';
						$courseStatus='';
					}
					$html='<p>This includes information on the course being taught, the teacher who is instructing, and the schedule/timing of the class</p><br>
		            <table class="table table-bordered table-responsive row">
		             <center><b>Course Detail</b><center>
		              <tr>
		                <td class="col-md-4"><b>Program Name</b></td>
		                <td class="col-md-4">
		                   '.ucwords(htmlspecialchars($data[0]['program'])).' '.$programStatus.'
		                </td>
		              </tr>

		               <tr>
		                <td class="col-md-4"><b>Course Name</b></td>
		                <td class="col-md-4">
		                    '.ucwords(htmlspecialchars($data[0]['c_name'])).' '.$courseStatus.'
		                </td>
		              </tr>

		              <tr>
		                <td class="col-md-4"><b>Duration</b></td>
		                <td class="col-md-4">'.ucwords(htmlspecialchars($data[0]['c_duration'])).'</td>
		              </tr>
		      

		              <tr>
		                <td class="col-md-4"><b>Fee</b></td>
		                <td class="col-md-4">
		                   '.ucwords(htmlspecialchars($data[0]['c_fee'])).' PKR
		                </td>
		              </tr></table><br>
		              <b>Course Description</b><br>
		              <p>'.ucwords(htmlspecialchars($data[0]['c_description'])).'</p>
		              <center><b>Class Shift Detail</b><center><br>'.$msg.'</p><br><a href="" p_id="'.$data[0]['p_id'].'" c_id="'.$data[0]['id'].'" data-target=".courseEnroll" class="btn btn-primary applyCourse"  data-toggle="modal" onclick="applyCourse(this)">Enroll</a>';



	                return MsgDisplay('success',$html,'');
				}
			}

			return MsgDisplay('error','Course details are currently unavailable. Please check back later as we are working to complete the upload of full information.....!','');
				}
			}
		}
		else
		{
			return MsgDisplay('error','Invalid Course Select.....!','');
		}
	}

	return MsgDisplay('error','Something Was Wrong Please Try Again.....!','');
}
else if(isset($_POST['programID']) AND isset($_POST['courseID']) AND isset($_POST['name']) AND isset($_POST['fatherName']) AND isset($_POST['dob']) AND isset($_POST['current_address']) AND isset($_POST['email_address']) AND isset($_POST['phone_number']) AND isset($_POST['gender']) AND isset($_POST['shift']))
{


	$programID=$_POST['programID'];
	$courseID=$_POST['courseID'];
	$userName=strtolower($_POST['name']);
	$fatherName=strtolower($_POST['fatherName']);
	$dob=$_POST['dob'];
	$current_address=strtolower($_POST['current_address']);
	$email_address=strtolower($_POST['email_address']);
	$phone_number=strtolower($_POST['phone_number']);
	$gender=strtolower($_POST['gender']);
	$shift=$_POST['shift'];

	if(!empty($userName) AND !empty($fatherName) AND !empty($dob) AND !empty($current_address) AND !empty($email_address) AND !empty($phone_number) AND !empty($gender) AND !empty($shift))
	{
		if(!empty($programID) AND !empty($courseID) AND is_numeric($programID) AND is_numeric($courseID))
		{

			if(!preg_match('/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/', $phone_number)) 
	        {
			  return MsgDisplay('error',' Phone number is invalid');
			}



			// Create a DateTime object from the submitted date string
			$date = DateTime::createFromFormat('Y-m-d', $_POST['dob']);

			// Check if the date is valid
			if ($date === false || array_sum($date::getLastErrors()) > 0) {
			    return MsgDisplay('error','Invalid date of birth......!');
			} else {
			    $currentDate = new DateTime();

			    $minDate = DateTime::createFromFormat('Y-m-d', '1950-01-01');
                $maxDate = DateTime::createFromFormat('Y-m-d', '2006-12-31');


			    if ($date < $minDate || $date > $maxDate) 
			    {
			        return MsgDisplay('error','Date of birth should be between 1950-01-01 and 2006-12-31......!');
			    }
			}


			$run=$con->prepare("SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` WHERE `program`.`status` NOT IN(?,?) AND `courses`.`c_status` NOT IN(?,?,?,?) AND `program`.`id`=? AND `courses`.`id`=? ORDER BY `courses`.id DESC");

			$run->bindValue(1,'private',PDO::PARAM_STR);
			$run->bindValue(2,'delete',PDO::PARAM_STR);
			$run->bindValue(3,'p_private',PDO::PARAM_STR);
			$run->bindValue(4,'c_private',PDO::PARAM_STR);
			$run->bindValue(5,'p_delete',PDO::PARAM_STR);
			$run->bindValue(6,'c_delete',PDO::PARAM_STR);
			$run->bindParam(7,$programID,PDO::PARAM_INT);
			$run->bindParam(8,$courseID,PDO::PARAM_INT);

			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					$fullData=$run->fetch(PDO::FETCH_ASSOC);

					if($shift=='Morning' || $shift=='Evening')
					{
						
						$run=$con->prepare('SELECT * FROM `student` WHERE p_id=? AND c_id=? AND name=? AND father_name=? AND email_address=?');

						$run->bindParam(1,$programID,PDO::PARAM_INT);
						$run->bindParam(2,$courseID,PDO::PARAM_INT);
						$run->bindParam(3,$userName,PDO::PARAM_STR);
						$run->bindParam(4,$fatherName,PDO::PARAM_STR);
						$run->bindParam(5,$email_address,PDO::PARAM_STR);

						if($run->execute())
						{
							if($run->rowCount()>0)
							{
								if(isset($_POST['adminRequest']))
								{
							    return MsgDisplay('error','Student already enrolled in this course.....!','');
								}
								else
								{
									return MsgDisplay('error','You have already enrolled in the course.....!','');
								}
								
							}
						}

						$run=$con->prepare('INSERT INTO `student`(`p_id`, `c_id`, `name`, `father_name`, `dob`, `gender`, `email_address`, `address`, `phone_number`, `shifts`, `updated_shift`,`u_fee`, `u_status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
						
						$run->bindParam(1,$programID,PDO::PARAM_INT);
						$run->bindParam(2,$courseID,PDO::PARAM_INT);
						$run->bindParam(3,$userName,PDO::PARAM_STR);
						$run->bindParam(4,$fatherName,PDO::PARAM_STR);
						$run->bindParam(5,$dob,PDO::PARAM_STR);
						$run->bindParam(6,$gender,PDO::PARAM_STR);
						$run->bindParam(7,$email_address,PDO::PARAM_STR);
						$run->bindParam(8,$current_address,PDO::PARAM_STR);
						$run->bindParam(9,$phone_number,PDO::PARAM_STR);
						$run->bindParam(10,$shift,PDO::PARAM_STR);
						$run->bindParam(11,$shift,PDO::PARAM_STR);
						$run->bindParam(12,$fullData['c_fee'],PDO::PARAM_INT);
						$run->bindValue(13,'pending',PDO::PARAM_STR);

						if($run->execute())
						{
							if(isset($_POST['adminRequest']))
							{

						    return MsgDisplay('success','Course enrollment was successful. <br>Next Step Assign to the roll no .....!','');
							}
							else
							{
								 return MsgDisplay('success','Your course enrollment was successful. Please visit the academy to start your course.....!','');
							}
						}

				    }

				}
			}
    	}
    	else
    	{
    		return MsgDisplay('error','Invalid Course Enrollment.....!','');
    	}
	}
	else
	{
		return MsgDisplay('error','All Field Are Mandatory.....!','');
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

				$image='img/teacher_img/'.$data['t_image'];
				
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
else if(isset($_POST['forgotPassword']) AND isset($_POST['emailAddress']))
{
	if(!empty($_POST['emailAddress']))
	{
		$email=$_POST['emailAddress'];

	    $run=$con->prepare('SELECT * FROM `admin` WHERE email_address=?');
	    $run->bindParam(1,$email,PDO::PARAM_STR);
	    if($run->execute())
	    {
	    	if($run->rowCount()>0)
		    {
		    	$adminData=$run->fetch(pdo::FETCH_ASSOC);
		    	$subject='Forgot Password Code';
	            $message="Your Password is:- ".$adminData['password']."</p><br><hr><p>If You Think You Did Not Make This Request, Just ignore this email</p>";
	            @mail($email, $subject, $message,"Content-type: text/html\r\n");
	            return MsgDisplay('success','Password Send Your Email Address.....!');
		    }
		    else
		    {
		    	return MsgDisplay('error','Invalid Email Address.....!');
		    }
	    }
	}
	else
	{
		return MsgDisplay('error','Enter Your Email Address.....!');
	}
}
?>