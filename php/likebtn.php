<?php
require_once("../classes/like.class.php");
if(isset($_POST['user']) && isset($_POST['post'])){
  $user = $_POST['user'];
  $post = $_POST['post'];

  $btn = new Like();
  $btn->likeBtn($user, $post);
}
?>
