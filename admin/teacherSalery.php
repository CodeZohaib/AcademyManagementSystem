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
    <title>Admin Panel | Teacher Salery</title>

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
                    <h1><i class="fa fa-usd"></i> Teacher Salery <small>View All Salery</small></h1><hr>
                    <ol class="breadcrumb">
                       
                      <li class="active"><i class="fa fa-usd"></i> Teacher Salery</li>
                    </ol>
               
                     <form method="POST" action="#">
                      <div class="form-row">
                   
                        <div class="form-group col-md-4">
                          <label for="inputZip">Search Teacher Salery</label>
                            <input type="text" class="form-control searchTeacherSalery" name="courseName" placeholder="Search Teacher Salery Related Data" style="border-radius:3px; text-align:center;">
                        </div>
                      </div><br><br>
                      <div class="error_sms"></div>
                    </form><br><br>

                    <?php 

                    $getTeacherSalery=getTeacherSalery();

                    if($getTeacherSalery=='empty')
                    {
                      echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>There are no Salery Pay Teacher.......!</p>";
                    }
                    

                    if(is_array($getTeacherSalery))
                    {
                    ?>
                    
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No #</th>
                                <th>Teacher Name</th>
                                <th>Father Name</th>
                                <th>Salery</th>
                                <th>Pay Date</th>
                                
                            </tr>
                        </thead>
                        <tbody class="dataTeacherSalery">
                             <?php 
                                $i=1;
                                foreach ($getTeacherSalery as $key => $value) 
                                {
                            
                                    echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td>'.ucwords(htmlspecialchars($value['t_name'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['t_father'])).'</td>
                                        <td>'.$value['salery'].'</td>
                                        <td>'.formatDate($value['salery_date']).'</td>
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