<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Welcome to iDiscuss - Coding forums!</title>
</head>

<body>
    <?php include "partials/_header.php";?>
    <?php include "partials/_dbconnect.php";?>

    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `thread` WHERE thread_id = $id";
        $result = mysqli_query($conn , $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
        }

    ?>
     <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            # insert record comment database

            $comment = $_POST['comment'];
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `thread_by`, `comment_time`) VALUES ('$comment', '$id', '$user_id', current_timestamp());";
            $result = mysqli_query($conn , $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Comment has been added Successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            

        }

    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title?></h1>
            <p class="lead"><?php echo $desc?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.</p>
            <!-- <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a> -->
            <?php
            if(!isset($_SESSION['loggedin']) && !isset($_SEESION['name'])){

            }
            else{
                ?>
                <p>Posted By:-<b><?php echo $_SESSION['name']; ?></b></p>
                <?php
            }
            ?>
        </div>

        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                echo '<div class="container">
                    <h2 class="py-2">Post a Comment</h2>
                    <form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Type your Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <p type="hidden" name="user_id" value="'.$_SESSION['user_id'].'"></p>
                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>
                </div>';    
            }
            else{
                echo '<div class="alert alert-primary" role="alert">
                <h2 class="py-2">Post a Comment</h2>
                You are not Loggedin!
              </div>';
            }
        ?>

        <div class="conatiner my-3">
            <h2 class="py-2">Discussions</h2>
            <?php
                $id = $_GET['threadid'];
                $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
                $result = mysqli_query($conn , $sql);
                $noResult = true;
                while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $id = $row['comment_id'];
                    $content = $row['comment_content'];
                    $comment_time = $row['comment_time'];

                    $thread_user_id = $row['thread_by'];
                    $sql2 = "SELECT `user_email`,`name` FROM `users` WHERE user_id ='$thread_user_id'";
                    $result2 = mysqli_query($conn , $sql2);
                    $row2 = mysqli_fetch_assoc($result2);


                    echo '<div class="media my-3">
                        <img src="images/userDefault.png " width=54px class="mr-3" alt="...">
                        <div class="media-body">
                        <p class="font-weight-bold my-0">Posted By-'.$row2['name'] .' at <span class="badge badge-success">'.$comment_time.'</span></p>
                        ' . $content .'
                        </div>
                        
                    </div>';
                    
                }

            if($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Results Found</p>
                    <p class="lead">Be the First person to ask a question</p>
                </div>
            </div>';
            }
        ?>



        </div>
    </div>
    <?php include "partials/_footer.php";?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>