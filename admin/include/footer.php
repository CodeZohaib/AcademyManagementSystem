    <div id="footer" class="text-center">
        Copyright &copy; by <a href="#">Ihtiram Ullah</a> 2023
    </div>

</div>

<div class="modal fade addCourse" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content ">

      <div class="modal-header">
         <a href="" data-dismiss="modal" class="close">X</a>
        <h3><i class="fa fa-book"></i>Add Course</h3>

      </div>

      <div class="modal-body all_info_user">
       <b>Name</b><br><br>
       <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form">
       <input type="text" name="courseName" maxlength="19" placeholder="Enter Course Name.....!" class="form-control" required><br>

       <b>Select Program</b><br>
       <select name="programID" class="form-control" required>
         <option>Select Program</option>
          <?php 
          $program=getAllProgram();
          if($program!=null AND !empty($program) AND is_array($program))
          {
            foreach ($program as $key => $value) 
            {
              if($value['status']=='private')
              {
                continue;
              }
              
              echo "<option value='".$value['id']."'>".ucwords(htmlspecialchars($value['program']))."</option>";
            }
          }
          else
          {
            echo "<option>Not Lunch Any Course</option>";
          }
        ?> 
       </select>
       <br>

       <b>Fee</b><br>
       <input type="number" name="fee" placeholder="Enter Course Fee.....!" class="form-control" required><br>

       <b>Duration</b><br>
       <input type="text" name="duration" placeholder="Enter Course Duration.....!" class="form-control" required><br>

       <b>Description</b><br>
       <textarea rows="5" cols="3" minlength="300" name="description" placeholder="Enter Course Description.....!" class="form-control" required></textarea><br>

       <b>Upload Image</b><br>
       <input type="file" name="image" class="form-control" required><br>

       <button type="submit" class="btn btn-success">Add Course</button>
       <p class="passwordError"></p>
     </form>
       </div>
           
        <div class="modal-footer bg-warning">
          <button class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>


  </div>
</div>

<div class="modal fade addProgram" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content ">

      <div class="modal-header">
         <a href="" data-dismiss="modal" class="close">X</a>
        <h3><i class="fa fa-book"></i>Add Program</h3>

      </div>

      <div class="modal-body all_info_user">
       <b>Program Name</b><br><br>
       <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form">
         <input type="text" name="addNewProgram" placeholder="Enter Program Name.....!" class="form-control" required><br>

         <input type="submit" name="addProgram" class="btn btn-success" value="Add Program">
       </form>

       <p class="passwordError"></p>
       </div>
           
        <div class="modal-footer bg-warning">
          <button class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>


  </div>
</div>


<div class="modal fade editProgramModel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content ">

      <div class="modal-header">
         <a href="" data-dismiss="modal" class="close">X</a>
        <h3><i class="glyphicon glyphicon-lock"></i> Change Privacy Program</h3>

      </div>

      <div class="modal-body all_info_user">
        <p>Before you proceed with Change Privacy the program, please note that all courses associated with this program will also be Change. Are you sure you want to proceed with the Changing.?</p><br>

       <b>Change Program Privacy</b><br><br>
       <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form formProgram">
          <select name="changeProgramPrivacy" class="form-control">
               <option value="">Select Option</option>
               <option value="private">Private</option>
               <option value="publish">Publish</option> 
           </select><br>

         <center><input type="submit" name="changePrivacy" class="btn btn-success" value="Yes">
         <button class="btn btn-danger" data-dismiss="modal">No</button></center>
       </form>

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
         <form action="/academy/files/ajaxRequest.php" method="post" class="form">

          <input type="text" name="adminRequest" value="adminRequest" hidden>

          <b>Select Program</b><br>
           <select class="form-control shiftProgram" name="programID" required>
              <option value="">Select Program</option>
              <?php 
              $program=getAllProgram(); 
                if($program!=null AND !empty($program) AND is_array($program))
                {
                  foreach ($program as $key => $value) 
                  {
                    if($value['status']=='private')
                    {
                      continue;
                    }
                    
                    echo "<option value='".$value['id']."'>".ucwords(htmlspecialchars($value['program']))."</option>";
                  }
                }
                else
                {
                  echo "<option style='color:white'>Not Lunch Any Course</option>";
                }
              ?>
           </select>
           <br>

           <b>Select Course</b><br>
           <select class="form-control allCourseProgram" name="courseID" required>
               <option value="">Select Course</option>
           </select>
           <br>

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
              <input type="date" name="dob" class="form-control">
            </div>

            <div class="form-group">
              <label for="name">Gender</label><br>
                &nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" name="gender" value="male">
                  &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio" name="gender" value="female">
            </div>

             <div class="form-group">
              <label for="address">Email Address</label>
              <input type="email" name="email_address" class="form-control" placeholder="Enter Email Address....!">
            </div>


             <div class="form-group">
              <label for="address">Address</label>
              <input type="text" name="current_address" class="form-control" placeholder="Enter Current Address....!">
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
          <button type="submit" class="btn btn-primary">Enroll Now</button>
        </div>
          </form>
        </div>

        <div class="modal-footer">
          
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


  <div class="modal fade checkStudentProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ">

        <div class="modal-header">
           <a href="" data-dismiss="modal" class="close">X</a>
          <h3><i class="fa fa-users"></i> Student Detail</h3>

        </div>

        <div class="modal-body">
          
          <div class="studentProfileData">
            
          </div>

         <p class="passwordError"></p>
         </div>
             
          <div class="modal-footer bg-warning">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>

    </div>
