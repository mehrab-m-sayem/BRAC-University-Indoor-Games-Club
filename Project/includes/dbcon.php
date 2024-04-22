<!--  this file will hold connection to the whole project -->

<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "buindoor";

// creating connection variable
$con = mysqli_connect($hostname, $username, $password, $database);


# check whether connection is built or not
if(!$con){
    die ( "connection failed".mysqli_connect_error());
}
// else{
//     echo "Connection OK";
// }
?>
