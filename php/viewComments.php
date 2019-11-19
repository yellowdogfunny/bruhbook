<?php
require_once("../classes/comment.class.php");
if(isset($_POST['com_post_id'])){
  $pId = $_POST['com_post_id'];
  $comments = new Comment();
  $comments->showComments($pId);
}
?>
