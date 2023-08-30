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
    <title>Admin Panel | All Teachers</title>

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
                    <h1><i class="fa fa-users"></i> All Teacher <small>View All Teacher</small></h1><hr>
                    <ol class="breadcrumb">
                       
                      <li class="active"><i class="fa fa-users"></i> All Teacher</li>
                    </ol>
               
                    <form method="POST" action="#" class="search_friend_profile">
                      <div class="form-row">
                   
                         <div class="form-group col-md-4">
                          <label for="inputZip">Search Teacher</label>
                            <input type="text" class="form-control searchTeacherName" name="teacher" placeholder="Search Teacher Related Data" style="border-radius:3px; text-align:center;">
                        </div><br>

                        <button type="button" style="float:right" class="btn btn-primary" data-target='.addTeacher'  data-toggle="modal">Add New Teacher</button>
                      </div><br><br>
                      <div class="error_sms"></div>
                    </form><br><br>

                     <?php 

                    $allTeacher=getAllTeachers();


                    if($allTeacher=='zero_teacher')
                    {
                      echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>No teacher in the academy is empty.....!</p>";
                    }
                    

                    if(is_array($allTeacher))
                    {
                    ?>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Image</th>
                                <th>Teacher Name</th>
                                <th>Father Name</th>
                                <th>Gender</th>
                                <th>Salery</th>
                                <th>Pay Salery</th>
                                <th>Full Detail</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="allTeachersTable">

                            <?php 
                            $i=1;
                             foreach ($allTeacher as $key => $value) 
                             {
                                 echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><img src="../img/teacher_img/'.$value['t_image'].'" width="30px" class="profile-photo-md image_style" data-toggle="modal" data-target=".img_display"></td>

                                        <td>'.ucwords(htmlspecialchars($value['t_name'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['t_father'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['t_gender'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['t_salery'])).'</td>

                                         <td><button class="btn btn-success teacherPaySalery" teacherId="'.$value['t_id'].'" data-target=".paySalery" data-toggle="modal">Pay Salery</button></td>


                                        <td><button class="btn btn-success teacherProfile" teacherId="'.$value['t_id'].'" data-target=".viewTeacherProfile" data-toggle="modal">View Detail</button></td>

                                        <td><button type="button" data-target=".editTeacher" teacherId="'.$value['t_id'].'" data-toggle="modal" class="btn btn-primary editDataTeacher"><i class="glyphicon glyphicon-edit"></i></button></td>

                                        <td><button type="button" data-target=".delTeacher" data-toggle="modal" class="btn btn-danger deleteTeacher" teacherId="'.$value['t_id'].'"><i class="glyphicon glyphicon-trash"></i></button></td>
                                    </tr>';

                                $i++;
                             }
                            ?>
                            
                        </tbody>
                    </table>
                <?php 
                   }
                ?>
                </div>


            </div>
        </div>

    <?php include "include/footer.php"; ?>
  </body>
  
</html>