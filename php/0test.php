<?php
require_once("../classes/like.class.php");
$user = "bruh";
$post = 63;

$sql_l = "INSERT INTO likes_table (like_user, like_post) VALUES(
  ('$user', '$post')
)";

$conn = mysqli_connect("localhost", "root", "", "bruhbookDB");
mysqli_query($conn, $sql_l);

echo "Post [".$post."] liked by -".$user;
?>
