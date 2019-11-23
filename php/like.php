<?php
session_start();
require_once("../classes/like.class.php");

if(isset($_POST['like_post']) && isset($_POST['like_user'])){
  $user = $_POST['like_user'];
  $post = $_POST['like_post'];

  $like = new Like();
  $like->like_function($user, $post);
}else{
  echo "Error - post or user not set";
}



?>
