<?php
session_start();

require_once("../classes/comment.class.php");

  if(isset($_POST['comment_txt']) && isset($_POST['comment_post']) && isset($_POST['comment_user']) && isset($_POST['post_id'])){
    $txt = $_POST['comment_txt'];
    $post =  $_POST['comment_post'];
    $user = $_POST['comment_user'];
    $pId = $_POST['post_id'];

    $comment = new Comment();
    $comment->insertComment($post, $user, $txt);

    //$comment->showComments($pId);
  }else{
    echo "comment error";
  }

?>
