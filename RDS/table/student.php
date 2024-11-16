<?php
session_start();
include('C:/xampp/htdocs/RDS/config.php');
if (!isset($_SESSION['username'])) {
    header("C:/xampp/htdocs/RDS/login.php");
    exit();
}

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Student Table</title>
</head>
<body>
<h2>Student Table</h2>
<table>
    <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Department ID</th>
        <th>Email</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["student_id"] . "</td><td>" . $row["student_name"] . "</td><td>" . $row["department_id"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
