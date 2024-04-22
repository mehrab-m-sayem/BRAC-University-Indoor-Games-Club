<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}

require __DIR__ . '/database.php';

// Assuming session contains the user email to fetch the profile
$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $gsuite_email = $_POST['gsuite_email'];

    $sql = "UPDATE user SET name = ?, student_id = ?, email = ?, gsuite_email = ? WHERE email = ?";

    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sssss", $name, $student_id, $email, $gsuite_email, $user_email);
    $stmt->execute();

    // Update session email if email was changed
    if ($email !== $user_email) {
        $_SESSION['email'] = $email;
    }
    header('Location: get-profile.php');
    // echo "Profile updated successfully.";
    exit;
}

// Fetch current user data
$sql = "SELECT name, student_id, email, gsuite_email FROM user WHERE email = ?";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    echo 'No user data found.';
    exit;
}

// Display form with current user data
echo '<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Update Profile</h1>
    
    <form method="POST">
        <label>
            Name
            <input type="text" name="name" value="' . htmlspecialchars($userData['name']) . '">
        </label>
        <label>
            Student ID
            <input type="text" name="student_id" value="' . htmlspecialchars($userData['student_id']) . '">
        </label>
        <label>
            Email
            <input type="email" name="email" value="' . htmlspecialchars($userData['email']) . '">
        </label>
        <label>
            G Suite Email
            <input type="email" name="gsuite_email" value="' . htmlspecialchars($userData['gsuite_email']) . '">
        </label>
        <button type="submit">Update Profile</button>
    </form>
    
</body>
</html>';
?>