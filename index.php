
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

      <!-- Post a status container -->
      <div class="postStatusContainer">
        <div class="row">

          <div class="col-12 col-md-9 column_nopadding">
            <div class="form-group">
              <textarea class="form-control postStatusTextarea" placeholder="Post a status..." rows="3" maxlength="350"></textarea>
            </div>
          </div>

          <div class="col-12 col-md-3 column_nopadding postStatusButtonsDiv">
            <div class="row postStatusButtons_center">

              <div class="col-4 col-md-12 column_nopadding">
                <button class="btn btn-danger postStatusButtons" name="">Reset</button>
              </div>

              <div class="col-4 col-md-12 column_nopadding">
                <button class="btn btn-danger postStatusButtons" name="">Upload image</button>
              </div>

              <div class="col-4 col-md-12  column_nopadding">
                <button class="btn btn-danger postStatusButtons" name="">Post</button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <hr>
      <!-- Header 2 container -->
      <div class="partHeader">
        Newsfeed
      </div>

      <!-- Status container -->
      <div class="statusContainer">
        <!-- User who posted a status -->
        <div class="userPostingContainer">

          <div class="userPostingImg">
            <img src="images/images.jpg" alt="">
          </div>

          <div class="userPostingUsername">
            <span class="color_username newsfeed_username">Person 1</span>
            &nbsp;
            <span><i class="fas fa-check-circle"></i></span>
            &nbsp;
            <br>
            <div class="edit_delete_btn_div">
              <span><i class="fas fa-edit"></i></span>
              <span><i class="fas fa-trash-alt"></i></span>
            </div>

          </div>

        </div>

        <hr>

        <!-- da status -->
        <div class="statusText">
          orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with deskto
        </div>

        <hr>

        <!-- status buttons -->
        <div class="statusButtonsContainer">
          <span class="statusButton likeButton">5 &nbsp; <i class="fas fa-heart"></i></span>
          <span class="statusButton commentButton">4 &nbsp; <i class="far fa-comment"></i></span>
        </div>

      </div>







      <!-- Status container 2 -->
      <div class="statusContainer">
        <!-- User who posted a status -->
        <div class="userPostingContainer">

          <div class="userPostingImg">
            <img src="images/logo.jpg" alt="">
          </div>

          <div class="userPostingUsername">
            <span class="color_username newsfeed_username">Person 2</span>
          </div>

        </div>

        <hr>

        <!-- da status -->
        <div class="statusText">
          orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
        </div>

        <hr>

        <!-- status buttons -->
        <div class="statusButtonsContainer">
          <span class="statusButton likeButton">1 &nbsp; <i class="fas fa-heart"></i></span>
          <span class="statusButton commentButton">0 &nbsp; <i class="far fa-comment"></i></span>
        </div>

      </div>







      <!-- Status container 2 -->
      <div class="statusContainer">
        <!-- User who posted a status -->
        <div class="userPostingContainer">

          <div class="userPostingImg">
            <img src="images/logo.jpg" alt="">
          </div>

          <div class="userPostingUsername">
            <span class="color_username newsfeed_username">Person 3</span>
            &nbsp;
            <span><i class="fas fa-check-circle"></i></span>
            &nbsp;
          </div>

        </div>

        <hr>

        <!-- da status -->
        <div class="statusText">
          orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
        </div>

        <hr>

        <!-- status buttons -->
        <div class="statusButtonsContainer">
          <span class="statusButton likeButton">48 &nbsp; <i class="fas fa-heart"></i></span>
          <span class="statusButton commentButton">14 &nbsp; <i class="far fa-comment"></i></span>
        </div>

      </div> <!-- end of status -->

      <div class="loadMoreDiv">
        Load more
      </div>

    </div>
  </body>
</html>
