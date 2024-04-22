<!-- FOR SEARCHING FEATURE -->
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
    <title>Home- Admin</title>
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

    <div class="container mt-4">
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

        <div class="row ">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4>Edit Admin Profile</h4>
                    </div>
                    <div class="card-body bg-dark bg-gradient text-white">

                        <?php
                        // CHECKING LOGIN SUCCESSFUL OR NOT ( needed for SESSION must)
                        if (isset($_GET['student_id'])) {
                            // $id_ = $_GET['student_id'];
                            // before sending to the db we need to protect it ( protects sql injection)
                            $id_ = mysqli_real_escape_string($con, $_GET['student_id']);
                            $query = "SELECT * FROM admin Where student_id = '$id_'";
                            $qur_run = mysqli_query($con, $query);
                            //  check any record exist or not
                            if (mysqli_num_rows($qur_run) > 0) {
                                $user_admin = mysqli_fetch_assoc($qur_run);
                        ?>
                                <form action="edit_n_update_admin.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?= $id_ ?>">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?= $user_admin['name'] ?>" class="form-control bg-dark text-white">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label>Student ID</label>
                                        <input type="text" name="student_id" value="<?= $user_admin['student_id'] ?>" class="form-control bg-dark bg-gradient text-white">
                                    </div> -->
                                    <div class="mb-3">
                                        <label>Personal Email</label>
                                        <input type="email" name="email" value="<?= $user_admin['email'] ?>" class="form-control bg-dark text-white">
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="<?= $user_admin['phone'] ?>" class="form-control bg-dark bg-gradient text-white">
                                    </div>
                                    <div class="mb-3">
                                        <label>New Password</label>
                                        <input type="text" name="new_password" value="" class="form-control bg-dark text-white">
                                    </div>
                                    <div class="mb-3">
                                        <label>Confirm New Password</label>
                                        <input type="text" name="con_password" value="" class="form-control bg-dark bg-gradient text-white">
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-outline-secondary bg-dark text-white" type="reset" value="Reset"> Reset</button>
                                        <button type="submit" name="update_profile" class="btn btn-primary" style="float: right"> Confirm </button>

                                    </div>
                                </form>
                        <?php
                            } else {
                                // doesnt exist any such record 
                                echo "<h4>No such data</h4>";
                            }
                        } else {
                            echo 'nothing';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>