<?php
session_start();
include('C:/xampp/htdocs/RDS/config.php');
if (!isset($_SESSION['username'])) {
    header(" C:/xampp/htdocs/RDS/login.php");
    exit();
}

$sql = "SELECT * FROM attendance_status";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Attendance Status Table</title>
</head>
<body>
<h2>Attendance Status Table</h2>
<table>
    <tr>
        <th>Status ID</th>
        <th>Status Description</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["status_id"] . "</td><td>" . $row["description"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
