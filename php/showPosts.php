<?php
session_start();
require_once("../classes/post.class.php");
require_once("../classes/user.class.php");
if(isset($_POST['newNum'])){
  $numPosts = $_POST['newNum'];
}else{
  $numPosts = 5;
}
if(isset($_POST['from'])){

  $from = $_POST['from'];
  $post = new Post();
  $post->getPosts($from, $numPosts);
}else{
  echo "Error occured while loading posts";
}

?>
