<?php  //saem code

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE member_id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>BRAC University Indoor Games Club</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #302c2c;
    }
    .header {
        display: flex;
        justify-content: space-around;
        padding: 20px;
        background-color: #302c2c;
       
    }
    .header a {
        margin: 0 10px;
    }
    .photo {
        width: 100%;
        height: 300px;
        background-color: #ddd;
        margin-bottom: 20px;
    }
</style>
</head>
<body>
    <div class="header">
        <a href="signup_gm.html">Registration</a>
        <a href="user_login.php">User Login</a>
        <a href="home_pg.php">Admin Login</a>
        <a href="index2.html">Payment</a>
        <a href="Untitled-1.html">Event</a>
    </div>
    
    <div class="photo">
        
    <img src="buigc.jpg" alt="buigc pic">
    </div>
    
    <h1 style="text-align: center;">BRAC University Indoor Games Club</h1>
    

    
</body>
</html>