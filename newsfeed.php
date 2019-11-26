
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
    <script src="scripts/jquery.ajaxfileupload.js"></script>
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




        //Post a status (txt only)
        /*
        $("#post_btn").on('click', function(){

          //var formData = new FormData();
          //formData.append('file', $('input[type=file]')[0].files[0]);



          $.ajax({
            url: "php/create-post.php",
            type: "POST",
            data: {
              post_content: $("#post_content").val(),
              post_btn: "post_button"//,
              //formData
            },
            //contentType: false,
            //processData: false,
            success: function(data){
              //alert("Content uploaded!");
              $("#posts").load("php/showPosts.php", {
                newNum: postNum,
                from: postsFrom
              });

              $("#post_content").val("");
            }
          });

        });
        */

        //webleeson - upload post text and post img
        $("#upload_form").on('submit', function(e){
          e.preventDefault();
          $.ajax({
            url: "php/create-post.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              //alert("Uploaded");
              $("#posts").load("php/showPosts.php", {
                newNum: postNum,
                from: postsFrom
              });

              $("#post_content").val("");
              $(".chooseFile").val("");
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

      <!-- Post a status container -->
      <div class="postStatusContainer">
         <!-- action="php/create-post.php" method="POST" enctype="multipart/form-data" -->
        <form method="POST" id="upload_form" enctype="multipart/form-data">
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
                  <input type="file" name="upload_file" class="btn btn-danger postStatusButtons chooseFile" value="Upload file">
                </div>

                <div class="col-4 col-md-12  column_nopadding">
                  <input type="submit" name="upload_button" class="btn btn-danger postStatusButtons">
                </div>
              </div>
            </div>
            <span id="uploaded_image"></span>
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
