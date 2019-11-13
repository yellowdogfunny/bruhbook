<?php
include "../includes/comment-inc.php";

  if(isset($_POST['comment_txt']) && isset($_POST['comment_post']) && isset($_POST['comment_user'])){
    echo $txt = $_POST['comment_txt'];
    echo $post =  $_POST['comment_post'];
    echo $user = $_POST['comment_user'];

    $comment = new Comment();
    $comment->insertComment($post, $user, $txt);
  }else{
    echo "error";
  }
?>
