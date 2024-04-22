<?php include("includes/dbcon.php") ?>
<!--  MUST START SESSIION IF USE IT -->
<?php session_start(); ?>



<?php
// if(isset($_POST["login"])){ ( not run)

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //  uname will be my id - just naming a varibale
    $uname = $_POST['Userid'];
    $email = $_POST['Email'];
    $pass = $_POST['Pass'];
    // echo "Name is: ".$uname." Email at: ".$email." Password: ".$pass;
}
// else{
//     echo "No";
// }
// echo "<br>";

//  now check whether we can add or not!

$query = "SELECT * FROM `admin` WHERE `student_id` = '$uname' AND `gsuite_email` = '$email' AND `password` = '$pass'";


//  now execute $query
$result = mysqli_query($con, $query);


//  now check what you get
// if for > checking empty or not
if (!$result){
    die("Query Failed");
    // echo var_dump($result);
}
else{
    $row = mysqli_num_rows($result);
    // echo $row; ( code ok )
    if ($row == 1){
        $_SESSION['u_name'] = $uname;
        $_SESSION['u_email'] = $email;
        $_SESSION['u_std_id'] = $student_id;
        header('location:home_pg.php?student_id='.urlencode($uname));
    }
    else{
        // Can't Log in - retry login
        header('location:login_admin_pg.php?message= Your given information is not valid');
    }

}
?>



