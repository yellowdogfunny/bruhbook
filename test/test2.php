<?php
session_start();
if(isset($_SESSION['logged_user'])){
    echo "<h1>PAGE1</h1><br><br><p>You are logged in as: ".$_SESSION['logged_user']." </p>";
    
    echo "<a href = '../php/logout.php'>Sign Out</a>";
    
}else{
    echo "Noone is logged in rn";
}
