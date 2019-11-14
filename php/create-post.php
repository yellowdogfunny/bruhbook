<?php
session_start();
//include "../includes/class-autoloader.php";
require_once("../classes/post.class.php");
if(isset($_GET['post_button'])){
  $post = new Post();
  $post->createPost($_SESSION['logged_user'], $_GET['post_content']);
  header("location: ../index.php");
}else{
  header("location: ../index.php");
}

 ?>
