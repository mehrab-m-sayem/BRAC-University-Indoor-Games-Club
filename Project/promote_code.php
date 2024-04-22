<?php include("includes/dbcon.php") ?>
<?php session_start() ?>


<?php
$rank = array(
    "General Member",
    "Sub Executive",
    "Executive",
    "Senior Executive",
    "Assistant Director",
    "Director",
    "General Secretary",
    "Secretary",
    "President"
);

$max_rank = 8;

if (isset($_GET['student_id'])) {
    // echo $_GET['student_id'];
    // echo "<br>".$rank[4];
    $id_is = $_GET['student_id'];
    $query_desig = "SELECT designation FROM user WHERE student_id = $id_is";
    $res_execute = mysqli_query($con, $query_desig);
    $asso_desig = mysqli_fetch_assoc($res_execute);
    $current_desig = $asso_desig['designation'];

    $index_curr_desig = array_search($current_desig, $rank);
    // echo $index_curr_desig;

    // echo var_dump($rank);
    if ($index_curr_desig < $max_rank) {
        $p_indx = $index_curr_desig + 1;
        // echo 'new index ranl: '.$p_indx;
        $new_desig = $rank[$p_indx];
        //  got new designation
        // echo 'new rankk: '.$new_desig;
        $new_query_desig = "UPDATE user SET designation = '$new_desig' WHERE student_id = $id_is";
        $final_execute = mysqli_query($con, $new_query_desig);
        // 
        $_SESSION['status'] = 'ID: '.$id_is.' Action: Promoted Successfully!';
        // 
        header('location:memberx_data.php');
        exit;
        // echo 'update successfullly';
        // exit;
    } else {
        // echo 'Highest rank reached!';
        // 
        $_SESSION['status'] = 'Highest rank reached!';
        // 
        header('location:memberx_data.php');
        exit;
    }
} else {
    echo "not found";
}
?>
