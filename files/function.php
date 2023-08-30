<?php 

  global $con;
  $con = connection();

  function connection()
  {
  	try
  	{
	    $db=new PDO("mysql:host=localhost;dbname=academy","root","");
	    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    return $db;
	  }

	  catch(PDOException $e)
	  {
	    echo "Sorry database connection error:-".$e->getMessage();
	    exit();
	  }

  }


  function check($array)
  {
  	echo "<pre>";
  	print_r($array);
  	exit();
  }

    function formatDate($date)
	{
	      return date('F j, Y, g:i A',strtotime($date));
	}
 

	function MsgDisplay($status,$msg,$url=NULL)
	{
		if ($status==='success' && !empty($url)) 
		{
			echo json_encode([
				'success'=>'success',
				'message'=>$msg,
				'url'=>$url,
				
			]);
		}
		else if ($status==='success' && empty($url)) 
		{
			echo json_encode([
				'success'=>'success',
				'message'=>$msg,
		    ]);
		}
		else if($status==='newAmount' && empty($url)) 
		{
			echo json_encode([
				'success'=>'success',
				'newAmount' => $msg,
				'message'=>"<p class='alert alert-success text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>The total payment has already been made......!</p>",
				'url'=>$url,
				
			]);
		}
		else if($status==='amountAdded' && empty($url)) 
		{
			echo json_encode([
				'success'=>'success',
				'amountAdded' => $msg,
				'message'=>'Payment has been added successfully.....!',
				'url'=>$url,
				
			]);
		}
		else if($status==='fullPaymentAdded' && empty($url)) 
		{

			echo json_encode([
				'success'=>'success',
				'amountAdded' => $msg,
				'message'=>'The course fees have been fully paid.....!',
				'url'=>$url,
				
			]);
		}
		else if ($status==='error' && empty($url)) 
		{
			echo json_encode([
				'error'=>'error',
				'message'=>$msg,
		    ]);
		}
	    else if ($status==='refersh') 
        {
	        echo json_encode([
	            'success'=>'success',
	            'message'=>$msg,
	            'signout'=>1,
	        ]);
        }
	}

	function getAllProgram()
	{
		global $con;

		   $run=$con->prepare("SELECT * FROM `program` WHERE status!=? ORDER BY id DESC");
       $run->bindValue(1,'delete',PDO::PARAM_STR);
        if($run->execute())
        {
          if($run->rowCount()>0)
          {
            $program=$run->fetchAll(PDO::FETCH_ASSOC);
            return $program;
          }
        }

        return null;
	}


	function displayAllCourse($id=null)
	{
		global $con;
		if($id!=null)
		{
			if(is_numeric(($id)))
			{
				$run=$con->prepare("SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` WHERE `program`.`status` NOT IN(?,?) AND `courses`.`c_status` NOT IN(?,?,?,?) AND `program`.`id`=? ORDER BY `courses`.id DESC");

				$run->bindValue(1,'private',PDO::PARAM_STR);
				$run->bindValue(2,'delete',PDO::PARAM_STR);
				$run->bindValue(3,'p_private',PDO::PARAM_STR);
				$run->bindValue(4,'c_private',PDO::PARAM_STR);
				$run->bindValue(5,'p_delete',PDO::PARAM_STR);
				$run->bindValue(6,'c_delete',PDO::PARAM_STR);
				$run->bindParam(7,$id,PDO::PARAM_INT);
			}
			else
			{
				return null;
			}
		}
		else
		{
				$run=$con->prepare("SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` WHERE `program`.`status` NOT IN(?,?) AND `courses`.`c_status` NOT IN(?,?,?,?) ORDER BY `courses`.id DESC");

			$run->bindValue(1,'private',PDO::PARAM_STR);
			$run->bindValue(2,'delete',PDO::PARAM_STR);
			$run->bindValue(3,'p_private',PDO::PARAM_STR);
			$run->bindValue(4,'c_private',PDO::PARAM_STR);
			$run->bindValue(5,'p_delete',PDO::PARAM_STR);
			$run->bindValue(6,'c_delete',PDO::PARAM_STR);
		}

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allCourse=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allCourse;
      }
      else
      {
      	if($id!=null)
				{
					if(is_numeric(($id)))
					{
						return 'not_lunch_course';
					}
				}
      }
    }

    return null;
	}


	function displayAdminCourse()
	{
		global $con;
		
		$run=$con->prepare("SELECT * FROM `program` JOIN `courses` ON `courses`.`p_id`=`program`.`id` WHERE `program`.`status`!=? AND `courses`.`c_status` NOT IN(?,?) ORDER BY `courses`.id DESC");

			$run->bindValue(1,'delete',PDO::PARAM_STR);
			$run->bindValue(2,'p_delete',PDO::PARAM_STR);
			$run->bindValue(3,'c_delete',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allCourse=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allCourse;
      }
      else
      {
      	return 'not_lunch_course';
      }
    }

    return null;

	}


	function getAllTeachers()
	{
		global $con;
		
		$run=$con->prepare("SELECT * FROM `teachers` WHERE t_status=? ORDER BY t_id DESC");

		$run->bindValue(1,'employee',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allTeacher=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allTeacher;
      }
      else
      {
      	return 'zero_teacher';
      }
    }

    return null;

	}


	function getAllTimeSlote()
	{
		global $con;
		
		$run=$con->prepare("SELECT *  FROM `course_allocation` AS `ct1`
			JOIN `program` ON `program`.`id` = `ct1`.`p_id`
			JOIN `courses` ON `program`.`id` = `courses`.`p_id`
			JOIN `course_allocation` AS `ct2` ON `courses`.`id` = `ct2`.`c_id`
			JOIN `teachers` ON `teachers`.`t_id` = `ct2`.`t_id` 
			WHERE `program`.`status`!=? AND`courses`.`c_status` NOT IN(?,?) AND `teachers`.`t_status`=? GROUP BY `ct1`.`ca_id` ORDER BY `ct1`.`ca_id` DESC");

		$run->bindValue(1,'delete',PDO::PARAM_STR);
		$run->bindValue(2,'c_delete',PDO::PARAM_STR);
		$run->bindValue(3,'p_delete',PDO::PARAM_STR);
		$run->bindValue(4,'employee',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $timeslote=$run->fetchAll(PDO::FETCH_ASSOC);
        return $timeslote;
      }
      else
      {
      	return 'empty';
      }
    }

    return null;

	}




	function getPendingStudent()
	{
		global $con;
		
		$run=$con->prepare("SELECT u.id as userID, u.*, p.*, c.*
		FROM student u
		JOIN `program` p ON p.`id` = u.`p_id`
		JOIN `courses` c ON u.`c_id` = c.`id`
		WHERE u.`u_status` = ?
		GROUP BY u.id
		ORDER BY u.`id` DESC;

			");

		$run->bindValue(1,'pending',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allPendingUser=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allPendingUser;
      }
      else
      {
      	return 'empty';
      }
    }

    return null;

	}

	function getEnrollStudents()
	{
		global $con;
		
		$run=$con->prepare("SELECT u.id as userID,u.updated_at as enrollDate,u.created_at as enrollApplyDate, u.*, p.*, c.*
		FROM student u
		JOIN `program` p ON p.`id` = u.`p_id`
		JOIN `courses` c ON u.`c_id` = c.`id`
		WHERE u.`u_status` = ? AND u.`roll_no` IS NOT NULL
		GROUP BY u.`id`
		ORDER BY u.`updated_at` DESC;

			");

		$run->bindValue(1,'enroll',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allPendingUser=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allPendingUser;
      }
      else
      {
      	return 'empty';
      }
    }

    return null;
	}



