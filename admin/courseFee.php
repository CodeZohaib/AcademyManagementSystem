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
    <title>Admin Panel | Fee</title>

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
                    <h1><i class="fa fa-usd"></i> Student Fees <small>View All Fees</small></h1><hr>
                    <ol class="breadcrumb">
                       
                      <li class="active"><i class="fa fa-usd"></i> Student Fees</li>
                    </ol>
               
                    <form method="POST" action="#" class="search_friend_profile form-inline">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputZip">Search Fees</label><br>
                            <input type="text" class="form-control searchFeeStudent" placeholder="Search Enroll Student Fee" style="border-radius:3px;">
                        </div>
                     <br>

                      </div><br><br>

                    </form><br><br>
                    <?php 

                    $getAllFees=getEnrollStudentsFees();

                    if($getAllFees=='empty')
                    {
                      echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>There are no Fees Pay students.......!</p>";
                    }
                    

                    if(is_array($getAllFees))
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
                                    <th>Pay Fee</th>
                                    <th>Total Pay</th>
                                    <th>Remanining</th>
                                    <th>Fee Date</th>
                                </tr>
                            </thead>
                            <tbody class="feeStudentAllData">
                                 <?php 
                                $i=1;
                                foreach ($getAllFees as $key => $value) 
                                {
                                    echo '
                                    <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$value['roll_no'].'</td>
                                        <td>'.ucwords(htmlspecialchars($value['program'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['c_name'])).'</td>
                                         <td>'.ucwords(htmlspecialchars($value['name'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['father_name'])).'</td>
                                        <td>'.ucwords(htmlspecialchars($value['fee_pay'])).'</td>
                                         <td>'.ucwords(htmlspecialchars($value['pay_amount'])).'</td>
                                         <td>'.ucwords(htmlspecialchars($value['remaining_fee'])).'</td>
                                         <td>'.formatDate($value['fee_date']).'</td>
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