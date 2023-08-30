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
    <title>Admin Panel | Time Slote </title>

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
                    <h1><i class="glyphicon glyphicon-time"></i> All Classes Timing <small>View All Classes Timing</small></h1><hr>
                    <ol class="breadcrumb">
                      <li class="active"><i class="glyphicon glyphicon-time"></i> Time Solte</li>
                    </ol>
               
                    <form method="POST" action="#" class="search_friend_profile">
                      <div class="form-row">
                   
                        <div class="form-group col-md-4">
                          <label for="inputZip">Search Class</label>
                            <input type="text" class="form-control searchTimeSlote" name="programName" placeholder="Search Class Related Data" style="border-radius:3px; text-align:center;">
                        </div><br>

                        <button type="button" class="btn btn-primary" data-target='.addNewShift'  data-toggle="modal"  style="float: right;">Add New Shift</button>
                      </div><br><br>
                      <div class="error_sms"></div>
                    </form><br><br>

                     <?php 

                        $allTiming=getAllTimeSlote();

                        if($allTiming=='empty')
                        {
                          echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>No time slots have been added.....!</p>";
                        }
                        

                        if(is_array($allTiming))
                        {
                        ?>


                     <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Program Name</th>
                                <th>Course Name</th>
                                <th>Teacher Name</th>
                                <th>Shift</th>
                                <th>Timing</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                         <tbody class="timeSloteAllData">
                            <?php 
                              $i=1;
                              foreach ($allTiming as $key => $value) 
                              {
                                echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords(htmlspecialchars($value['program'])).'</td>
                                    <td>'.ucwords(htmlspecialchars($value['c_name'])).'</td>
                                    <td><a href="#"  class="teacherProfile" teacherId="'.$value['t_id'].'" data-target=".viewTeacherProfile" data-toggle="modal">'.ucwords(htmlspecialchars($value['t_name'])).'</a></td>
                                    <td>'.ucwords(htmlspecialchars($value['ct_shift'])).'</td>
                                    <td>'.htmlspecialchars($value['start_time']).' <b>TO</b> '.htmlspecialchars($value['end_time']).'</td>
                                    <td>'.formatDate($value['ct_created_at']).'</td>
                                    <td><button type="button" data-toggle="modal" data-target=".editShift" class="btn btn-primary editTimeSlote" ca_id='.$value['ca_id'].' p_id='.$value['p_id'].' c_id='.$value['c_id'].' t_id='.$value['t_id'].'><i class="glyphicon glyphicon-edit"></i></button></td>

                                    <td> <button type="button" data-target=".delShift" data-toggle="modal" class="btn btn-danger deleteShift" ca_id='.$value['ca_id'].' p_id='.$value['p_id'].' c_id='.$value['c_id'].' t_id='.$value['t_id'].'><i class="glyphicon glyphicon-trash"></i></button></td>
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