<div class="container-fluid">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
      <li class="nav-item my-auto">
        <a class="navbar-brand my-auto" href="#">
          <img src="images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
          <span class="logoName">bruhbook</span>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse mx-auto" id="navbarTogglerDemo01">

      <!-- search bar -->
      <div class="searchBar mx-auto pl-5">
        <form class="form-inline">
          <input class="form-control mr-sm-2 inputField" type="search" placeholder="Search" aria-label="Search">
          <button class="btn my-2 my-sm-0 searchBtn" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>

      <!-- BUTTONS AND PROFILE PIC LIST -->
      <ul class="navbar-nav">
        <!-- buttons -->
        <li class="nav-item my-auto buttonsLi">
          <div class="navButtons">
            <a href="#"><i class="fas fa-comment-dots fa-2x mr-3"></i></a>
            <a href="#"><i class="fas fa-bell fa-2x"></i></a>
          </div>
        </li>

        <!-- profile pic -->
        <li class="nav-item dropdown my-auto profilePicLi">

          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="navProfilePic"></div>
            <span class="navUserName">Person</span>
          </a>

          <div class="dropdown-menu dropdown-menu-right navUserDropdown" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <div class="empty">-</div> 

            <a class="dropdown-item" href="#">Log out</a>
          </div>
        </li>


      </ul>

    </div>
  </nav>
</div>