<?php
session_start();
include 'includes/class-autoloader.php';

if(isset($_GET['postId']) && isset($_GET['username'])){
  $post_id = $_GET['postId'];
  $post_user = $_GET['username'];

}else{
  header("Location: ../index.php");
}



?>
<html lang="en">
  <head>
    <?php
      include "includes/head_tag-inc.php";

      // from-all, from-logged_user
      //$from = "from-all";
    ?>
    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">
    <script>
      $(document).ready(function(){
        $(".display").load("php/viewComments.php", {
          com_post_id: <?php echo "'".$post_id."'"; ?>
        });

        $("#post_comment_btn").on('click', function(){
          var comment_txt = $('#comment_txt').val();

          if(comment_txt != ""){
            $.ajax({
              url: "php/comment.php",
              type: "POST",
              data: {
                post_id: <?php echo "'".$post_id."'"; ?>, //dodano
                comment_txt: comment_txt,
                comment_post: <?php echo "'".$_GET["postId"]."'"; ?>,
                comment_user: <?php echo "'".$_SESSION["logged_user"]."'"; ?>
              },
              success: function(data){
                $("#comment_txt").val('');
                //window.location.reload(); //TODO: promjenit ovo da se nekako odma displejaju komentari a ne da se refresha
                $(".display").load("php/viewComments.php", {
                  com_post_id: <?php echo "'".$post_id."'"; ?>
                });
              }
            });
          }else{
            //alert("Error");
            $("#comment_txt").css("box-shadow", "0px 1px 5px rgb(255, 67, 67)");
          }
        });

        // Delete post
        $("#deletePostBtn").on('click', function(){
          $.ajax({
            url: "php/deletePost.php",
            type: "POST",
            data: {
              post_id: <?php echo "'".$_GET['postId']."'"; ?>,
              post_user: <?php echo "'".$_GET['username']."'"; ?>
            },
            success: function(data){
              //alert("Successfuly deleted");
              $(".postDeletedOverlay").css("visibility", "visible");
            }
          });
        });

        // Edit post
        $("#editPostBtn").on('click', function(){
          $(".editPostDiv").css("display", "block");
          $(".statusText").css("display", "none");
        });

        $("#cancelEditingPost").on('click', function(){
          $(".editPostDiv").css("display", "none");
          $(".statusText").css("display", "block");
        });

        $("#applyNewPost").on('click', function(){
          var newPostTxt = $(".editPostTextArea").val();
          if(newPostTxt != ""){
            $.ajax({
              url: "php/editPost.php",
              type: "POST",
              data: {
                post_id: <?php echo "'".$_GET['postId']."'" ?>,
                post_user: <?php echo "'".$_GET['username']."'" ?>,
                newTxt: newPostTxt
              },
              success: function(data){
                //alert("Edited! - " + newPostTxt);
                $(".editPostDiv").css("display", "none");
                $(".statusText").css("display", "block");
                $(".statusText").html(newPostTxt);
              }
            });
          }else{
            alert("You left input field empty");
          }
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
        Post from: <span class="bold"><?php echo $post_user; ?></span>
      </div>

      <!-- POST -->
      <div id="posts">
        <?php
          $post = new Post();
          $post->getSinglePost($post_id, $post_user);
        ?>
      </div>
      <hr>

      <!-- Write a comment -->
      <div class="postStatusContainer">
        <form class="" action="" method="" id="cmtForm">
          <div class="row">

            <div class="col-12 col-md-9 column_nopadding">
              <div class="form-group">
                <textarea class="form-control postStatusTextarea" placeholder="Comment on this post..." rows="1" maxlength="100" name="comment_txt" id="comment_txt"></textarea>
              </div>
            </div>

            <div class="col-12 col-md-3 column_nopadding postStatusButtonsDiv">
              <div class="row postStatusButtons_center">
                <div class="col-4 col-md-12  column_nopadding">
                  <input type="button" class="btn btn-danger postStatusButtons commentBtn" name="post_comment_btn" value="Post" id="post_comment_btn">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>



      <hr>

      <div class="partHeaderSmall">
        Comments:
      </div>

      <!-- COMMENTS -->
      <div class="display">

        <?php
        /*
          $comment = new Comment();
          $comment->showComments($_GET['postId']);
        */
        ?>
      </div>



    </div>
  </body>
</html>
