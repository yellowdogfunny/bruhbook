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
    $error = "<br>-<br>";
    //Check 
    $sql_u = "SELECT * FROM users_table WHERE user_name = '$username'";
    $sql_e = "SELECT * FROM users_table WHERE user_email = '$email'";
    $sql_p = "SELECT * FROM users_table WHERE user_pwd = '$password'";

    $res_u = mysqli_query(Database::connect(), $sql_u);
    $res_e = mysqli_query(Database::connect(), $sql_e);
    $res_p = mysqli_query(Database::connect(), $sql_p);

    if(mysqli_num_rows($res_u) > 0){
      echo $error = "<br><font color='red'>Username already taken</font><br><br>";
    }else if(mysqli_num_rows($res_e) > 0){
      echo $error = "<br><font color='red'>Choose a different email</font><br><br>";
    }else if(mysqli_num_rows($res_p) > 0){
      echo $error = "<br><font color='red'>Choose a different password</font><br><br>";
    }else{
      //Insert into table
      $sql_register = "INSERT INTO users_table (user_img, user_name, user_email, user_pwd) VALUES
        ('$userimg', '$username', '$email', '$password')
      "; 
      $result = mysqli_query(Database::connect(), $sql_register);
      echo "<br><font color='red'>Registration success!</font><br>";
      echo $userimg;
      header("Location: reg_success.php");
    }
  }


  //Get logged user data
  public function getLoggedUserData($getData){
    if(isset($_SESSION['logged_user'])){
      $sql = "SELECT * FROM users_table WHERE user_name = '".$_SESSION['logged_user']."'";
      $res = mysqli_query(Database::connect(), $sql);
      while($row = mysqli_fetch_array($res)){
        $data = $row[$getData];
      }
      return $data;
    }else{
      echo "Error - no user logged in";
    }
  }


  // Show followers
  // Show messages

  // Create post
  // Show posts

  
}
