<?php
require_once("database.class.php");
class Follow extends Database{

  // Follow system
  public function follow_function($sender, $receiver){

    $sql_check = "SELECT * FROM follow_table WHERE follow_sender = '$sender' AND follow_receiver = '$receiver'";
    $res_check = mysqli_query(Database::connect(), $sql_check);

    if(mysqli_num_rows($res_check) > 0){
      $sql = "DELETE FROM follow_table WHERE follow_sender = '$sender' AND follow_receiver = '$receiver'";
      $result = mysqli_query(Database::connect(), $sql);

    }else{
      $sql = "INSERT INTO follow_table (follow_sender, follow_receiver) VALUES
        ('$sender', '$receiver')
      ";
      $result = mysqli_query(Database::connect(), $sql);

    }

  }


  // Check following (follow or unfollow btn)
  public function followBtn($sender, $receiver){
    $sql_c = "SELECT * FROM follow_table WHERE follow_sender = '$sender' AND follow_receiver = '$receiver'";
    $res_c = mysqli_query(Database::connect(), $sql_c);
    if(mysqli_num_rows($res_c) > 0){
      ?>
      <form class="" action="" method="">
        <button type="button" name="follow" class="btn btn-danger unFlwBtn" id="unFollowButton">Following</button>
      </form>
      <?php
    }else{
      ?>
      <form class="" action="" method="">
        <button type="button" name="follow" class="btn btn-danger flwBtn" id="followButton">Follow</button>
      </form>
      <?php
    }
  }

}
