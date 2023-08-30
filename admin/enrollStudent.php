<?php 
 include "files/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel | Enroll Student</title>

    <link rel="stylesheet" type="text/css" href="admin/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="admin/css/animated.css">
     <link rel="stylesheet" type="text/css" href="admin/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="admin/css/style.css">

  </head>
  <body>
    <div id="wrapper">
        <?php include "include/navbar.php"; ?>

        <div class="container-fluid body-section">
            <div class="row">

                <?php include "include/sidebar.php"; ?>

                <div class="col-md-10">
                    <h1><i class="fa fa-users"></i> All Student <small>View All Student</small></h1><hr>
                    <ol class="breadcrumb">
                       
                      <li class="active"><i class="fa fa-users"></i> All Student</li>
                    </ol>
               
                    <form method="POST" action="#">
                      <div class="form-row">
                   
                        <div class="form-group col-md-4">
                          <label for="inputZip">Search Enroll Student</label>
                            <input type="text" class="form-control searchEnrollStudent" name="courseName" placeholder="Search Enroll Student Related Data" style="border-radius:3px; text-align:center;">
                        </div>
                      </div><br><br>
                      <div class="error_sms"></div>
                    </form><br><br>

                    <?php 

                    $enrollStudent=getEnrollStudents();
                    if($enrollStudent=='empty')
                    {
                      echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>There are no enroll students.......!</p>";
                    }
                    

                    if(is_array($enrollStudent))
                    {
                    ?>
                    
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Roll No</th>
                                <th>Program</th>
                                <th>Course</th>
                                <th>Student Name</th>
                                <th>Father Name</th> 
                                <th>C Status</th>          
                                <th>Course</th>
                                <th>Paid Fee</th>

                            </tr>
                        </thead>
                        <tbody class="enrollStudentAllData">
                            <?php 
                                $i=1;
                                foreach ($enrollStudent as $key => $value) 
                                {
                                    if($value['u_status']=='enroll')
                                    {
                                        $status='<span class="badge">Continue</span>';
                                    }
                                    
                                   echo '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.ucwords(htmlspecialchars($value['roll_no'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['program'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['c_name'])).'</td>
                                        <td> <a href="#"  class="studentProfile" userId="'.$value['userID'].'" data-target=".checkStudentProfile" data-toggle="modal">'.ucwords(htmlspecialchars($value['name'])).'</a></td>
                                        <td>'.ucwords(htmlspecialchars($value['father_name'])).'</td>
                                        <td>'.$status.'</td>

                                         <td><button class="btn btn-success decisionCourse" data-target=".courseDecision" data-toggle="modal" userId='.$value['userID'].' rollNo='.$value['roll_no'].'>Course</button></td>
                                         <td><button class="btn btn-success payStudent" data-target=".payfeeModal" data-toggle="modal" userId='.$value['userID'].' rollNo='.$value['roll_no'].'>Paid Fee</button></td>

                                    </tr>';

                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                     <?php } ?>
                </div>


            </div>


        </div>


      <?php include "include/footer.php"; ?>

  </body>
</html>