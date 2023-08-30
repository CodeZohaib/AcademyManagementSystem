<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/styles-merged.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/custom.css">
  </head>
  <body>

  
      <!-- Fixed navbar -->
      
      <?php include "include/navbar.php"; ?>

      <section class="probootstrap-section probootstrap-section-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              
                <div class="col-md-7 col-md-push-1  probootstrap-animate" id="probootstrap-content">
                  <h2>Login Admin</h2>
                  <p>Only Academy Admin Login</p>
                  <form action="login.php" method="post" class="probootstrap-form">

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="name" name="email" placeholder="Enter Your Email Address......!" required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password....!" required>
                    </div><br>

                    <div class="form-group">
                      <a href="" data-target='.forgortpassword'  data-toggle="modal">Forgot Password.?</a>
                    </div><br>
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" id="submit" name="adminLogin">Login</button>
                    </div>
                  </form>
                  <?php 
                      if(isset($_POST['adminLogin']))
                      {
                        $email=$_POST['email'];
                        $password=$_POST['password'];

                        $run=$con->prepare("SELECT * FROM `admin` WHERE email_address=? AND password=?");  

                        if(is_object($run))
                        {
                          $run->bindParam(1,$email,PDO::PARAM_STR);
                          $run->bindParam(2,$password,PDO::PARAM_STR);

                          if($run->execute())
                          {
                            if($run->rowCount()>0)
                            {

                              $adminData=$run->fetch(PDO::FETCH_ASSOC);

                              $_SESSION['adminLogin']=[
                                $adminData['id'],
                                $email,
                              ];

                              echo "<script>window.location.href = '/academy/admin/index.php';</script>";
                            }
                            else
                            {
                              echo '<div class="alert alert-danger text-center">Email And Password Wrong Try Again......!</div>';
                            }

                          }
                        }
                      }
                      ?>
                </div>
              </div>
            </div>
          </div>
       
      </section>
      
      <?php include "include/footer.php"; ?>    
  </body>
</html>

