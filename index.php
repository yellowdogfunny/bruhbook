<?php
  //session_start();
  include 'includes/db-inc.php';
  include 'includes/user-inc.php';
  $message = "";

  //ako je neko logiran, izbjegne se landing page
  if(isset($_SESSION['logged_user'])){
    //$message = "Login sucess - ".$_SESSION['logged_user'];
    header("Location: newsfeed.php"); //Ovo chengat na newsfeed.php
  }else{
    //header("Location: index.php");
  }

  if(empty($_POST['username']) || empty($_POST['password'])){
    //session_destroy();
    $message = "Username or password left empty!";

  }else{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();
    $user->login($username, $password);
    if(isset($_SESSION['logged_user'])){
      
      $message = "Login sucess - ".$_SESSION['logged_user'];
      header("refresh:0.25;url=newsfeed.php"); //Ovo chengat na newsfeed.php
    }else{
      $message = "Invalid username or password";
    }
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'includes/head_tag-inc.php'; ?>
    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">
    <title>Bruhbook</title>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">

        <!-- left container -->
        <div class="col-12 col-md-3 leftContainer">

          <!-- logo (responsive only) -->
          <div class="responsiveLogo">
              <img src="images/logo.jpg" class="" alt="">
              Bruhbook
          </div>

          <!-- Header -->
          <div class="leftContainerHeader">
            Login/register
          </div>

          <!--  Form -->
          <div class="logInContainer">
            <form class="" action="index.php" method="POST">
              <div class="form-group">
                <label for="usernameInput">Username</label>
                <input type="text" name="username" value="" class="form-control" id="usernameInput">
              </div>
              <br>

              <div class="form-group">
                <label for="usernameInput">Password</label>
                <input type="password" name="password" value="" class="form-control" id="passwordInput">
              </div>

              <br>
              <div class="loginWarning">
                <?php echo $message; ?>
              </div>
              <br>

              <div class="form-group">
                <input type="submit" name="login_button_input" value="Log in" class="btn btn-primary logInBtn">
              </div>

            </form>
          </div>

          <div class="createAcc">
            <div>Don't have an account yet?<br /> <a href="php/register.php" class="createAccLink">Click here to register!</a> </div>
          </div>
        </div>



        <!-- right container -->
        <div class="col-12 col-md-9 rightContainer">

          <!-- da big logo  -->
          <div class="bruhbookLogo_index">
            <div class="bbLogo">
              <img src="images/logo.jpg" class="" alt="">
            </div>
            <div class="bruhbookName_index">
              Bruhbook
            </div>
          </div>

          <!-- slogan -->
          <div class="slogan_index">
            Something something slogan idk
          </div>

          <!-- content -->
          <div class="content_index">
            <div class="row">
              <div class="col-12 col-md-4 imgBox justify-content-end">
                <img src="images/example_index_img.jpg" class="img-responsive img-thumbnail" alt="">
                <br>
                <div class="imgDesc">
                  Share moments
                </div>
              </div>
              <div class="col-12 col-md-4 imgBox ">
                <img src="images/example_index_img.jpg" class="img-responsive img-thumbnail" alt="">
                <br>
                <div class="imgDesc">
                  Exchange messages
                </div>
              </div>
              <div class="col-12 col-md-4 imgBox ">
                <img src="images/example_index_img.jpg" class="img-responsive img-thumbnail" alt="">
                <br>
                <div class="imgDesc">
                  Like and comment
                </div>
              </div>
            </div>
            
            <!-- footer -->
            <div class="index_footer">
              Bruhbook bruh - 2019
              <br>
              GitHub: <a href="#">github.com/qwehbrubruhqweqwe</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>


<?php

if(isset($_SESSION['logged_user'])){
  echo "
  <script>
    document.getElementById('usernameInput').disabled = true;
    document.getElementById('passwordInput').disabled = true;
  </script>";
}else{
  echo "
  <script>
    document.getElementById('usernameInput').disabled = false;
    document.getElementById('passwordInput').disabled = false;
  </script>";
}
?>