</div>

<div class="modal fade addTeacher" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content ">

      <div class="modal-header">
         <a href="" data-dismiss="modal" class="close">X</a>
        <h3><i class="fa fa-user"></i> Add New Teacher</h3>

      </div>

      <div class="modal-body all_info_user">
      <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form">
       <b>Name</b><br>
       <input type="text" name="t_name" placeholder="Enter Name.....!" class="form-control"><br>

       <b>Father</b><br>
       <input type="text" name="t_fatherName" placeholder="Enter Father Name.....!" class="form-control"><br>

        <label for="name">Gender</label><br>
        &nbsp;&nbsp;<span style="font-size:18px">Male</span> <input type="radio" name="t_gender" value="male">
        &nbsp;&nbsp;<span style="font-size:18px">Female</span> <input type="radio" name="t_gender" value="female"><br><br>

        <b>Qualification</b><br>
        <input type="text" name="t_qualification" placeholder="Enter Qualification.....!" class="form-control"><br>

        <b>Email Address</b><br>
        <input type="email" name="t_email" placeholder="Enter Email Address.....!" class="form-control"><br>

        <b>Phone Number</b><br>
        <input type="tel" name="t_phoneNumber" placeholder="Enter Phone Number.....!" class="form-control"><br>

       <b>Salery</b><br>
       <input type="number" name="t_salery" placeholder="Enter Salery.....!" class="form-control"><br>

       <b>Bio</b><br>
       <textarea rows="5" cols="3"  name="t_bio" placeholder="Enter About Teacher.....!" class="form-control" required></textarea><br>

       <b>Upload Image</b><br>
       <input type="file" name="image"  class="form-control"><br>

       <input type="submit" class="btn btn-success" name="addTeacher">
       <p class="passwordError"></p>
     </form><br>
         <button class="btn btn-danger" style="float:right;" data-dismiss="modal">Close</button><br>
       </div>
           
        <div class="modal-footer bg-warning">
          
        </div>
      </div>
  </div>
