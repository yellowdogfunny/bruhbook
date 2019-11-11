
<?php
include 'includes/db-inc.php';
//include 'includes/user-inc.php';
include "includes/post-inc.php";
if(isset($_SESSION['logged_user'])){
  $loggedUser = new User();

?>
<html lang="en">
  <head>
    <?php
      include "includes/head_tag-inc.php";
    ?>
    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">
    <title>Bruhbook</title>
  </head>

  <body>
    <?php include "includes/main_navbar-inc.php"; ?>
    <div class="container contentContainer">

      <!-- Post a status container
      <div class="postStatusContainer">
        <div class="row">

          <div class="col-12 col-md-9 column_nopadding">
            <div class="form-group">
              <textarea class="form-control postStatusTextarea" placeholder="Post a status..." rows="3" maxlength="350"></textarea>
            </div>
          </div>

          <div class="col-12 col-md-3 column_nopadding postStatusButtonsDiv">
            <div class="row postStatusButtons_center">

              <div class="col-4 col-md-12 column_nopadding">
                <button class="btn btn-danger postStatusButtons" name="">Reset</button>
              </div>

              <div class="col-4 col-md-12 column_nopadding">
                <button class="btn btn-danger postStatusButtons" name="">Upload image</button>
              </div>

              <div class="col-4 col-md-12  column_nopadding">
                <button class="btn btn-danger postStatusButtons" name="">Post</button>
              </div>
            </div>
          </div>

        </div>
      </div>
      -->


      <!-- Header 2 container -->
      <div class="partHeader">
        Profile
      </div>


      <!-- Profile info -->
      <div class="profile_info-container">
        <div class="row">

          <div class="col-12 col-md-3 profile_img">
            <img src="<?php echo $loggedUser->getLoggedUserData("user_img"); ?>" alt=""><br>

          </div>

          <div class="col-12 col-md-6 profile_user-info">
            <table>
              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Username: </td>
                <td class="profile_tableData">
                  <?php echo $loggedUser->getLoggedUserData("user_name"); ?>
                </td>
              </tr>
              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Email:</td>
                <td class="profile_tableData">
                  <?php echo $loggedUser->getLoggedUserData("user_email"); ?>
                </td>
              </tr>

              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Followers:</td>
                <td class="profile_tableData">
                  123123
                </td>
              </tr>
              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Posts:</td>
                <td class="profile_tableData">
                  41
                </td>
              </tr>
            </table>

          </div>

          <div class="col-12 col-md-3 profile_aboutInfo">
            <span class="profile_tableHeader">About:</span> <br />
            <div class="aboutTxt">
              asdadsasdasdadsasdasdadsasdasdadsasdasdadsasdasdadsasdasdadsasd
            </div>
          </div>

        </div>
      </div>

      <hr>
      <div class="partHeader">
        My posts
      </div>
      <!-- POSTS -->
      <?php
        $post = new Post();
        $post->getPosts("from-logged_user");
      ?>

      

    </div>
  </body>
</html>
<?php

}else{
  header("Location: index.php");
}
?>

<?php


/*
include "includes/db-inc.php";
//include "includes/user-inc.php";
include "includes/post-inc.php";

if(isset($_GET['username'])){
  $user_name = $_GET['username'];
  $user = new User();
  echo "Username: ".$user->getUserData($user_name, "user_name")."<br />";
  echo "Email: ".$user->getUserData($user_name, "user_email")."<br />";
  echo "Logged user: ".$user->getLoggedUserData("user_pwd");

}else{
  header("Location: index.php");
}
*/
?>
