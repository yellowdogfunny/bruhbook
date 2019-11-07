<?php
session_start();
require_once("db-inc.php");
class User extends Database{

  // Show everyone 
  public function showEveryone(){
    $sql = "SELECT * FROM users_table";
    $query = mysqli_query(Database::connect(), $sql);
    while($row = mysqli_fetch_array($query)){
      echo $user_id = $row['user_id']."<br>";
      echo $user_img = $row['user_img']."<br>";
      echo $user_name = $row['user_name']."<br>";
      echo $user_email = $row['user_email']."<br>";
      echo $user_pwd = $row['user_pwd']."<br><br>";
    }
  }

  // Login
  public function login($username, $password){
    $sql = "SELECT * FROM users_table WHERE user_name = '$username' AND user_pwd = '$password'";
    $query = mysqli_query(Database::connect(), $sql);
    $row = mysqli_fetch_array($query);
    $count = mysqli_num_rows($query);
    if($count == 1){
      $_SESSION['logged_user'] = $username;
    }else{
      $message = "Error - username or password invalid<br>";
    }
  }

  // Register
  public function register($userimg, $username, $email, $password){
    $sql = "INSERT INTO users_table (user_img, user_name, user_email, user_pwd) VALUES
      ('$userimg', '$username', '$email', '$password')
    ";
  }

  // Show followers
  // Show messages

  // Create post
  // Show posts

  
}
