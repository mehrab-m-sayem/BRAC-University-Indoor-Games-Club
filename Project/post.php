<?php
include 'connect.php';
$student_id = $_POST['student_id'];
$submissionDate = $_POST['submissionDate'];
$feedback = $_POST['feedback'];
if (!is_numeric($student_id) || strlen($student_id) > 8) {
    die("Invalid student ID. Please enter a valid integer (max 8 digits).");
}
$wordCount = str_word_count($feedback);
if ($wordCount > 200) {
    die("Feedback exceeds the maximum word limit (200 words).");
}
$sql = "INSERT INTO feedback (student_id, SubmissionDate, Massage) VALUES ('$student_id', '$submissionDate', '$feedback')";
if ($conn->query($sql) === TRUE) {
    //echo "Feedback submitted successfully!";
    header("Location: indexsuccess.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
