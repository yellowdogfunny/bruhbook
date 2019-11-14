<?php
require_once("database.class.php");
class Comment extends Database{

  //insert comment in da database
  public function insertComment($post, $user, $txt){
    $sql = "INSERT INTO comments_table (comment_post, comment_user, comment_text) VALUES
      ('$post', '$user', '$txt')
    ";
    $result = mysqli_query(Database::connect(), $sql);
  }

  //show comments
  public function showComments($post){
    $sql_c = "SELECT * FROM comments_table WHERE comment_post = '$post' ORDER BY comment_id DESC";
    $res_c = mysqli_query(Database::connect(), $sql_c);
    if(mysqli_num_rows($res_c) > 0){
      while($row = mysqli_fetch_array($res_c)){
        //echo $comment_post = $row['comment_post'];
        $comment_user = $row['comment_user'];
        $comment_text = $row['comment_text'];

        ?>

        <div class="statusContainer commentContainer">
            <!-- Comment -->
            <?php
              //image for user that commented
              $sql_u = "SELECT * FROM users_table WHERE user_name = '$comment_user'";
              $res_u = mysqli_query(Database::connect(), $sql_u);
              $row_u = mysqli_fetch_array($res_u);
              $user_img = $row_u['user_img'];
            ?>

              <div class="userCommenting">
                <a href="profile.php?username=<?php echo $comment_user; ?>">
                  <div class="userPostingImg">
                      <img src="<?php echo $user_img; ?>" alt="">
                  </div>
                </a>

                <a class="userCommentingLink"  href="profile.php?username=<?php echo $comment_user; ?>">
                  <div class="commentUsername">
                    <?php echo $comment_user; ?>:
                  </div>
                </a>

              </div>

          <div class="comment">
            <?php echo $comment_text; ?>
          </div>
        </div>

        <?php

      }
    }
  }

}

?>
