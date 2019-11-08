<?php
    include '../includes/db-inc.php';
    include '../includes/user-inc.php';


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
        <form action="register.php" method="POST">
            Choose a profile picture: <input type="text" name="reg_img" class="form-control"><br>
            Name: <input type="text" name="reg_username" class="form-control"><br>
            Email: <input type="text" name="reg_email" class="form-control"><br>
            Password: <input type="password" name="reg_pwd" class="form-control"><br>
            <input type="submit" name="register" class="btn btn-danger form-control">
        </form>

        <?php
            if(isset($_GET['emptyFields'])){
                echo "<br>Make sure to insert all the data";
            }else{
                echo " ";
            }
            if(isset($_POST['register'])){
                if(empty($_POST['reg_img']) || empty($_POST['reg_username']) || empty($_POST['reg_email']) || empty($_POST['reg_pwd'])){
                    header("Location: register.php?emptyFields=1");
                }else{
                    $userImg = $_POST['reg_img'];
                    $regUsername = $_POST['reg_username'];
                    $regEmail = $_POST['reg_email'];
                    $regPwd = $_POST['reg_pwd'];

                    $newUser = new User();
                    $newUser->register($userImg, $regUsername, $regEmail, $regPwd);
                }
                
            }else{
                echo "";
            }
        ?>
    </div>
</body>
</html>