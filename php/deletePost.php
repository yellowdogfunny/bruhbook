<?php
session_start();
require_once("../classes/post.class.php");
if(isset($_POST['post_id']) && isset($_POST['post_user'])){
  if($_POST['post_user'] == $_SESSION['logged_user']){
    $del = new Post();
    $del->deletePost($_POST['post_id'], $_SESSION['logged_user']);
  }else{
    header("Location: ../index.php");
    //echo "error";
  }
}else{
  header("Location: ../index.php");
  //echo "error";
}
?>
