<?php
require_once("database.class.php");
//require_once("post.class.php");

class Like extends Database{

  //like / dislike
  public function like_function($user, $like_post) {
    $sql = "SELECT * FROM likes_table WHERE like_post = '$like_post' AND like_user = '$user'";
    $res = mysqli_query(Database::connect(), $sql);

    if(mysqli_num_rows($res) > 0){
      $sql_l = "DELETE FROM likes_table WHERE like_post = '$like_post' AND like_user = '$user' ";
    }else{
      $sql_l = "INSERT INTO likes_table (like_user, like_post)
      VALUES(
        '$user', $like_post
      )";
    }

    $result = mysqli_query(Database::connect(), $sql_l);
  }

  //num likes
  public function numLikes($like_post){
    $sql = "SELECT * FROM likes_table WHERE like_post = '$like_post'";
    $res = mysqli_query(Database::connect(), $sql);
    if(mysqli_num_rows($res) > 0){
      echo mysqli_num_rows($res);
    }else{
      echo "0";
    }
  }

  public function likeBtn($user, $post){
    $sql_btn = "SELECT * FROM likes_table WHERE like_user = '".$user."' AND like_post = '$post'";

    $res_btn = mysqli_query(Database::connect(), $sql_btn);
    if(mysqli_num_rows($res_btn) > 0){
      ?>
      <i class="fas fa-heart"></i>
      <?php
    }else{
      ?>
      <i class="far fa-heart"></i>
      <?php
    }
  }

}

?>
