<?php
include 'includes/db-inc.php';
//include 'includes/user-inc.php';
include 'includes/post-inc.php';
//include 'includes/comment-inc.php';

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
        $("#post_comment_btn").on('click', function(){
          var comment_txt = $('#comment_txt').val();

          if(comment_txt != ""){
            $.ajax({
              url: "php/comment.php",
              type: "POST",
              data: {
                comment_txt: comment_txt,
                comment_post: <?php echo "'".$_GET["postId"]."'"; ?>,
                comment_user: <?php echo "'".$_SESSION["logged_user"]."'"; ?>
              }
            });
          }else{
            $("#post_comment_btn").style.disabled = 'disabled';
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
        <form class="" action="" method="">
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

      <?php
        $comment = new Comment();
        $comment->showComments();
      ?>

      <!-- comment -->
      <div class="statusContainer commentContainer" id="openModal2">
          <!-- Comment -->
        <div class="userCommenting">
          <div class="userPostingImg">
              <img src="images/images.jpg" alt="">
          </div>

          <div class="commentUsername">
            Person:
          </div>
        </div>

        <div class="comment">
          Wow what a great post man bro
        </div>
      </div>

      <!-- comment 2 -->
      <div class="statusContainer commentContainer" id="openModal2">
          <!-- Comment -->

          <div class="userCommenting">
            <div class="userPostingImg">
                <img src="images/hbru.jpg" alt="">
            </div>

            <div class="commentUsername">
              Person_2:
            </div>
          </div>

        <div class="comment">
          Bruhhhh bruhhhhBruhhhh bruhhhhBruhhhh bruhhhh
        </div>
      </div>
    </div>
  </body>
</html>
