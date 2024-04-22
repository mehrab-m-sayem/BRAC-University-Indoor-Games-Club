<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buindoor";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['name'];
$student_id = $_POST['student_id'];
$transactionDate = $_POST['transactionDate'];
$amount = $_POST['amount'];
$purpose = $_POST['purpose'];
$transactionMethod = $_POST['transactionMethod'];



if (!is_numeric($student_id) || strlen($student_id) !== 8) {
    die("Invalid student ID. Please enter a valid integer with exactly 8 digits.");
}

if ($transactionMethod === "online") {
    $transactionId = $_POST['transactionId'];
    $paymentMedium = $_POST['paymentMedium'];
    $sql = "INSERT INTO payment (name, student_id, transactionDate, amount, purpose, transactionId, transactionMethod, paymentMedium)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisdsiss", $name, $student_id, $transactionDate, $amount, $purpose, $transactionId, $transactionMethod, $paymentMedium);
} elseif ($transactionMethod === "offline") {
    $volunteerName = $_POST['volunteerName'];
    $sql = "INSERT INTO payment (name,student_id, transactionDate, amount, purpose, volunteerName, transactionMethod)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisdsis", $name, $student_id, $transactionDate, $amount, $purpose, $volunteerName, $transactionMethod);
}

if ($stmt->execute()) {
    //echo "Payment submitted successfully!";
    header("Location: paymentsuccess.html");
    exit;
} else {
    echo "Error: ";
    exit;
    // . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>