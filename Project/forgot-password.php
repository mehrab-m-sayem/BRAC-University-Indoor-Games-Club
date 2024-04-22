<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s' AND student_id = '%s'",
                   $mysqli->real_escape_string($_POST["email"]),
                   $mysqli->real_escape_string($_POST["student_id"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        
        $sql = sprintf("UPDATE user SET password_hash = '%s' WHERE member_id = %d",
                       $mysqli->real_escape_string($new_password),
                       $user["member_id"]);
        
        $mysqli->query($sql);
        
        header("Location: user_login.php");
        exit;
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Reset Password</h1>
    
    <?php if (isset($is_invalid) && $is_invalid): ?>
        <em>Invalid email or student ID</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="student_id">Student ID</label>
        <input type="text" name="student_id" id="student_id"
               value="<?= htmlspecialchars($_POST["student_id"] ?? "") ?>">
        
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password">
        
        <button>Reset Password</button>
    </form>
    
</body>
</html>