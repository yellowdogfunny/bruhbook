<?php
//session_start();
require_once("db-inc.php");
include "user-inc.php";
class Post extends Database{

    // Show all posts or posts from currently logged in user
    //   (from-all  /  from-logged_user)
    public function getPosts($from){

        $user = new User();

        if($from == "from-all"){
            $sql = "SELECT * FROM posts_table ORDER BY post_id DESC";
        }else if($from == "from-logged_user"){
            $sql = "SELECT * FROM posts_table WHERE post_user = '".$_SESSION['logged_user']."'";
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

                <hr>

                <!-- da status -->
                <div class="statusText">
                    <?php echo $post_text; ?>
                </div>

                <hr>

                <!-- status buttons -->
                <div class="statusButtonsContainer">
                <span class="statusButton likeButton">5 &nbsp; <i class="fas fa-heart"></i></span>
                <span class="statusButton commentButton">4 &nbsp; <i class="far fa-comment"></i></span>
                </div>

            </div>
            <?php
        }
    }



    
    // Show all followers posts

    // Show posts from a specific person

    // Create post

}
/*
$post = new Post();
$post->getPosts("from-all");*/