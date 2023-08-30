<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Teachers</title>  
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/styles-merged.css">
    <link rel="stylesheet" href="css/style.min.css">
  </head>
  <body>

  
      <!-- Fixed navbar -->
      
      <?php include "include/navbar.php"; ?>
      
      
      <section class="probootstrap-section">
        <div class="container">
          <div class="row">

            <?php 

            $allTeacher=getAllTeachers();
            if($allTeacher=='zero_teacher')
            {
              echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>No teacher in the academy is empty.....!</p>";
            }
              

            if(is_array($allTeacher))
            {
              foreach ($allTeacher as $key => $value) 
              {
                echo '<div class="col-md-3 col-sm-6">
                  <div class="probootstrap-teacher text-center probootstrap-animate">
                    <figure class="media">
                       <a href="" class="teacherProfile"  data-target=".viewTeacherProfile"  data-toggle="modal" teacherId="'.$value['t_id'].'" >
                       <img src="img/teacher_img/'.$value['t_image'].'" style="width:100px;height:100px" class="img-responsive"></a>
                    </figure>
                    <div class="text">
                      <h3>'.ucwords(htmlspecialchars($value['t_name'])).'</h3>
                      <p>'.ucwords(htmlspecialchars($value['t_qualification'])).'</p>
                     
                    </div>
                  </div>
                </div>';
              }
            }
            ?>
          </div>
        </div>
      </section>
      
      <?php include "include/footer.php"; ?>

  
    <!-- END wrapper -->

    
    

    <script src="js/scripts.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>