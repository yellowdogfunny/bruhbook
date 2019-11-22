
<?php
session_start();
include 'includes/class-autoloader.php';

if(isset($_SESSION['logged_user'])){
  $loggedUser = new User();

?>
<html lang="en">
  <head>
    <?php
      include "includes/head_tag-inc.php";

      // from-all, from-logged_user, from-followers
      //$from = "from-all";
    ?>

    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">
    <script>

      $(document).ready(function(){
        var postNum = 5;
        var postsFrom = "from-followers";

        //po defaultu budu prikazani of followera postovi
        $("#posts").load("php/showPosts.php", {
          from: "from-followers"
        });

        $("#showFollowersBtn").css("font-weight", "1000");

        $("#showFollowersBtn").on('click', function(){
          postNum = 5;
          postsFrom = "from-followers";
          $.ajax({
            url: "php/showPosts.php",
            type: "POST",
            data: {
              from: "from-followers"
            },
            success: function(data){
              //alert("Posts from followers");
              $("#posts").load("php/showPosts.php", {
                from: "from-followers"
              });

              $("#showAllBtn").css("font-weight", "500");
              $("#showFollowersBtn").css("font-weight", "1000");
            }
          });
        });

        $("#showAllBtn").on('click', function(){
          postNum = 5;
          postsFrom = "from-all";
          $.ajax({
            url: "php/showPosts.php",
            type: "POST",
            data: {
              from: "from-all"
            },
            success: function(data){
              //alert("Posts from everyone");
              $("#posts").load("php/showPosts.php", {
                from: "from-all"
              });

              $("#showAllBtn").css("font-weight", "1000");
              $("#showFollowersBtn").css("font-weight", "500");
            }
          });
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


        $("#post_btn").on('click', function(){
          $.ajax({
            url: "php/create-post.php",
            type: "GET",
            data: {
              post_button: "post_button",
              post_content: $("#post_content").val()
            },
            success: function(data){
              //alert("Successfuly posted!");
              $("#posts").load("php/showPosts.php", {
                newNum: postNum,
                from: postsFrom
              });

              $("#post_content").val("");
            }
          });
        })

      });
/*
        var postNum = 5;
        var newNum = 0;
        var from;
        $("#loadMoreButton").click(function(){
          postNum = postNum + 5;
          console.log(postNum);
          $("#posts").load("classes/post.class.php", {
            newNum : postNum,
            from : "<?php //echo $from; ?>"
          });
        });
*/


    </script>
    <title>Bruhbook</title>
  </head>

  <body>
    <?php include "includes/main_navbar-inc.php"; ?>
    <div class="container contentContainer">

      <!-- Post a status container -->
      <div class="postStatusContainer">
        <form class="" action="" method="">
          <div class="row">

            <div class="col-12 col-md-9 column_nopadding">
              <div class="form-group">
                <textarea class="form-control postStatusTextarea" placeholder="Post a status..." rows="3" maxlength="350" name="post_content" id="post_content"></textarea>
              </div>
            </div>

            <div class="col-12 col-md-3 column_nopadding postStatusButtonsDiv">
              <div class="row postStatusButtons_center">

                <div class="col-4 col-md-12 column_nopadding">
                  <button class="btn btn-danger postStatusButtons" name="" disabled>Reset</button>
                </div>

                <div class="col-4 col-md-12 column_nopadding">
                  <button class="btn btn-danger postStatusButtons" name="" disabled>Upload image</button>
                </div>

                <div class="col-4 col-md-12  column_nopadding">
                  <button type="button" class="btn btn-danger postStatusButtons" id="post_btn">Post</button>
                </div>
              </div>
            </div>
          </div>
        </form>

      </div>

      <hr>
      <!-- Header 2 container -->
      <div class="partHeader">
        Newsfeed -
        <!--
        <select class="" name="">
          <option id="showFollowersBtn">Followers</option>
          <option id="showAllBtn">All</option>
        </select>
        -->
        Show posts from:
        <button id="showFollowersBtn">Followers</button>
        <button id="showAllBtn">Everyone</button>
      </div>

      <!-- POSTS -->
      <div id="posts">

        <?php
/*
          $post = new Post();
          $post->getPosts($from);
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

}else{
  header("Location: index.php");
}
?>