</div>

 <div class="modal fade my-modal paySalery" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title" style='color:yellow;'>Pay Salery</h4>
        </div>

        <div class="modal-body  bg-warning">
          <h4 class='text-info'>Are You Sure You Want to Pay Salery.?</h4>
          <input type="text" name="salary" id="dectect" placeholder="Enter Amount to Dectect Salery...." class="form-control"><br>
           <div class="text-center">
             <button type="button" class="btn btn-success btn-sm yesPaySalery">Yes</button>
             <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
            </div>
        </div>
       

        <div class="modal-footer paySalery_error">
          
        </div>
    </div>
   </div>
 </div>


 <div class="modal fade my-modal courseDecision" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title" style='color:white;'><span class="glyphicon glyphicon-book"></span> Course Decision</h4>
        </div>

        <div class="modal-body  bg-warning">
          <h4 class='text-info'>Mark it as completed by pressing the 'Complete' button. If you decide not to complete the course, you can press the 'Discontinue' button.</h4>

           <div class="text-center">
             <button type="button" class="btn btn-success btn-sm yesCompleteCourse">Complete</button>
             <button type="button" class="btn btn-danger btn-sm yesDiscontinueCourse" >Discontinue</button>
            </div>
        </div>
       

        <div class="modal-footer courseDecision_error">
          
        </div>
    </div>
   </div>
 </div>

  <div class="modal fade my-modal payfeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title" style='color:white;'><span class="glyphicon glyphicon-usd"></span> Pay Fees</h4>
        </div>

        <div class="modal-body  bg-warning">
          <center class='totalCalculation'></center>
          <div class="payfeeBody">
            
            <h4 class='text-info'>Pay Amount</h4>
            <input type="number" name="payfee" id="payfee" class="form-control" placeholder="Enter Pay Amount....!"><br>

             <div class="text-center">
               <button type="button" class="btn btn-success btn-sm yesAmountPayCourse">Pay Now</button>
               <button type="button" class="btn btn-danger btn-sm"  class="close" data-dismiss="modal" >Cancle</button>
              </div>
            </div>
        </div>
       

        <div class="modal-footer payAmout_error">
          
        </div>
    </div>
   </div>
 </div>

<div class="modal fade addNewShift" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">

        <div class="modal-content ">

          <div class="modal-header">
             <a href="" data-dismiss="modal" class="close">X</a>
            <h3><i class="fa fa-book"></i>Add New Shift</h3>

          </div>

          <div class="modal-body">
          <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form">
           <b>Select Program</b><br>
           <select class="form-control shiftProgram" name="p_id" required>
              <option value="">Select Program</option>
              <?php 
              $program=getAllProgram(); 
                if($program!=null AND !empty($program) AND is_array($program))
                {
                  foreach ($program as $key => $value) 
                  {
                    if($value['status']=='private')
                    {
                      continue;
                    }
                    
                    echo "<option value='".$value['id']."'>".ucwords(htmlspecialchars($value['program']))."</option>";
                  }
                }
                else
                {
                  echo "<option style='color:white'>Not Lunch Any Course</option>";
                }
              ?>
           </select>
           <br>

           <b>Select Course</b><br>
           <select class="form-control allCourseProgram" name="c_id" required>
               <option value="">Select Course</option>
           </select>
           <br>

           <b>Select Teacher</b><br>
           <select class="form-control" name="t_id" required>
            <option value="">Select Teacher</option>
              <?php 
                $allTeacher=getAllTeachers(); 

                if($allTeacher!=null AND !empty($allTeacher) AND is_array($allTeacher))
                {
                  foreach ($allTeacher as $key => $t_value) 
                  {
                    echo "<option value='".$t_value['t_id']."'>".ucwords(htmlspecialchars($t_value['t_name']))." S/O (".ucwords(htmlspecialchars($t_value['t_father'])).")</option>";
                  }

                }
                else
                {
                  echo "<option style='color:white'>Not Available Teacher</option>";
                }
              ?>
               
           </select>
           <br>

           <label for="Shifts">Start Time</label><br>
           <input type="time" name="startTime" class="form-control" required><br>

           <label for="Shifts">End Time</label><br>
           <input type="time" name="endTime" class="form-control" required><br>

           
           <button type="submit" class="btn btn-success">Add Shift</button>
         </form><br>
         <button class="btn btn-danger" style="float:right;" data-dismiss="modal">Close</button><br><br><br>
          <p class="passwordError"></p>
           </div>

          
               
            <div class="modal-footer bg-warning">
              
            </div>
          </div>
      </div>
</div>

