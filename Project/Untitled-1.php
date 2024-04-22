<?php
// Retrieve form data
$name = $_POST['name'];
$id = $_POST['id'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$activity = $_POST['activity'];

// Perform booking processing here (e.g., save to database)

// Redirect back to the form page
header("Location: event_form.php");
exit();
?>
