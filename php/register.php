<?php
  session_start();

  require_once("../classes/user.class.php");
  require_once("../classes/follow.class.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head_tag-inc.php'; ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/bruhbook_icon.ico" type="image/x-icon">
    <title>Registration | Bruhbook</title>
</head>
<body class="regPage">
    <a href="../index.php" style="text-decoration:none;">
        <div class="reg_logo">
            <img src="../images/logo.jpg" class="" alt="">
            Bruhbook
        </div>
    </a>
    <br><br>
    <div class="container">
        <div class="partHeader regPh">Registration</div>
        <?php

            if(isset($_GET['emptyFields'])){
                echo "<br><font color='red'>Make sure to insert all the data</font><br><br>";
            }else{
                echo " ";
            }

            if(isset($_POST['register'])){

                if(empty($_FILES["img_file"]["name"]) || empty($_POST['reg_username']) || empty($_POST['reg_email']) || empty($_POST['reg_pwd'])){
                    header("Location: register.php?emptyFields=1&e_img=".$_FILES['img_file']['name']."&e_username=".$_POST['reg_username']."&e_email=".$_POST['reg_email']."");
                }else{
                    $regUsername = $_POST['reg_username'];
                    $regEmail = $_POST['reg_email'];
                    $regPwd = $_POST['reg_pwd'];

                    $randStr = generateRandomString();
                    $userImg = $_FILES['img_file']['name'];
                    $temp = $_FILES['img_file']['tmp_name'];

                    $randImgName = $regUsername."_img-".$randStr."_".$userImg;

                    if(is_dir("../images/$regUsername")){
                        echo "<br><font color='red'>Choose a different username</font><br><br>";
                    }else{
                        mkdir("../images/$regUsername");

                        move_uploaded_file($temp, "../images/".$regUsername."/".$randImgName);
                        $imgUrl = "./images/".$regUsername."/".$randImgName;
                        $newUser = new User();
                        $newUser->register($imgUrl, $regUsername, $regEmail, $regPwd);

                        $autoFollow = new Follow();
                        $autoFollow->follow_function($regUsername, $regUsername);
                    }


                }

            }else{
                echo "";
            }

            if(isset($_GET['e_img']) || isset($_GET['e_username']) || isset($_GET['e_email'])){
              $e_img = $_GET['e_img']; // img doesnt return :(
              $e_username = $_GET['e_username'];
              $e_email = $_GET['e_email'];

            }else{
              $e_img = "";  // img doesnt return :(
              $e_username = "";
              $e_email = "";
            }
        ?>
        <form action="register.php" method="POST" enctype='multipart/form-data'>
            Choose a profile picture: <input type="file" name="img_file" class="" value="<?php echo $e_img; ?>"><br><br>
            Name: <input type="text" name="reg_username" class="form-control" value="<?php echo $e_username; ?>"><br>
            Email: <input type="text" name="reg_email" class="form-control" value="<?php echo $e_email; ?>"><br>
            Password: <input type="password" name="reg_pwd" class="form-control"><br>
            <input type="submit" name="register" class="btn btn-danger form-control">
        </form>


    </div>
</body>
</html>
<?php
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
