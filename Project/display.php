<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<div class="header">
       <button> <a href="home_pg.php">Admin Home</a> </button>
    </div>
<div class="container">
    <button class="btn btn-primary my-5"><a href="index.html"> Add Feedback </a></button>
    <form action="" method="post">
        <input type="text" name="search" placeholder="Search by Student ID">
        <input type="submit" value="Search">
    </form>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">Student_Id</th>
            <th scope="col">Submission_Date</th>
            <th scope="col">Massage</th>
            <th scope="col">Operations</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $sql = "SELECT * FROM feedback WHERE student_id LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM feedback";
        }

        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $student_id = $row['student_id'];
                $submissionDate = $row['SubmissionDate'];
                $feedback = $row['Massage'];
                echo '<tr>
                        <th scope="row">' . $student_id . '</th>
                        <td>' . $submissionDate . '</td>
                        <td>' . $feedback . '</td>
                        <td>
                            <button class="btn btn-primary"><a href="delete.php?deleteid=' . $student_id . '" class="text-light">Delete</a></button>
                        </td>
                    </tr>';
            }
        } else {
            echo "No records found";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
