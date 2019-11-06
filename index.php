<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'includes/head_tag-inc.php' ?>
    <link rel="icon" href="images/bruhbook_icon.ico" type="image/x-icon">
    <title>Bruhbook</title>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">

        <!-- left container -->
        <div class="col-12 col-md-3 leftContainer">

          <!-- logo (responsive only) -->
          <div class="responsiveLogo">
              <img src="images/logo.jpg" class="" alt="">
              Bruhbook
          </div>

          <!-- Header -->
          <div class="leftContainerHeader">
            Login/register
          </div>

          <!--  Form -->
          <div class="logInContainer">
            <form class="" action="index.html" method="post">
              <div class="form-group">
                <label for="usernameInput">Username</label>
                <input type="text" name="" value="" class="form-control" id="usernameInput">
              </div>
              <br>

              <div class="form-group">
                <label for="usernameInput">Password</label>
                <input type="text" name="" value="" class="form-control" id="usernameInput">
              </div>

              <br>
              <div class="loginWarning">
                Email or password not correct
              </div>
              <br>

              <div class="form-group">
                <button type="submit" class="btn btn-primary logInBtn">Log in</button>
              </div>

            </form>
          </div>

          <div class="createAcc">
            <div>Don't have an account yet?<br /> <a href="#" class="createAccLink">Click here to register!</a> </div>
          </div>
        </div>



        <!-- right container -->
        <div class="col-12 col-md-9 rightContainer">

          <!-- da big logo  -->
          <div class="bruhbookLogo_index">
            <div class="bbLogo">
              <img src="images/logo.jpg" class="" alt="">
            </div>
            <div class="bruhbookName_index">
              Bruhbook
            </div>
          </div>

          <!-- slogan -->
          <div class="slogan_index">
            Something something slogan idk
          </div>

          <!-- content -->
          <div class="content_index">
            <div class="row">
              <div class="col-12 col-md-4 imgBox justify-content-end">
                <img src="images/example_index_img.jpg" class="img-responsive img-thumbnail" alt="">
                <br>
                <div class="imgDesc">
                  Share moments
                </div>
              </div>
              <div class="col-12 col-md-4 imgBox ">
                <img src="images/example_index_img.jpg" class="img-responsive img-thumbnail" alt="">
                <br>
                <div class="imgDesc">
                  Exchange messages
                </div>
              </div>
              <div class="col-12 col-md-4 imgBox ">
                <img src="images/example_index_img.jpg" class="img-responsive img-thumbnail" alt="">
                <br>
                <div class="imgDesc">
                  Like and comment
                </div>
              </div>
            </div>

            <!-- footer -->
            <div class="index_footer">
              Bruhbook bruh - 2019
              <br>
              GitHub: <a href="#">github.com/qwehbrubruhqweqwe</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
