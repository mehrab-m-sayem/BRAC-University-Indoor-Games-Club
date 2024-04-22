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
    if (strlen($_POST["password"]) < 4) {
        die("Password must be at least 4 characters");
    }

    // if ($_POST["password"] !== $_POST["password_confirmation"]) {
    //     die("Passwords does not match, try again");
        
    // }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        echo "Passwords do not match, try again. <a href='reset-password.php'>Go back to reset password</a>";
        exit;
    }

    
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password_hash = ? WHERE email = ?";

    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $password_hash, $user_email);
    $stmt->execute();
    header('Location: get-profile.php');
    // echo "Password updated successfully.";
    exit;
}

// Display form to enter new password
echo '<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 1.5em; /* Increase font size */
        }
        form {
            width: 100%;
        }
        label {
            display: block;
            margin-top: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <h1>Reset Password</h1>
    
    <form method="POST">
        <label>
            New Password
            <input type="password" name="password">
        </label>
        <label>
            Confirm New Password
            <input type="password" name="password_confirmation">
        </label>
        <button type="submit">Reset Password</button>
    </form>
    
</body>
</html>';
?>