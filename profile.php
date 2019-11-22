
<?php
session_start();
include 'includes/class-autoloader.php';

$user = new User();
if(isset($_GET['username'])){
  $username = $_GET['username'];
}else if(isset($_SESSION['logged_user'])){
  $username = $_SESSION['logged_user'];
}else{
  header("Location: index.php");
}

if($_SESSION['logged_user'] != $username){
  $postsHeader = "Posts";
}else{
  $postsHeader = "My posts";
}

?>
<html lang="en">
  <head>
    <?php
      include "includes/head_tag-inc.php";
    ?>
    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">

    <script>
    $(document).ready(function(){
      var postNum = 5;
      var postsFrom = <?php echo "'".$username."'"; ?>;

      $("#posts").load("php/showPosts.php", {
        from: <?php echo "'".$username."'"; ?>
      });

      $("#loadMoreButton").on('click', function(){
        postNum = postNum + 5;
        console.log(postNum);
        $.ajax({
          url: "php/showPosts.php",
          type: "POST",
          data: {
            newNum: postNum
          },
          success: function(data){
            //alert("Number of posts: " + postNum);
            $("#posts").load("php/showPosts.php", {
              newNum: postNum,
              from: postsFrom
            });
          }
        });
      });

      //Load more
/*
      var postNum = 5;
      var newNum = 0;
      var from;
      $("#loadMoreButton").click(function(){
        postNum = postNum + 5;
        console.log(postNum);
        $("#posts").load("classes/post.class.php", {
          newNum : postNum,
          from : "<?php //echo $username; ?>"
        });
      });
*/

      //Follow
      $("#followButton").click(function(){
        $.ajax({
          //url: "php/follow.php",
          type: "POST",
          data: {
            followSender: <?php echo "'".$_SESSION['logged_user']."'"; ?>,
            followReceiver: <?php echo "'".$_GET['username']."'"; ?>
          },
          success: function(data){
            //window.location.reload(); //TODO: napravit da se ne mora refreshat

            alert("You are now following this person");
          }
        });
      });

      //Unfollow
      $("#unFollowButton").click(function(){
        //alert("clicked unfollow bnutton");
        $.ajax({
          //url: "php/follow.php",
          type: "POST",
          data: {
            followSender: <?php echo "'".$_SESSION['logged_user']."'"; ?>,
            followReceiver: <?php echo "'".$_GET['username']."'"; ?>
          },
          success: function(data){
            //window.location.reload(); //TODO: napravit da se ne mora refreshat
            alert("You are not following this person anymore");
          }
        });
      });

    });


    </script>

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

      <hr>
      <!-- Header 2 container -->
      <div class="partHeader">
        Profile
      </div>


      <!-- Profile info -->
      <div class="profile_info-container">
        <div class="row">

          <div class="col-12 col-md-3 profile_img">
            <img src="<?php echo $user->getUserData($username, "user_img"); ?>" alt=""><br>

          </div>

          <div class="col-12 col-md-6 profile_user-info">
            <span id="follow_unfollow_button">
              <!-- here goes da button -->
            </span>

            <?php

              if($_GET['username'] != $_SESSION['logged_user']){
                if(isset($_POST['followSender']) && isset($_POST['followReceiver'])){
                  $sender = $_POST['followSender'];
                  $receiver = $_POST['followReceiver'];

                  $follow = new Follow();
                  $follow->follow_function($sender, $receiver);
                }

                $fBtn = new Follow();
                $fBtn->followBtn($_SESSION['logged_user'], $_GET['username']);

                ?>

                <br />

                <?php

              }

            ?>

            <table>
              <?php echo " <h2>$username</h2><br /> "; ?>
              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Email:</td>
                <td class="profile_tableData">
                  <?php echo $user->getUserData($username, "user_email"); ?>
                </td>
              </tr>

              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Followers:</td>
                <td class="profile_tableData">
                  <?php
                    $user->getNumFollowers($username);
                  ?>
                </td>
              </tr>
              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Following:</td>
                <td class="profile_tableData">
                  <?php
                    $user->getNumFollowing($username);
                  ?>
                </td>
              </tr>
              <tr class="profile_tableRow">
                <td class="profile_tableHeader">Posts:</td>
                <td class="profile_tableData">
                  <?php
                    $user->getNumPosts($username);
                  ?>
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
        <?php echo $postsHeader; ?>
      </div>
      <div class="posts" id="posts">
        <!-- POSTS -->
        <?php
        /*
          $post = new Post();
          $post->getPosts($username);
        */
        ?>
      </div>


      <div class="loadMoreDiv">
        <button type="button" id="loadMoreButton" class="loadMoreButton">Load more</button>
      </div>

    </div>
  </body>

</html>

<?php


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
