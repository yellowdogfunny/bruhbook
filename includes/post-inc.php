<?php
//session_start();
require_once("db-inc.php");
include "user-inc.php";

class Post extends Database{

    public $numPosts = 5;
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

            ?>


            <!-- Status container -->

            <div class="statusContainer">
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
                </div>

            </div>

            <?php
        }
        ?>
        <!--
        <div class="loadMoreDiv">
          <button type="button" id="loadMoreButton">Load more</button>
        </div>
        -->
        <?php
        /*
        if(isset($_POST['newNum'])){

          echo $_POST['newNum'];
        }
        */
    }




    // Show all followers posts

    // Show posts from a specific person

    // Create post
    public function createPost($user, $post_txt){
      $sql_createPost = "INSERT INTO posts_table (post_user, post_text)
        VALUES
        ('$user', '$post_txt')
      ";

      $result = mysqli_query(Database::connect(), $sql_createPost);
    }

}
if(isset($_POST['newNum']) || isset($_POST['from'])){
  $obj = new Post();
  /*
  echo $_POST['newNum'];
  echo $_POST['from'];
  */
  $obj->getPosts($_POST['from']);
}
