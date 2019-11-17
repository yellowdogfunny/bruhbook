
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

      //Load more
      var postNum = 5;
      var newNum = 0;
      var from;
      $("#loadMoreButton").click(function(){
        postNum = postNum + 5;
        console.log(postNum);
        $("#posts").load("classes/post.class.php", {
          newNum : postNum,
          from : "<?php echo $username; ?>"
        });
      });

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
            window.location.reload(); //TODO: napravit da se ne mora refreshat
          }
        });
      });

      //Unfollow
      $("#unFollowButton").click(function(){
        $.ajax({
          //url: "php/follow.php",
          type: "POST",
          data: {
            followSender: <?php echo "'".$_SESSION['logged_user']."'"; ?>,
            followReceiver: <?php echo "'".$_GET['username']."'"; ?>
          },
          success: function(data){
            window.location.reload(); //TODO: napravit da se ne mora refreshat
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

      <hr>
      <!-- Header 2 container -->
      <div class="partHeader">
        Messages
      </div>

      <div class="row messagesContainer">

        <div class="col-3 peopleDiv">
          People (sakrit na 768px i stavit btn koji otvara to)<br>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>

          <!-- Person -->
          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>

        </div>

        <div class="col-9 messagesDiv">
          Chat (scrollable)<br>

          <div class="messageInputFieldDiv">
            <input type="text" name="" value="" class="form-control messageInputField">
            <input type="button" class="btn btn-danger sendMsgBtn" name="" value="->">
          </div>

        </div>

      </div>

    </div>
  </body>

</html>
