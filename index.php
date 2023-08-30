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

      <section class="flexslider">
        <ul class="slides">
          <li style="background-image: url(img/slider_1.jpg);" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">BRIGHT AND VIBRANT SPACES</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li style="background-image: url(img/slider_2.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">EDUCATIONAL EXPERIENCE WHICH INSPIRES AND ENCOURAGES</h1>
                  </div>
                </div>
              </div>
            </div>
            
          </li>
          <li style="background-image: url(img/slider_3.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">DEVELOPING INDIVIDUAL INTERESTS AND PASSIONS</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li style="background-image: url(img/slider_4.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate"></h1>
                  </div>
                </div>
              </div>
            </div>
          </li>

           <li style="background-image: url(img/slider_5.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">WE GUIDE YOU WITH EASY PROCESS AND TRANSITION</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li style="background-image: url(img/slider_6.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">OPPORTUNITY TO PROGRESS AND PROSPER</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li style="background-image: url(img/slider_7.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">DEVELOPING INDIVIDUAL INTERESTS AND PASSIONS</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li style="background-image: url(img/slider_8.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">CONNECT AND GATHER FOR LONG - TERM VALUE</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>

        </ul>
      </section>

      <section class="probootstrap-section">
        <div class="container">
          <div class="row">
           <?php 
            $i=1;
            $html=[];
            $allCourses=displayAllCourse();

            //check($allCourses);
            if(is_array($allCourses))
            {
              foreach ($allCourses as $key => $value) 
              {

                if($i==5)
                {
                  break;
                }
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

                    $i++;
              }
            }
           ?>
          </div>
        </div>
      </section>

    
      
      <?php include "include/footer.php"; ?>

  </body>
</html>