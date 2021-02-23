<?php
require_once("database.class.php");

class Message extends Database{
  // People chat heads
  public function listPeople(){

    $sql = "SELECT * FROM users_table
            WHERE user_name IN (
                SELECT follow_receiver
                FROM follow_table
                WHERE
                follow_sender = '".$_SESSION['logged_user']."'
            )
            ORDER BY user_id";

    $res = mysqli_query(Database::connect(), $sql);
    if(mysqli_num_rows($res) > 0){
      while($row = mysqli_fetch_array($res)){
        echo $username = $row['user_name'];
      }
    }else{
      echo "Its empty in here";
    }
  }



  // Chat
  // Send message
  // Receive message
}

?>
