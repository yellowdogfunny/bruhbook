<?php
include "../includes/post-inc.php";
if(isset($_GET['post_button'])){
  //echo $_GET['post_content'];
  $post = new Post();
  $post->createPost($_SESSION['logged_user'], $_GET['post_content']);
  header("location: ../index.php");
}else{
  header("location: ../index.php");
}

 ?>
