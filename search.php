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
    <style>
    .container {
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <?php include "partials/_header.php";?>
    <?php include "partials/_dbconnect.php";?>


    <!-- search results starts from here -->
    <div class="container mt-4">
        <h1 class="text-center">Search Results for <em>"<?php echo $_GET['search'];?>"</em></h1>

        <?php
            $query = $_GET["search"];
            $sql = "select * from thread where match (thread_title , thread_desc) against ('$query')";
            $res = mysqli_query($conn , $sql);
            $totalResult = mysqli_num_rows($res);
            while($rw = mysqli_fetch_array($res)){
                $title = $rw['thread_title'];
                $desc = $rw['thread_desc'];
                $thread_id = $rw['thread_id'];
                $url = "thread.php?threadid=".$thread_id;

            ?>
        <?php
                if($totalResult > 0){
                    ?>
                    <div class="container text-center">
                        <div class="search">
                            <h3><a href="<?php echo $url;?>"><?php echo $title;?></a></h3>
                            <p><?php echo $desc;?></p>
                        </div>
                    </div>
        <?php
                }
                else{
                    ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $title;?></h1>
                <p class="lead">"<?php echo $url;?>
                </p>
            </div>
        </div>
        <?php
                }
            
                ?>
                <?php
            }
            ?>
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