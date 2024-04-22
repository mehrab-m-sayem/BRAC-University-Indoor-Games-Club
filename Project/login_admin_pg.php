<?php include("includes/dbcon.php") ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <link rel="stylesheet" href="style_login.css">
    <title>BUIGC ADMIN LOGIN PAGE</title>
  </head>


  <body>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <h1>BRAC UNIVERSITY INDOOR GAMES CLUB</h1>

    <div class="container pt-5">
        <!-- <span id="admin_login">Admin Login</span> -->
        <h2 id="admin_login">Admin Login</h2>

        <?php
        if (isset($_GET['message'])) {
            $var = $_GET['message'];
            echo '<h5 class = "login_alert">' . $var . '</h5>';
        }
        ?>

        <!-- form class="form" == boostrap class -->
        <form class="form" action="loginp.php" method="post">
            <div class="form-group">
                <label for="userid"><strong>Admin Id</strong></label>
                <input class="form-control" type="text" name="Userid" id="userid">
            </div>


            <div class="form-group">
                <label for="email"><strong>Official Email</strong></label>
                <input class="form-control" type="email" name="Email" id="email">
            </div>


            <div class="form-group">
                <label for="pass"> <strong>Password</strong> </label>
                <input class="form-control" type="text" name="Pass" id="pass">
            </div>


            <input class="btn btn-success" type="submit" name="login" value="Login">
        </form>
    </div>


  </body>
</html>