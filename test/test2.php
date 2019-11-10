<?php
include '../includes/db-inc.php';
include '../includes/user-inc.php';

//session_start();
if(isset($_SESSION['logged_user'])){
    echo "<h1>PAGE1</h1><br><p>You are logged in as: ".$_SESSION['logged_user']." </p>";
    echo "<a href = '../php/logout.php'>Sign Out</a><br><br>";

    $loggedUser = new User();
    //$loggedUser->getLoggedUserData();
    ?>

    <table>
        <tr>
            <td>ID:</td>
            <td><?php echo $loggedUser->getLoggedUserData("user_id"); ?></td>
        </tr>
        <tr>
            <td>IMG:</td>
            <td><?php echo $loggedUser->getLoggedUserData("user_img"); ?></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><?php echo $loggedUser->getLoggedUserData("user_name"); ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $loggedUser->getLoggedUserData("user_email"); ?></td>
        </tr>
    </table>

    <?php
}else{
    echo "Noone is logged in rn";
}
