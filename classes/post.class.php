<?php
//session_start();
require_once("database.class.php");
require_once("user.class.php");

class Post extends Database{

    public $numPosts;
    //ajax thing (load more system), posalje post variablu "newNum"
    public function __construct(){
      if(isset($_POST['newNum'])){
        $this->numPosts = $_POST['newNum'];
      }else{
        $this->numPosts = 5;
      }
    }

    // Show all posts or posts from currently logged in user
    public function getPosts($from){ //   (from-all  /  from-logged_user / username)

        $user = new User();
        //TODO: dodat jos jedan else if u kojem ce bit od followera content
        if($from == "from-all"){
            $sql = "SELECT * FROM posts_table ORDER BY post_id DESC LIMIT $this->numPosts";
        }else if($from == "from-logged_user"){
            $sql = "SELECT * FROM posts_table WHERE post_user = '".$_SESSION['logged_user']."' ORDER BY post_id DESC LIMIT $this->numPosts";
        }else{
          $sql = "SELECT * FROM posts_table WHERE post_user = '$from' ORDER BY post_id DESC LIMIT $this->numPosts";
        }
        $res = mysqli_query(Database::connect(), $sql);
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

                  <hr>

                  <!-- da status -->
                  <div class="statusText">
                      <?php echo $post_text; ?>
                  </div>

                  <hr>

                  <!-- status buttons -->
                  <div class="statusButtonsContainer">
                    <span class="statusButton likeButton"> 0 &nbsp; <i class="fas fa-heart"></i></span>
                    <span class="statusButton commentButton"> 0 &nbsp; <i class="far fa-comment"></i></span>
                    <span class="statusButton"><?php echo $post_date; ?></span>

                  </div>

              </div>
            </a>


            <?php
        }
    }




    //Get specific post
    public function getSinglePost($postid, $postuser){
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
                              <a href="#">
                                <span><i class="fas fa-edit editBtn"></i></span>
                              </a>
                              <a href="#">
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
              <hr>
              <!-- da status -->
              <div class="statusText">
                  <?php echo $post_text; ?>
              </div>
              <hr>
              <!-- status buttons -->
              <div class="statusButtonsContainer">
              <span class="statusButton likeButton"> 0 &nbsp; <i class="fas fa-heart"></i></span>
              <span class="statusButton commentButton"> 0 &nbsp; <i class="far fa-comment"></i></span>
              <span class="statusButton"><?php echo $post_date; ?></span>

              </div>
          </div>
          <?php
        }

      }else{
        header("Location: index.php");
      }
    }





    // Show all followers posts

    // Create post
    public function createPost($user, $post_txt){
      $date = date("d.m.Y");
      $sql_createPost = "INSERT INTO posts_table (post_user, post_text, post_date)
        VALUES
        ('$user', '$post_txt', '$date')
      ";

      $result = mysqli_query(Database::connect(), $sql_createPost);
    }

}

if(isset($_POST['newNum']) || isset($_POST['from'])){
  $obj = new Post();
  $obj->getPosts($_POST['from']);
}