<div class="modal fade editShift" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">

        <div class="modal-content ">

          <div class="modal-header">
             <a href="" data-dismiss="modal" class="close">X</a>
            <h3><i class="fa fa-edit"></i> Edit Shift</h3>

          </div>

          <div class="modal-body">
          <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form shiftEditForm">
           <b>Select Teacher</b><br>
           <select class="form-control" name="updateTeacherId">
            <option value="">Select Teacher</option>
              <?php 
                $allTeacher=getAllTeachers(); 

                if($allTeacher!=null AND !empty($allTeacher) AND is_array($allTeacher))
                {
                  foreach ($allTeacher as $key => $t_value) 
                  {
                    echo "<option value='".$t_value['t_id']."'>".ucwords(htmlspecialchars($t_value['t_name']))." S/O (".ucwords(htmlspecialchars($t_value['t_father'])).")</option>";
                  }

                }
                else
                {
                  echo "<option style='color:white'>Not Available Teacher</option>";
                }
              ?>
               
           </select>
           <br>

           <label for="Shifts">Start Time</label><br>
           <input type="time" name="updateStartTime" class="form-control"><br>

           <label for="Shifts">End Time</label><br>
           <input type="time" name="updateEndTime" class="form-control"><br>

           
           <button type="submit" class="btn btn-success">Edit Shift</button>
         </form><br>
         <button class="btn btn-danger" style="float:right;" data-dismiss="modal">Close</button><br><br><br>
          <p class="passwordError"></p>
           </div>

          
               
            <div class="modal-footer bg-warning">
              
            </div>
          </div>
      </div>
</div>



<div class="modal fade my-modal logout" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title">Logout ID</h4>
        </div>

        <div class="modal-body bg-warning">
          <p><strong>Are You Sure You Want To Logout ID.?</p>
        </div>
      
       <div class="modal-footer text-center">
         <button type="button" class="btn btn-success btn-sm idLogOut">Yes</button>
         <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
       </div>
    </div>
   </div>
 </div>


 <div class="modal fade my-modal delProgram" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Program</h4>
        </div>

      <div class="modal-body bg-warning">
          <p><strong>Before you proceed with deleting the program, please note that all courses associated with this program will also be deleted. Are you sure you want to proceed with the deletion?</p>
        </div>
      
       <div class="modal-footer">
         <div class="text-center">
           <button type="button" class="btn btn-success btn-sm yesDeleteProgram">Yes</button>
         <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
         </div><br>
         

         <div class="delError"></div>
       </div>
    </div>
   </div>
 </div>


 <div class="modal fade my-modal studentAccept" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      <div class="modal-header"><br>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Student Enrollment Accept</h4>
      </div>

      <div class="modal-body bg-warning">
            <div class="pendingStudentData">
              
            </div>
      </div>
      
       <div class="modal-footer">
         
         

         <div class="delError"></div>
       </div>
    </div>
   </div>
 </div>


