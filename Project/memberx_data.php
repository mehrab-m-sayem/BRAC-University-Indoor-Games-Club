<?php include("includes/dbcon.php") ?>
<?php session_start() ?>

<?php
// CHECKING LOGIN SUCCESSFUL OR NOT ( needed for SESSION must)
if (isset($_SESSION['u_name']) != true) {
    header('location:login_admin_pg.php?message= Please login first!');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Member details</title>
</head>


<body class="bg-dark">
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <?php include("admin_header.php"); ?>


    <div class="container mt-2 tbl-container">
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong> <?php echo $_SESSION['status']; ?> </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>

        <div class="row table-fixed">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">
                        <h4 class="check_that">Member Details
                            <!-- <a href="#" class="btn btn-primary bg-dark float-end">Search</a> -->
                            <form class="d-flex" action="validate_search_mem.php" method="POST">
                                <input class="form-control me-2 bg-dark text-white" type="search" placeholder="Search Id" aria-label="Search" name="send_id">
                                <button class="btn btn-outline-success bg-dark text-white" type="submit">Search</button>
                            </form>
                        </h4>
                        <div class="cardbody">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Student ID</th>
                                        <th>Gsuite</th>
                                        <th>Phone</th>
                                        <th>Designation</th>
                                        <th>Merit/Demerit</th>
                                        <th id="action_col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM user";
                                    $query_run = mysqli_query($con, $query);


                                    if (mysqli_num_rows($query_run) > 0) {
                                        // FOUND NOW LOOP IT FOR DISPLAY
                                        foreach ($query_run as $value) {
                                            // echo $value['name'];
                                    ?>
                                            <tr>
                                                <td> <?= $value['member_id']; ?> </td>
                                                <td> <?= $value['name']; ?> </td>
                                                <td> <?= $value['student_id']; ?> </td>
                                                <td> <?= $value['gsuite_email']; ?> </td>
                                                <td> <?= $value['phone']; ?> </td>
                                                <td> <?= $value['designation']; ?> </td>
                                                <td>
                                                    <?php
                                                    $merit = $value['merit'];
                                                    $demerit = $value['demerit'];
                                                    ?>
                                                    <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow=<?= $merit; ?> aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped bg-success" style="width: <?= $merit ?>%"></div>
                                                    </div>
                                                    <br>
                                                    <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow=<?= $demerit; ?> aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped bg-danger" style="width: <?= $demerit ?>%"></div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <a href="promote_code.php?student_id=<?= $value['student_id']; ?>" class="btn btn-success btn-sm">Promote</a>
                                                    <a href="demote_code.php?student_id=<?= $value['student_id']; ?>" class="btn btn-danger btn-sm">Demote</a>
                                                    <a href="delete_code.php?student_id=<?= $value['student_id']; ?>" class="btn btn-danger btn-sm">Kick</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<h5> NO RECORD FOUND</h5>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("admin_footer.php"); ?>
</body>

</html>