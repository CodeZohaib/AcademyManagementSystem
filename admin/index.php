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
    <title>Admin Panel | All Program</title>

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
                    <h1><i class="glyphicon glyphicon-book"></i> All Program <small>View All Program</small></h1><hr>
                    <ol class="breadcrumb">
                       
                      <li class="active"><i class="glyphicon glyphicon-book"></i> All Program</li>
                    </ol>
               
                    
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputZip">Search Program</label>
                          
                                <input type="text" class="form-control searchProgramName" placeholder="Search Program Related Data" style="border-radius:3px; text-align:center;" autocomplete="off">
                          
                        </div><br>

                        <button type="button" style="float:right;" class="btn btn-primary" data-target='.addProgram'  data-toggle="modal"  style="margin-top:5px">Add Program</button>
                      </div><br><br>
                      <div class="error_sms"></div>
                     <br><br>

                    <?php 

                    $program=getAllProgram();
                    $error=null;
                    if($program!=null AND !empty($program) AND is_array($program) OR isset($_POST['programName']))
                    {

                        ?>
                         <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Program Name</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Privacy</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="allProgramTable">

                            <?php 
                              $i=0;

                              foreach ($program as $key => $value) 
                              {

                                $i++;

                                if($value['status']=='publish')
                                {
                                    $status='<span class="badge"  style="background:#6fd96f">'.ucwords(htmlspecialchars($value['status'])).'</span>';
                                }
                                else  if($value['status']=='private')
                                {
                                    $status='<span class="badge" data-toggle="tooltip" data-placement="top" title="Program is private, the courses associated with the program will also be private" style="background:#3067EF">'.ucwords(htmlspecialchars($value['status'])).'</span> ';
                                }

                                echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords(htmlspecialchars($value['program'])).'</td>
                                    <td>'.$status.'</td>
                                    <td>'.formatDate($value['created_at']).'</td>
                                    <td><button type="button" data-target=".editProgramModel"  data-toggle="modal" class="btn btn-primary editProgram" programID="'.$value['id'].'"><i class="glyphicon glyphicon-lock"></i></button></td>
                                    <td><button type="button" data-target=".delProgram"  data-toggle="modal" class="btn btn-danger deleteProgram" programID="'.$value['id'].'"><i class="glyphicon glyphicon-trash"></i></button></td>
                                </tr>';
                              }

                            ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    else
                    {
                        echo "<div class='alert alert-danger text-center'>Not Lunch Any Course</li>";
                    }

                    ?>
                   
                </div>


            </div>


        </div>



        <?php include "include/footer.php"; ?>
    

  </body>
</html>