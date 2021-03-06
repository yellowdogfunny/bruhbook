<?php
//session_start();
require_once("database.class.php");
require_once("user.class.php");
require_once("comment.class.php");
require_once("like.class.php");
if(!isset($_SESSION)) {
  session_start();
}
class Post extends Database{

/*
    public $numPosts;
    //ajax thing (load more system), posalje post variablu "newNum"
    public function __construct(){
      if(isset($_POST['newNum'])){
        $this->numPosts = $_POST['newNum'];
      }else{
        $this->numPosts = 5;
      }
    }
*/

    // Show all posts or posts from currently logged in user
    //   (from-all  /  from-logged_user / from-followers /username)
    public function getPosts($from, $numPosts){
        $user = new User();
        $comment = new Comment();
        $like = new Like();

        if($from == "from-all"){
            $sql = "SELECT * FROM posts_table ORDER BY post_id DESC LIMIT $numPosts";
        }else if($from == "from-logged_user"){
            $sql = "SELECT * FROM posts_table WHERE post_user = '".$_SESSION['logged_user']."' ORDER BY post_id DESC LIMIT $numPosts";
        }else if($from == "from-followers"){
          //shows posts from followers AND logged user
          $sql = "SELECT * FROM posts_table
                  WHERE post_user IN (
                      SELECT follow_receiver
                      FROM follow_table
                      WHERE
                      follow_sender = '".$_SESSION['logged_user']."'
                      OR
                      follow_receiver = '".$_SESSION['logged_user']."'
                  )
                  ORDER BY post_id DESC LIMIT $numPosts";

        }else{
          $sql = "SELECT * FROM posts_table WHERE post_user = '$from' ORDER BY post_id DESC LIMIT $numPosts";
        }
        $res = mysqli_query(Database::connect(), $sql);
        if(mysqli_num_rows($res) > 0){
          while($row = mysqli_fetch_array($res)){
              $post_id = $row['post_id'];
              $post_user = $row['post_user'];
              $post_text = $row['post_text'];
              $post_img = $row['post_img'];
              $post_likes = $row['post_likes'];
              $post_numComments = $row['post_numComments'];
              $post_date = $row['post_date'];
              ?>

              <!-- Status container -->
              <a href="view_post.php?postId=<?php echo $post_id; ?>&username=<?php echo $post_user; ?>" class="postLink">
                <div class="statusContainer" id="openModal2">
                    <!-- User who posted a status -->
                    <object> <!-- nested link sulution -->
                      <a href="profile.php?username=<?php echo $post_user; ?>">
                        <div class="userPostingContainer">
                          <div class="userPostingImg">
                              <img src="<?php echo $user->getUserData($post_user, "user_img"); ?>" alt="">
                          </div>

                          <div class="userPostingUsername">
                              <span class="color_username newsfeed_username"><?php echo $post_user; ?></span>
                              &nbsp;
                              <!--
                              <span><i class="fas fa-check-circle"></i></span>
                              -->
                              &nbsp;
                              <br>

                              <div class="edit_delete_btn_div">
                              <!--
                              <span><i class="fas fa-edit"></i></span>
                              <span><i class="fas fa-trash-alt"></i></span>
                              -->
                              </div>
                          </div>
                        </div>
                      </a>
                    </object>



                    <!-- da status -->
                    <?php
                      if($post_text == "null_txt"){
                        echo "";
                      }else{
                        ?>
                        <hr>
                        <div class="statusText">
                            <?php echo $post_text; ?>
                        </div>

                        <?php
                      }

                      if($post_img == "null_img"){
                        echo "";
                      }else{
                        ?>
                        <hr>
                        <div class="post_image">
                          <img src="<?php echo $post_img; ?>" alt="">
                        </div>
                        <?php
                      }
                    ?>



                    <hr>
                </a>
                    <!-- status buttons -->
                    <div class="statusButtonsContainer">

                      <span id="numberOfLikes_p<?php echo $post_id; ?>" class="nLikes">
                        <?php
                          $like->numLikes($post_id);
                        ?>
                      </span>
                      <!-- like button -->
                      <button id="likeBtn_<?php echo $post_id; ?>" class="likeBtn">

                        <?php
                        //like / dislike button
                        $like->likeBtn($_SESSION['logged_user'], $post_id);
                        ?>

                      </button>

                      <a href="view_post.php?postId=<?php echo $post_id; ?>&username=<?php echo $post_user; ?>" class="postLink">
                        <span class="statusButton commentButton"> <?php $comment->numComments($post_id); ?> &nbsp; <i class="far fa-comment"></i></span>
                      </a>

                      <span class="statusButton"><?php echo $post_date; ?></span>

                    </div>

                </div>
                <script>

                  $("#likeBtn_<?php echo $post_id; ?>").on('click', function(){
                    //alert("Clicked like button <?php //echo $post_id; ?>");
                    $.ajax({
                      url: "php/like.php",
                      type: "POST",
                      data: {
                        like_post: <?php echo $post_id; ?>,
                        like_user: <?php echo "'".$_SESSION['logged_user']."'"; ?>

                      },
                      success: function(data){
                        //alert("Post [<?php echo $post_id; ?>] liked!");

                        // number of likes after clicking like btn
                        $("#numberOfLikes_p<?php echo $post_id; ?>").load("php/numLikes.php", {
                          id: <?php echo "'".$post_id."'"; ?>
                        });

                        //altering like and dislike button
                        $("#likeBtn_<?php echo $post_id; ?>").load("php/likebtn.php", {
                          user: <?php echo "'".$_SESSION['logged_user']."'"; ?>,
                          post: <?php echo $post_id; ?>
                        });
                      }
                    });
                  });

                </script>

              <?php
          }
          ?>

          <?php
        }else{
          echo "<div style='margin-top:20px;'>
            <h2>No posts yet... try following other people to see their posts</h2>
          </div>";
        }

    }




