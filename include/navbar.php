    <?php 

      include 'files/function.php'; 
      $program=getAllProgram();
      ?>

    <div class="probootstrap-page-wrapper">
      <div class="probootstrap-header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
              <span><i class="icon-location2"></i>Wattar Wallai Ziarat Kaka Sahib Road, Nowshera, KP</span>
              <span><i class="icon-phone2"></i>+92-923-210641-2</span>
              <span><i class="icon-mail"></i>khanAcademy@gmail.com</span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
              <ul>
                <li><a href="#"><i class="icon-twitter"></i></a></li>
                <li><a href="#"><i class="icon-facebook2"></i></a></li>
                <li><a href="#"><i class="icon-instagram2"></i></a></li>
                <li><a href="#"><i class="icon-youtube"></i></a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>

     <nav class="navbar navbar-default probootstrap-navbar">
        <div class="container">
          <div class="navbar-header">
            <div class="btn-more js-btn-more visible-xs">
              <a href="#"><i class="icon-dots-three-vertical "></i></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Khan Academy</a>
          </div>

          <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php">Home</a></li>
              <li><a href="teachers.php">Teachers</a></li>
               <li class="dropdown">
               <a href="#" data-toggle="dropdown" class="dropdown-toggle">Course Program</a>
                <ul class="dropdown-menu">
                  <?php 
                    if($program!=null AND !empty($program) AND is_array($program))
                    {
                      foreach ($program as $key => $value) 
                      {
                        if($value['status']=='private')
                        {
                          continue;
                        }
                        
                        echo "<li><a href='program.php?program=".$value['id']."'>".ucwords(htmlspecialchars($value['program']))."</a></li>";
                      }
                    }
                    else
                    {
                      echo "<li style='color:white'>Not Lunch Any Course</li>";
                    }
                  ?> 
                </ul>
              </li>

              <li><a href="allCourses.php">All Courses</a></li>

              <?php 
              if(isset($_SESSION['adminLogin'][0]) AND isset($_SESSION['adminLogin'][1]))
              {
                  if(!empty($_SESSION['adminLogin'][0]) AND !empty($_SESSION['adminLogin'][1]))
                  {
                    echo '<li><a href="/academy/admin/index.php">Dashboard</a></li>';
                  }
                  else
                  {
                    echo '<li><a href="login.php">Admin Login</a></li>';
                  }
                }
                else
                {
                  echo '<li><a href="login.php">Admin Login</a></li>';
                }
              ?>
              
            </ul>
          </div>

        </div>
      </nav>