<div class="modal fade my-modal delShift" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Shift</h4>
        </div>

      <div class="modal-body bg-warning">
          <p><strong>Are you sure you want to proceed with the deletion?</p>
        </div>
      
       <div class="modal-footer">
         <div class="text-center">
           <button type="button" class="btn btn-success btn-sm yesDeleteShift">Yes</button>
         <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
         </div><br>
         

         <div class="delError"></div>
       </div>
    </div>
   </div>
 </div>

 <div class="modal fade my-modal studentReject" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-remove"></i> Reject Enrollment</h4>
        </div>

      <div class="modal-body bg-warning">
          <p><strong>Are you sure you want to proceed with the Rejection?</p>
        </div>
      
       <div class="modal-footer">
         <div class="text-center">
           <button type="button" class="btn btn-success btn-sm yesRejectStudent">Yes</button>
         <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
         </div><br>
         

         <div class="delError"></div>
       </div>
    </div>
   </div>
 </div>


  <div class="modal fade my-modal editFeeModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Change Course Fees</h4>
        </div>

      <div class="modal-body bg-warning">
          <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form editFeesForm">
          <p><strong>New Course Fees</p></strong>
            <input type="number" name="newFees" placeholder="Enter New Fees.....!" class="form-control"><br>
          <br>
          <div class="text-center">
           <input type="submit" class="btn btn-success btn-sm" value="Change">
           <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
         </div><br>
         </form>
        </div>
      
       <div class="modal-footer delError">
         
       </div>
    </div>
   </div>
 </div>


 <div class="modal fade my-modal delTeacher" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Teacher</h4>
        </div>

      <div class="modal-body bg-warning">
          <p><strong>Are you sure you want to proceed with the deletion?</p>
        </div>
      
       <div class="modal-footer">
         <div class="text-center">
           <button type="button" class="btn btn-success btn-sm yesDeleteTeacher">Yes</button>
         <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
         </div><br>
         

         <div class="delError"></div>
       </div>
    </div>
   </div>
 </div>


  <div class="modal fade my-modal delCourse" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header"><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Course</h4>
        </div>

      <div class="modal-body bg-warning">
          <p><strong>Are you sure you want to proceed with the deletion?</p>
        </div>
      
       <div class="modal-footer">
         <div class="text-center">
           <button type="button" class="btn btn-success btn-sm yesDeleteCourse">Yes</button>
         <button type="close" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
         </div><br>
         

         <div class="delError"></div>
       </div>
    </div>
   </div>
 </div>


 <div class="modal fade editCourseModel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content ">

      <div class="modal-header">
         <a href="" data-dismiss="modal" class="close">X</a>
        <h3><i class="glyphicon glyphicon-lock"></i> Change Privacy Course</h3>

      </div>

      <div class="modal-body all_info_user">
        <p>Are you sure you want to proceed with the Changing Privacy.?</p><br>

       <b>Change Course Privacy</b><br><br>
       <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form formCourse">
          <select name="changeCoursePrivacy" class="form-control">
               <option value="">Select Option</option>
               <option value="c_private">Private</option>
               <option value="publish">Publish</option> 
           </select><br>

         <center><input type="submit" name="changePrivacy" class="btn btn-success" value="Change">
         <button class="btn btn-danger" data-dismiss="modal">No</button></center>
       </form>

       <p class="passwordError"></p>
       </div>
           
        <div class="modal-footer bg-warning">
          
        </div>
      </div>


  </div>
</div>

<div class="modal fade editTeacher" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content ">

      <div class="modal-header">
         <a href="" data-dismiss="modal" class="close">X</a>
        <h3><i class="fa fa-user"></i> Edit Profile Teacher</h3>

      </div>

      <div class="modal-body">
         <form action="/academy/admin/files/ajaxRequest.php" method="post" class="form editProfileTeacher">
         </form>
       <br>
         <button class="btn btn-danger" style="float:right;" data-dismiss="modal">Close</button><br>
       </div>
           
        <div class="modal-footer bg-warning">
          
        </div>
      </div>
  </div>
</div>

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

<div class="modal fade my-modal pendingUserEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
      <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> User Edit</h4>
    </div>

    <div class="modal-body">
      <form method="POST" action="/academy/admin/files/ajaxRequest.php" class="form editPendingUserForm">
      </form>
    </div>

    <div class="modal-footer">
      <p class="passwordError"></p>
    </div>
  </div>
  </div>
</div>


 <div class="modal fade passwordChangeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ">

        <div class="modal-header">
           <a href="" data-dismiss="modal" class="close">X</a>
          <h3><i class="fa fa-users"></i> Change Password</h3>

        </div>

        <div class="modal-body">
          <b>Old Password</b><br>
          <input type="password" id="old_pass" name="old_pass" class="form-control" placeholder="Enter Old Password......!" required><br>
           <b>New Password</b><br>
          <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Enter New Password......!" required><br>

           <b>Confirm Password</b><br>
          <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Enter Confirm Password......!" required><br>
          <button type="button" id="btnChangePassword" class="btn btn-success">Change</button><br><br>

         <p class="passwordError"></p>
         </div>
             
          <div class="modal-footer bg-warning">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>

    </div>
  </div>


<script type='text/javascript' src='admin/js/jquery.js'></script>
<script type='text/javascript' src='admin/js/bootstrap.min.js'></script>
<script type='text/javascript' src='admin/js/custom.js'></script>