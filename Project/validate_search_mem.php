
<!-- FOR SEARCHING FEATURE -->
<?php include("includes/dbcon.php") ?>
<?php session_start() ?>

<?php
// CHECKING LOGIN SUCCESSFUL OR NOT ( needed for SESSION must)
if (isset($_SESSION['u_name']) != true) {
    header('location:login_admin_pg.php?message= Please login first!');
} else {
    // here all the work
    //  first check- input faka naki
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $s_id = $_POST['send_id'];
        // if (strlen($s_id) > 0){
        if (!empty($s_id)) {
            // something in here
            echo 'Not faka<br>';
            $query = "SELECT * FROM user WHERE student_id = '$s_id'";
            $query_run = mysqli_query($con, $query);
            if (mysqli_num_rows($query_run) > 0) {
                // echo "paisi";
                header('location:search_mem.php?student_id='.urlencode($s_id));
            } else {
                // echo "pai nai";
                $_SESSION['status'] =  'Action: ID not found.';
                header('location:memberx_data.php');
                exit;
            }
        } else {
            // echo 'faka';
            $_SESSION['status'] =  'Action: Please provide an valid id.';
            header('location:memberx_data.php');
            exit;
        }
    }
}
?>
