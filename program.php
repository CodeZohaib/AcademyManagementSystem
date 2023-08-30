<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Courses</title>
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
            if(isset($_GET['program']))
            {
              $i=1;
              $html=[];
              $allCourses=displayAllCourse($_GET['program']);

              if($allCourses=='not_lunch_course')
              {
                echo "<p class='alert alert-danger text-center alert-dismissable'><a href='#'' class='close' data-dismiss='alert'>&times;</a>The program is not launching any courses</p>";
              }
              else if(is_array($allCourses))
              {
                foreach ($allCourses as $key => $value) 
                {
                  $words = explode(" ", $value['c_description']);
                  $words = array_slice($words, 0, 25);
                  $description=implode(" ", $words);
                  echo '<div class="col-md-6">
                        <div class="probootstrap-service-2 probootstrap-animate">
                          <div class="image">
                            <div class="image-bg">
                              <img src="img/course_img/'.$value['c_image'].'">
                            </div>
                          </div>

                          <div class="text">
                            <span class="probootstrap-meta"><i class="icon-calendar2"></i> '.formatDate($value['created_at']).'</span><br>
                          <span class="badge" style="background:#6fd96f">'.ucwords(htmlspecialchars($value['program'])).'</span>
                            <h3>'.ucwords(htmlspecialchars($value['c_name'])).'</h3>
                            <p>'.$description.'</p>
                            <p><a href="" p_id='.$value['p_id'].' c_id='.$value['id'].' data-target=".courseEnroll" class="btn btn-primary applyCourse"  data-toggle="modal" >Enroll</a> 

                          <a href="" c_id='.$value['id'].' class="btn btn-info detailCourse" data-target=".viewCourseDetail"  data-toggle="modal" >Detail</a> </p></p>
                          </div>
                        </div>
                      </div>';
                }
              }
              else
              {
                header('location:allCourses');
              }
            }
           ?>
          </div>

          
        </div>
      </section>

    
      
      <?php include "include/footer.php"; ?>
    <!-- END wrapper -->

  </body>
</html>