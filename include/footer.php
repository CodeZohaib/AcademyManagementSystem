 <section class="probootstrap-cta">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">Get your admission now!</h2>
              <a href="allCourses.php" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate" data-animate-effect="fadeInLeft">Enroll</a>
            </div>
          </div>
        </div>
      </section>
      <footer class="probootstrap-footer probootstrap-bg">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="probootstrap-footer-widget">
                <h3>About The Academy</h3>
                <p>Khan Academy is a leading online educational platform that offers a diverse array of courses for learners of all ages and levels. Our courses cover a wide range of subjects, including math, science, computer programming, history, economics, and more. Our expert instructors use innovative teaching methods to help learners master new skills and concepts in an engaging and interactive way
                </p>
                <h3>Social</h3>
                <ul class="probootstrap-footer-social">
                  <li><a href="#"><i class="icon-twitter"></i></a></li>
                  <li><a href="#"><i class="icon-facebook"></i></a></li>
                  <li><a href="#"><i class="icon-github"></i></a></li>
                  <li><a href="#"><i class="icon-dribbble"></i></a></li>
                  <li><a href="#"><i class="icon-linkedin"></i></a></li>
                  <li><a href="#"><i class="icon-youtube"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-md-push-1">
              <div class="probootstrap-footer-widget">
                <h3>Links</h3>
                <ul>
                  <li><a href="index.html">Courses</a></li>
                  <li><a href="teachers.html">Teachers</a></li>
                  <li><a href="login.html">Admin Login</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="probootstrap-footer-widget">
                <h3>Contact Info</h3>
                <ul class="probootstrap-contact-info">
                  <li><i class="icon-location2"></i> <span>Wattar Wallai Ziarat Kaka Sahib Road, Nowshera, KP</span></li>
                  <li><i class="icon-mail"></i><span>khanAcademy@gmail.com</span></li>
                  <li><i class="icon-phone2"></i><span>+92-923-210641-2</span></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- END row -->
          
        </div>

        <div class="probootstrap-copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-8 text-left">
                <p>&copy; 2023 All Rights Reserved Designed &amp; Developed with Ihtiram Ullah</p>
              </div>
              <div class="col-md-4 probootstrap-back-to-top">
                <p><a href="#" class="js-backtotop">Back to top <i class="icon-arrow-long-up"></i></a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
    <!-- END wrapper -->
    <div class="modal fade viewCourseDetail" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">

        <div class="modal-content">

          <div class="modal-header">
             <a href="" data-dismiss="modal" class="close">X</a>
            <h3><i class="fa fa-book"></i> Course Detail</h3>

          </div>

          <div class="modal-body ajaxCourseDetail">
           
           <p class="passwordError"></p>
           </div>
               
            <div class="modal-footer bg-warning">
              <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
   

      </div>
    </div>
     <!--Enrollment form-->
       <div class="modal fade my-modal courseEnroll" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
              <h4 class="modal-title"> Online Course Enrollment</h4>
            </div>

            <div class="modal-body">
              <form method="POST" action="/academy/files/ajaxRequest.php" class="form applyCourseForm">

                <div class="form-group">
                  <label for="name">Full Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Name.....!">
                </div>

                <div class="form-group">
                  <label for="name">Father Name</label>
                  <input type="text" name="fatherName" class="form-control" placeholder="Enter Father Name.....!">
                </div>

                <div class="form-group">
                  <label for="email">DOB</label>
                  <input type="date" name="dob" class="form-control" min="1950-01-01" max="2006-12-31">
                </div>

                <div class="form-group">
                  <label for="name">Gender</label><br>
                    &nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" name="gender" value="male">
                      &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio" name="gender" value="female">
                </div>


                 <div class="form-group">
                  <label for="address">Current Address</label>
                  <input type="text" name="current_address" class="form-control" placeholder="Enter Current Address....!">
                </div>

                <div class="form-group">
                  <label for="address">Email Address</label>
                  <input type="email" name="email_address" class="form-control" placeholder="Enter Email Address....!">
                </div>

               
                 <div class="form-group">
                  <label for="address">Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number....!">
                </div>

                <div class="form-group">
                  <label for="Shifts">Shifts</label><br>
                    &nbsp;&nbsp;<span style="font-size:18px">Morning</span> <input type="radio" name="shift" value="Morning">
                      &nbsp;&nbsp;<span style="font-size:18px">Evening</span> <input type="radio" name="shift" value="Evening">
                </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Enroll Now">
            </div>
              </form>
            </div>

            <div class="modal-footer">
              <p class="passwordError"></p>
            </div>
          </div>
        </div>
       </div>
   <!--Enrollment form-->



    <div class="modal fade viewTeacherProfile" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content ">

          <div class="modal-header">
             <a href="" data-dismiss="modal" class="close">X</a>
            <h3><i class="fa fa-users"></i>Teacher Detail</h3>

          </div>

          <div class="modal-body">
            
            <div class="teacherProfileData">
              
            </div>

           <p class="passwordError"></p>
           </div>
               
            <div class="modal-footer bg-warning">
              <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>

      </div>
       </div>

 <div class="modal fade forgortpassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ">

        <div class="modal-header">
           <a href="" data-dismiss="modal" class="close">X</a>
          <h3><i class="fa fa-users"></i>Forgot Password</h3>

        </div>

        <div class="modal-body">
          <b>Email Address</b><br>
          <input type="email" id="forgotPasswordVal" name="email_address" class="form-control" placeholder="Enter Your Email Address......!"><br>
          <button type="button" id="btnforgotPassword" class="btn btn-success">Submit</button><br><br>

         <p class="passwordError"></p>
         </div>
             
          <div class="modal-footer bg-warning">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>

    </div>
  </div>


    <script src="js/scripts.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="js/custom.js"></script>