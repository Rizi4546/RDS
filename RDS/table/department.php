<?php
session_start();
include('C:/xampp/htdocs/RDS/config.php');
if (!isset($_SESSION['username'])) {
    header("C:/xampp/htdocs/RDS/login.php");
    exit();
}

$sql = "SELECT * FROM department";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Department Table</title>
</head>
<body>
<h2>Department Table</h2>
<table>
    <tr>
        <th>Department ID</th>
        <th>Department Name</th>
        <th>Faculty ID</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["department_id"] . "</td><td>" . $row["department_name"] . "</td><td>" . $row["faculty_id"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
