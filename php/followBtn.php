<?php
session_start();
require_once("../classes/follow.class.php");

if(isset($_POST['followSender']) && isset($_POST['followReceiver'])){
  $sender = $_POST['followSender'];
  $receiver = $_POST['followReceiver'];

  $followBtn = new Follow();
  $followBtn->followBtn($sender, $receiver);
}
?>
