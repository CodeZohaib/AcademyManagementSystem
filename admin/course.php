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
    <title>Admin Panel | All Courses</title>

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
                    <h1><i class="glyphicon glyphicon-book"></i> All Course <small>View All Course</small></h1><hr>
                    <ol class="breadcrumb">
                      <li class="active"><i class="glyphicon glyphicon-book"></i> All Course</li>
                    </ol>
               
                    <form method="POST" action="#" class="search_friend_profile">
                      <div class="form-row">
                   
                        <div class="form-group col-md-4">
                          <label for="inputZip">Search Course</label>
                            <input type="text" class="form-control searchCourseName" name="courseName" placeholder="Search Course Related Data" style="border-radius:3px; text-align:center;">
                        </div><br>

                        <button type="button" style="float:right;" class="btn btn-primary" data-target='.addCourse'  data-toggle="modal"  style="margin-top:5px">Add Course</button>
                      </div><br><br>
                      <div class="error_sms"></div>
                    </form><br><br>


                    <?php 

                    $allCourses=displayAdminCourse();

                    if($allCourses=='not_lunch_course')
                    {
                      echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>The program is not launching any courses</p>";
                    }
                    

                    if(is_array($allCourses))
                    {
                    ?>

                     <table class="table table-bordered table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Program Name</th>
                                <th>Course Name</th>
                                <th>Duration</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Privacy</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="allCoursesTable">
                          <?php 
                             $i=1;

                            //check($allCourses);
                            foreach ($allCourses as $key => $value) 
                            {
                                if($value['c_status']=='publish')
                                {
                                    $status='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#6fd96f" title="Course is public. it will be visible on the website">Publish</span>';
                                }
                                else  if($value['c_status']=='c_private')
                                {
                                    $status='<span class="badge" data-toggle="tooltip" data-placement="top" style="background:#3067EF" title="Course is Private. it will not be visible to visitors">Course Private</span>';
                                }
                                else  if($value['c_status']=='p_private')
                                {
                                    $status='<span class="badge" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" style="background:#B4DF14" title="Program is private, the courses associated with the program will also be private">Program Private</span>';
                                }
                                echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.ucwords(htmlspecialchars($value['program'])).'</td>
                                <td>'.ucwords(htmlspecialchars($value['c_name'])).'</td>
                                <td>'.ucwords(htmlspecialchars($value['c_duration'])).'</td>
                                <td>'.htmlspecialchars($value['c_fee']).' PKR</td>
                                <td>'.$status.'</td>
                                <td>'.formatDate($value['created_at']).'</td>

                                <td><button type="button" courseID="'.$value['id'].'" programID="'.$value['p_id'].'" class="btn btn-primary editCourse" data-toggle="modal" data-target=".editCourseModel"><i class="glyphicon glyphicon-lock"></i></button></td>

                                <td><button type="button" courseID="'.$value['id'].'" programID="'.$value['p_id'].'" class="btn btn-primary editfees" data-toggle="modal" data-target=".editFeeModel"><i class="glyphicon glyphicon-edit"></i></button></td>

                                <td> <button type="button" data-toggle="modal" data-target=".delCourse" courseID="'.$value['id'].'" programID="'.$value['p_id'].'" class="btn btn-danger deleteCourse"><i class="glyphicon glyphicon-trash"></i></button></td>
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