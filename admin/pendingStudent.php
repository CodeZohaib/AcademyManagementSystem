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
    <title>Admin Panel | All Pending Users</title>

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
                    <h1><i class="fa fa-users"></i> All Student <small>View All Pending Student</small></h1><hr>
                    <ol class="breadcrumb">
                       
                      <li class="active"><i class="fa fa-users"></i> All Pending Student</li>
                    </ol>
               
                    <form method="POST" action="#" class="search_friend_profile">
                      <div class="form-row">
                   
                         <div class="form-group col-md-4">
                          <label for="inputZip">Search Pending Student</label>
                            <input type="text" class="form-control searchPendingStudent" name="teacher" placeholder="Search Pending Student Related Data" style="border-radius:3px; text-align:center;">
                        </div><br>
                  
                        <button type="button" class="btn btn-primary" data-target='.courseEnroll'  data-toggle="modal"  style="float: right;">Add New Student</button>
                      </div><br><br>
                      <div class="error_sms"></div>
                    </form><br><br>

                    <?php 

                    $pendingStudent=getPendingStudent();
                    if($pendingStudent=='empty')
                    {
                      echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>There are no pending students.......!</p>";
                    }
                    

                    if(is_array($pendingStudent))
                    {
                    ?>
                    
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Program Name</th>
                                <th>P Status</th>
                                <th>Course Name</th>
                                <th>C Status</th>
                                <th>Shift</th>
                                <th>Course</th>
                                <th>Edit</th>
                                <th>Accept</th>
                                <th>Reject</th>
                            </tr>
                        </thead>
                        <tbody class="pendingStudentAllData">

                        <?php 
                             $i=1;
                            foreach ($pendingStudent as $key => $value) 
                            {

                                if($value['status']=='private')
                                {
                                    $programStatus='<span class="badge" data-toggle="tooltip" data-placement="top" title="" style="background:#3067EF; float:right" data-original-title="Program is private, the courses associated with the program will also be private">Private</span>';
                                }
                                else if($value['status']=='publish')
                                {
                                    $programStatus='<span class="badge" style="background:#6fd96f;">Publish</span>';
                                }
                                else if($value['status']=='delete')
                                {
                                    $programStatus='<span class="badge" style="background:#e12b31;">Delete</span>';
                                }


                            if($value['c_status']=='publish')
                            {
                                $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#6fd96f;" title="Course is public. it will be visible on the website">Publish</span>';
                            }
                            else  if($value['c_status']=='c_private')
                            {
                                $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#3067EF;" title="Course is Private. it will not be visible to visitors">Course Private</span>';
                            }
                            else if($value['c_status']=='p_private')
                            {
                                $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" style="background:#B4DF14;" title="Program is private, the courses associated with the program will also be private">Program Private</span>';
                            }
                            else if($value['c_status']=='c_delete')
                            {
                                $courseStatus='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#c71c22;" title="Course is Private. it will not be visible to visitors">Course Delete</span>';
                            }


                            echo '<tr>
                                <td>'.$i.'</td>
                                <td>
                                <a href="#"  class="studentProfile" userId="'.$value['userID'].'" data-target=".checkStudentProfile" data-toggle="modal">'.ucwords(htmlspecialchars($value['name'])).'</a></td>
                                <td>'.ucwords(htmlspecialchars($value['father_name'])).'</td>
                                <td>'.ucwords(htmlspecialchars($value['program'])).'</td>
                                <td class="text-center">'.$programStatus.'</td>
                                <td>'.ucwords(htmlspecialchars($value['c_name'])).'</td>
                                <td class="text-center">'.$courseStatus.'</td>
                                <td>'.ucwords(htmlspecialchars($value['shifts'])).'</td>

                                <td><button c_id='.$value['c_id'].' class="btn btn-primary detailCourse" data-target=".viewCourseDetail"  data-toggle="modal">View Detail</button></td>

                                <td><button type="button" data-target=".pendingUserEdit" data-toggle="modal" class="btn btn-primary editPendingUser" userId='.$value['userID'].' ><i class="glyphicon glyphicon-edit"></i></button></td>

                                <td><button type="button" data-target=".studentAccept" data-toggle="modal" userId='.$value['userID'].' p_id='.$value['p_id'].' c_id='.$value['c_id'].' class="btn btn-success pendingStudentAccept"><i class="glyphicon glyphicon-ok"></i></button></td>

                                <td><button type="button" data-target=".studentReject" data-toggle="modal" userId='.$value['userID'].' p_id='.$value['p_id'].' c_id='.$value['c_id'].' class="btn btn-danger pendingStudentReject"><i class="glyphicon glyphicon-remove"></i></button></td>
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