function getNewRollNo() 
{
	global $con;
  $run=$con->prepare('SELECT * FROM student WHERE roll_no IS NOT NULL ORDER BY roll_no DESC');
	if($run->execute())
	{
		if($run->rowCount()>0)
		{
			$data=$run->fetch(PDO::FETCH_ASSOC);
			$rollNo=$data['roll_no'];
			$rollNo=$data['roll_no']+1;
		}
		else
		{
			$rollNo=1;
		}

		return $rollNo;
	}
    return true;
}



	function rollNo($userId,$programID,$courseID)
	{
		global $con;
		// accept enrollment student by new roll no
		if(!empty($userId)  AND !empty($programID) AND !empty($courseID)) 
		{
			$uniqueNumber = getNewRollNo();
			if(is_numeric($userId)  AND is_numeric($programID) AND is_numeric($courseID)) 
		  {
  			$run=$con->prepare('UPDATE student SET `roll_no`=?,`u_status`=? WHERE id=? AND p_id=? AND c_id=?');

				$run->bindParam(1,$uniqueNumber,PDO::PARAM_INT);
				$run->bindValue(2,'enroll',PDO::PARAM_STR);
				$run->bindParam(3,$userId,PDO::PARAM_INT);
				$run->bindParam(4,$programID,PDO::PARAM_INT);
				$run->bindParam(5,$courseID,PDO::PARAM_INT);

				if($run->execute())
				{
					return MsgDisplay('success','Enrollment successful. Roll number has been assigned.<br><b>Roll No :- </b>'.$uniqueNumber);
				}
		  }
		  else
		  {
		  	return MsgDisplay('error','Invalid User Enrollment.....!');
		  }
		}

		return MsgDisplay('error','Something Was Wrong Please Try Again.....!');
	}


	function getDiscontinueStudents()
	{
		global $con;
		
		$run=$con->prepare("SELECT u.id as userID,u.updated_at as enrollDate,u.created_at as enrollApplyDate, u.*, p.*, c.*
		FROM student u
		JOIN `program` p ON p.`id` = u.`p_id`
		JOIN `courses` c ON u.`c_id` = c.`id`
		WHERE u.`u_status` = ? AND u.`roll_no` IS NOT NULL
		GROUP BY u.`id`
		ORDER BY u.`updated_at` DESC;

			");

		$run->bindValue(1,'discontinueCourse',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allPendingUser=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allPendingUser;
      }
      else
      {
      	return 'empty';
      }
    }

    return null;
	}


	function getEnrollStudentsFees()
	{
		global $con;
		
		$run=$con->prepare("SELECT u.id as userID, u.updated_at as enrollDate, u.created_at as enrollApplyDate,s.*, u.*, p.*, c.* FROM student u JOIN `program` p ON p.`id` = u.`p_id` JOIN `courses` c ON u.`c_id` = c.`id` JOIN `studentsfee` s ON s.`u_id` = u.`id` WHERE u.`u_status` = ? AND u.`roll_no` IS NOT NULL GROUP BY s.`f_id` ORDER BY s.`f_id` DESC;

			");

		$run->bindValue(1,'enroll',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allFeeUser=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allFeeUser;
      }
      else
      {
      	return 'empty';
      }
    }

    return null;
	}


	function getTeacherSalery()
	{
		global $con;
		
		$run=$con->prepare("SELECT * FROM `teachers` JOIN `teachersalery` ON `teachersalery`.`t_id`=`teachers`.`t_id` WHERE `teachers`.`t_status`=? ORDER BY `teachersalery`.id DESC");

		$run->bindValue(1,'employee',PDO::PARAM_STR);

    if($run->execute())
    {
      if($run->rowCount()>0)
      {
        $allTeacher=$run->fetchAll(PDO::FETCH_ASSOC);
        return $allTeacher;
      }
      else
      {
      	return 'empty';
      }
    }

    return null;
	}

?>