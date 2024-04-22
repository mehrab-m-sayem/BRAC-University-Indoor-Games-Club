<?php  // Saem code
// check validity of data

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["gsuite_email"])) {
    die("Gsuite email is required");
}

if (strlen($_POST["password"]) < 4) {
    die("Password must be at least 4 characters");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords does not match, try again");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); // security feature

require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, student_id, email, gsuite_email, phone, password_hash)
        VALUES (?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

// checking if the sql statement is valid
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

// binding kortese sql er jonnow
$stmt->bind_param("ssssss",
                  $_POST["name"],
                  $_POST["student_id"], 
                  $_POST["email"],
                  $_POST["gsuite_email"],
                  $_POST["phone"], 
                  $password_hash
            );

            
            
            // executes the sql statement
            try {
                if ($stmt->execute())  {
                    header("Location: signup-success.html");
                    exit;  // if everything is successful, eta show korbe
                } 
            } catch (mysqli_sql_exception $e) {
                if($e->getCode() === 1062){
                    echo "Student ID already registered. <br>";
        echo "<button onclick=\"location.href='signup_gm.html'\">Back to Registration</button>";
        exit;
                } 
                // any other error, check the error code and google it
                else{
                    die($mysqli->error . "  " . $mysqli->errno); 
                }
            }
            
            
            ?>

