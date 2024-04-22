
<?php session_start() ?>

<!-- destroy session var -->

<!-- first unset session -->
<?php session_unset() ?>


<!-- now session destroy -->
<?php session_destroy() ?>


<?php
header('location:login_admin_pg.php') 
?>

