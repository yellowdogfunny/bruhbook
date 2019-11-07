<?php
session_start();
if(isset($_SESSION['logged_user'])){
    echo "<h1>PAGE 2</h1><br><br><p>You are logged in as: ".$_SESSION['logged_user']." </p>";
    
    echo "<hr>bruhhhh";
    
}else{
    echo "Noone is logged in rn";
}
