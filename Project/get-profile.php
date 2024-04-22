<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: user_login.php');
    exit;
}

require __DIR__ . '/database.php';

// Assuming session contains the user email to fetch the profile
$user_email = $_SESSION['email'];

$sql = "SELECT name, student_id, email, gsuite_email, designation, merit, demerit FROM user WHERE email = ?";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Check if user data is available
if ($userData) {
    // Start HTML output
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Member Profile</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body {
            font-size: 1.2em;
        }
        table {
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
    <button> <a href="index.html">Give Feedback or Complain</a> </button>
    <button> <a href="index.php">Home</a> </button>
    <button> <a href="index2.html">Payment for Club Activities</a> </button>
    </div>
    
    <h1>Member Profile</h1>
    
    <table>
        <tr>
            <th>Name</th>
            <td>' . htmlspecialchars($userData['name']) . '</td>
        </tr>
        <tr>
            <th>Student ID</th>
            <td>' . htmlspecialchars($userData['student_id']) . '</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>' . htmlspecialchars($userData['email']) . '</td>
        </tr>
        <tr>
            <th>G Suite Email</th>
            <td>' . htmlspecialchars($userData['gsuite_email']) . '</td>
        </tr>
        <tr>
            <th>Designation</th>
            <td>' . htmlspecialchars($userData['designation']) . '</td>
        </tr>
        <tr>
            <th>Merit</th>
            <td>' . htmlspecialchars($userData['merit']) . '</td>
        </tr>
        <tr>
            <th>Demerit</th>
            <td>' . htmlspecialchars($userData['demerit']) . '</td>
        </tr>
    </table>
    <button type="submit"> <p><a href="logout.php">Log out    </a> </button>
    <button type="submit"><a href="update-profile.php">Update profile</a></button>
    <button type="submit"><a href="reset-password.php">Reset password</a></button>
</body>
</html>';
} else {
    echo 'No user data found.';
}

?>