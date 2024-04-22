<?php include("includes/dbcon.php") ?>
<?php session_start() ?>

<?php
if (isset($_GET['student_id'])) {
    $id_is = $_GET['student_id'];
    $query_ = "DELETE FROM payment WHERE student_id = $id_is";
    $res = mysqli_query($con, $query_);

    $query_ = "DELETE FROM user WHERE student_id = $id_is";
    $res = mysqli_query($con, $query_);

    header('location:memberx_data.php');
}






