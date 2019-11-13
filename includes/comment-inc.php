<?php
include "db-inc.php";
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
    $sql_c = "SELECT * FROM comments_table WHERE comment_post = '$post'";
    $res_c = mysqli_query(Database::connect(), $sql_c);
    if(mysqli_num_rows($res_c) > 0){
      while($row = mysqli_fetch_array($res_c)){
        echo $comment_post = $row['comment_post'];
        echo $comment_user = $row['comment_user'];
        echo $comment_text = $row['comment_text'];
      }
    }
  }

}

?>
