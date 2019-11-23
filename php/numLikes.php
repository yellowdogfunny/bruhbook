<?php
require_once("../classes/like.class.php");
if(isset($_POST['id'])){
  $nLikes = new Like();
  $nLikes->numLikes($_POST['id']);
}
?>
