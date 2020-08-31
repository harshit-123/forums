<?php
session_start();
include '_dbconnect.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/forums">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/forums">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                    $sql = "select * from categories";
                    $res = mysqli_query($conn , $sql);
                    while($rw = mysqli_fetch_array($res)){
                        ?>
                        <a class="dropdown-item" href="threadlist.php?catid=<?php echo $rw['category_id'];?>"><?php echo $rw['category_name']; ?></a>
                       <?php 
                    }
                    ?>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php">ContactUs</a>
        </li>
    </ul>
    <div class="row mx-2">
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        ?>
        <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <a href="/forums/partials/logout.php"class="btn btn-success my-2 my-sm-0 ml-3">Logout</a>
            <h3 class="text-white ml-3"><span class="badge badge-pill badge-success"><?php echo 'Welcome '. $_SESSION['name']; ?></span></h3>
            </form>
            <?php
    }
    else{
        ?>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button class="btn btn-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
        <button class="btn btn-success mx-2" data-toggle="modal" data-target="#signupModal">Sign Up</button>
        <?php
    }
?>
    </div>
</div>
</nav>
<?php
// include "partials/_signupModal.php";
include "partials/_loginModal.php";
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
    ?>
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> You can now login!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
}
?>