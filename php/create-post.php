<?php
session_start();
//include "../includes/class-autoloader.php";
require_once("../classes/post.class.php");

/*
if(isset($_POST['post_btn'])){
*/


  // AJAX IMG UPLOAD
  if(!empty($_FILES["upload_file"]["name"])){
    $test = explode(".", $_FILES["upload_file"]["name"]);
    $extension = end($test);
    $name = time()."_postimg_".$_SESSION['logged_user']."_".generateRandomString().".".$extension;
    $location = '../images/'.$_SESSION['logged_user']/*."_post_".$name*/;
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], $location."/".$name);

    $p_imgurl = './images/'.$_SESSION['logged_user']."/".$name;
  }else{
    $p_imgurl = "null_img";
  }

  if(!empty($_POST['post_content'])){
    $postTxt = $_POST['post_content'];
  }else{
    $postTxt = "null_txt";
  }

  //$p_imgurl = "null_img";
  $post = new Post();
  $post->createPost($_SESSION['logged_user'], $postTxt, $p_imgurl);
  //header("location: ../index.php");

/*
}else{
  //header("location: ../index.php");
}
*/

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

 ?>
