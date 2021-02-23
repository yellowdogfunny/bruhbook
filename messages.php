
<?php
session_start();
include 'includes/class-autoloader.php';

$user = new User();
if(isset($_GET['username'])){
  $username = $_GET['username'];
}else if(isset($_SESSION['logged_user'])){
  $username = $_SESSION['logged_user'];
}else{
  header("Location: index.php");
}

if($_SESSION['logged_user'] != $username){
  $postsHeader = "Posts";
}else{
  $postsHeader = "My posts";
}

?>
<html lang="en">
  <head>
    <?php
      include "includes/head_tag-inc.php";
    ?>
    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">

    <title>Bruhbook</title>
  </head>

  <body>
    <?php include "includes/main_navbar-inc.php"; ?>
    <div class="container contentContainer">

      <hr>
      <!-- Header 2 container -->
      <div class="partHeader">
        Messages
      </div>

      <div class="row messagesContainer">

        <div class="col-3 peopleDiv">
          <?php
            $people = new Message();
            $people->listPeople();
          ?>
          <!--  LIST OF PEOPLE TO CHAT WITH   -->

          <!-- People
          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/images.jpg" alt="">
            </div>
            <div class="personName">Person 1</div>
          </div>


          <div class="personContainer">
            <div class="personImg">
              <img src="images/hbru.jpg" alt="">
            </div>
            <div class="personName">Person 2</div>
          </div>
        -->
        </div>



        <!-- CHAT -->
        <div class="col-9 messagesDiv">

          <!-- Selected person -->
          <div class="chatName">
            <div class="chatNameImg">
              <img src="images/images.jpg" alt="">
            </div>

            <span class="chatName-name">
              Person 1
            </span>
          </div>


          <!-- Chat -->
          <div class="chatBox">
            <!--message-->
            <!--
            <div class="message friendmsg">
              <div class="msgtxtDivFriend msgFriend">woah hbru man bro bruh bruh bruhhhhhh  </div>
            </div>
            -->

            <!--message-->
            <!--
            <div class="message loggedusermsg">
              <div class="msgtxtDivLoggedUser msgLoggedUser">woah hbru man bro bruh bruh bruhhhhhh  </div>
            </div>
            -->

            <!--message-->
            <!--
            <div class="message friendmsg">
              <div class="msgtxtDivFriend msgFriend">yea  </div>
            </div>
            -->

            <!--message-->
            <!--
            <div class="message friendmsg">
              <div class="msgtxtDivFriend msgFriend">woaruh bruhhhhhh  </div>
            </div>
            -->

            <!--message-->
            <!--
            <div class="message loggedusermsg">
              <div class="msgtxtDivLoggedUser msgLoggedUser">hahahahhahhahha vro bnruhbruh</div>
            </div>
            -->

            <!--message-->
            <!--
            <div class="message loggedusermsg">
              <div class="msgtxtDivLoggedUser msgLoggedUser">Bruh</div>
            </div>
            -->
          </div>





          <div class="messageInputFieldDiv">
            <input type="text" name="" value="" class="form-control messageInputField">
            <input type="button" class="btn btn-danger sendMsgBtn" name="" value="->">
          </div>

        </div>

      </div>

    </div>
  </body>

</html>
