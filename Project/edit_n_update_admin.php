
<!-- FOR SEARCHING FEATURE -->
<?php include("includes/dbcon.php") ?>
<?php session_start() ?>

<?php
if (isset($_POST['update_profile'])) {
    $name_ = $_POST['name'];
    $std_id_ = $_POST['student_id'];
    $email_ = $_POST['email'];
    $phone_ = $_POST['phone'];
    $new_pass_ = $_POST['new_password'];
    $conf_pass_ =  $_POST['con_password'];

    if (empty($new_pass_) && empty($conf_pass_)) {
        // Both password fields are empty
        $query = "UPDATE admin SET  name = '$name_', email = '$email_', phone = '$phone_' WHERE student_id = '$std_id_' ";
        $run_query = mysqli_query($con, $query);
        if ($run_query) {
            $_SESSION['status'] = 'Profile Updated Successfully!';
            header('location:home_pg.php');
            exit;
        } else {
            $_SESSION['status'] = 'Profile Update Failed! Try again.';
            header('location:update_admin_profile.php?student_id='.urlencode($std_id_));
            exit;
        }
    } elseif (!empty($new_pass_) && empty($conf_pass_)) {
        // New password provided but confirm password is empty
        $_SESSION['status'] = 'Confirm your new password and try again.';
        header('location:update_admin_profile.php?student_id='.urlencode($std_id_));
        exit;
    } elseif (empty($new_pass_) && !empty($conf_pass_)) {
        // New password is empty but confirm password is provided
        $_SESSION['status'] = 'Please provide a password first.';
        header('location:update_admin_profile.php?student_id='.urlencode($std_id_));
        exit;
    } else {
        if ($new_pass_ != $conf_pass_) {
            // New password and confirm password do not match
            $_SESSION['status'] = 'Passwords do not match.';
            header('location:update_admin_profile.php?student_id='.urlencode($std_id_));
            exit;
        } else {
            // Update the profile with the new password
            $query = "UPDATE admin SET  name = '$name_', email = '$email_', phone = '$phone_', password = '$conf_pass_' WHERE student_id = '$std_id_' ";
            $run_query = mysqli_query($con, $query);
            if ($run_query) {
                $_SESSION['status'] = 'Profile Updated Successfully!';
                header('location:home_pg.php');
                exit;
            } else {
                $_SESSION['status'] = 'Profile Update Failed! Try again.';
                header('location:update_admin_profile.php?student_id='.urlencode($std_id_));
                exit;
            }
        }
    }
}
?>
