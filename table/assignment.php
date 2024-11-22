<?php
session_start();
include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM assignment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Assignment Table</title>
</head>
<body>
<h2>Assignment Table</h2>
<table>
    <tr>
        <th>Assignment ID</th>
        <th>Assignment Title</th>
        <th>Course ID</th>
        <th>Due Date</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["assignment_id"] . "</td><td>" . $row["assignment_name"] . "</td><td>" . $row["course_id"] . "</td><td>" .  "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
