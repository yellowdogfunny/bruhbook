<?php
  session_start();
  require_once("../classes/post.class.php");

  if(isset($_POST['post_id']) && isset($_POST['post_user']) && isset($_POST['newTxt'])){
    
    $id = $_POST['post_id'];
    $user = $_POST['post_user'];
    $txt = $_POST['newTxt'];

    if($user == $_SESSION['logged_user']){
      $nPost = new Post();
      $nPost->editPost($id, $txt);
    }else{
      echo "error";
    }
  }else{
    header("Location: ../index.php");
  }
?>
