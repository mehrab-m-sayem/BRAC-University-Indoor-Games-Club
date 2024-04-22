<?php
include 'connect2.php';
if (isset($_GET['deleteid'])){
    $student_id=$_GET['deleteid'];

    $sql="delete from payment where student_id=$student_id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "Deleted successfully. Back to privious page and refresh it.";
    }else{
        die(mysqli_error($conn));
    }
}
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student Payment</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <h1>Delete Student Payment</h1>
    <a href="displaypayment.php"><button>Go to the previous page</button></a>
    <script>
        setTimeout(function () {
            location.reload();
        }, 5000);
    </script>
</body>
</html>