    //Get specific post
    public function getSinglePost($postid, $postuser){
      $comment = new Comment();
      $like = new Like();
      $sql_getsp = "SELECT * FROM posts_table WHERE post_id = '$postid' AND post_user = '$postuser'";
      $result = mysqli_query(Database::connect(), $sql_getsp);
      $spCount = mysqli_num_rows($result);
      $user = new User();
      if($spCount > 0){
        while($row = mysqli_fetch_array($result)){
          $post_id = $row['post_id'];
          $post_user = $row['post_user'];
          $post_text = $row['post_text'];
          $post_img = $row['post_img'];
          $post_likes = $row['post_likes'];
          $post_numComments = $row['post_numComments'];
          $post_date = $row['post_date'];
          ?>
          <div class="statusContainer" id="openModal2">

              <!-- User who posted a status -->
              <a href="profile.php?username=<?php echo $post_user; ?>">
                <div class="userPostingContainer">
                  <div class="userPostingImg">
                      <img src="<?php echo $user->getUserData($post_user, "user_img"); ?>" alt="">
                  </div>
                  <div class="userPostingUsername">
                      <span class="color_username newsfeed_username"><?php echo $post_user; ?></span>
                      &nbsp;
                      <!--
                      <span><i class="fas fa-check-circle"></i></span>
                      -->
                      &nbsp;
                      <?php
                        if($post_user == $_SESSION['logged_user']){
                          ?>
                          <div class="d-e-btns">
                            <object>
                              <a href="#" id="editPostBtn">
                                <span><i class="fas fa-edit editBtn"></i></span>
                              </a>
                              <a href="#" id="deletePostBtn">
                                <span><i class="fas fa-trash-alt delBtn"></i></span>
                              </a>
                            </object>
                          </div>



                          <?php
                        }else{
                          ?>
                          <div class="d-e-btns">
                            <object>
                              <a href="#">
                                <span class="statusButton" style="color:red;">Block</span>
                              </a>
                            </object>
                          </div>


                          <?php
                        }
                        ?>
                      <br>
                      <div class="edit_delete_btn_div">
                      <!--
                      <span><i class="fas fa-edit"></i></span>
                      <span><i class="fas fa-trash-alt"></i></span>
                      -->
                      </div>
                  </div>
                </div>
              </a>

              <!-- edit post -->
              <div class="editPostDiv" style="display:none;">
                <textarea class="form-control editPostTextArea" placeholder="Edit post..." rows="3" maxlength="350"><?php echo $post_text; ?></textarea><br>
                <button type="button" id="applyNewPost" name="button" class="btn btn-danger">Apply changes</button>
                <button type="button" id="cancelEditingPost" name="button" class="btn btn-danger">Cancel</button>

              </div>

              <!-- da status -->
              <?php
                if($post_text == "null_txt"){
                  echo "";
                }else{
                  ?>
                  <hr>
                  <div class="statusText">
                      <?php echo $post_text; ?>
                  </div>

                  <?php
                }

                if($post_img == "null_img"){
                  echo "";
                }else{
                  ?>
                  <hr>
                  <div class="post_image">
                    <img src="<?php echo $post_img; ?>" alt="">
                  </div>
                  <?php
                }
              ?>
              <hr>

              <!-- status buttons -->
              <div class="statusButtonsContainer">

                <span id="numberOfLikes_p<?php echo $post_id; ?>" class="nLikes">
                  <?php
                    $like->numLikes($post_id);
                  ?>
                </span>
                <!-- like button -->
                <button id="likeBtn_<?php echo $post_id; ?>" class="likeBtn">

                  <?php
                  //like / dislike button
                  $like->likeBtn($_SESSION['logged_user'], $post_id);
                  ?>

                </button>


                <span class="statusButton commentButton"> <?php $comment->numComments($post_id); ?> &nbsp; <i class="far fa-comment"></i></span>


                <span class="statusButton"><?php echo $post_date; ?></span>

              </div>
              <div class="postDeletedOverlay"  style="visibility:hidden;">
                <div class="postDeletedOverlayTxt">
                  POST DELETED
                </div>
              </div>
          </div>
          <script>

            $("#likeBtn_<?php echo $post_id; ?>").on('click', function(){
              //alert("Clicked like button <?php //echo $post_id; ?>");
              $.ajax({
                url: "php/like.php",
                type: "POST",
                data: {
                  like_post: <?php echo $post_id; ?>,
                  like_user: <?php echo "'".$_SESSION['logged_user']."'"; ?>

                },
                success: function(data){
                  //alert("Post [<?php echo $post_id; ?>] liked!");

                  // number of likes after clicking like btn
                  $("#numberOfLikes_p<?php echo $post_id; ?>").load("php/numLikes.php", {
                    id: <?php echo "'".$post_id."'"; ?>
                  });

                  //altering like and dislike button
                  $("#likeBtn_<?php echo $post_id; ?>").load("php/likebtn.php", {
                    user: <?php echo "'".$_SESSION['logged_user']."'"; ?>,
                    post: <?php echo $post_id; ?>
                  });
                }
              });
            });

          </script>

          <?php
        }

      }else{
        echo "<div style='margin-top:20px;'>
          <h2>Post does not exist</h2>
        </div>";
      }
    }





    // Show all followers posts

    // Create post
    public function createPost($user, $post_txt, $post_img){
      $date = date("d.m.Y");
      $sql_createPost = "INSERT INTO posts_table (post_user, post_text, post_img, post_date)
        VALUES
        ('$user', '$post_txt', '$post_img', '$date')
      ";

      $result = mysqli_query(Database::connect(), $sql_createPost);
    }


    // Delete post
    public function deletePost($post_id, $post_user){
      $sql = "DELETE FROM posts_table WHERE post_id = '$post_id' AND post_user = '$post_user'";
      $res = mysqli_query(Database::connect(), $sql);
    }


    // Edit post
    public function editPost($post_id, $new_postTxt){
      $sql = "UPDATE posts_table SET post_text = '$new_postTxt' WHERE post_id = '$post_id'";
      $res = mysqli_query(Database::connect(), $sql);
    }
}

/*
  if(isset($_POST['newNum']) || isset($_POST['from'])){
    $obj = new Post();
    $obj->getPosts($_POST['from']);
  }
*/
