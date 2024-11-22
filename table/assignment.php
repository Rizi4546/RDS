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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table thead {
            background-color: #4CAF50;
            color: white;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #ddd;
            transition: background-color 0.3s ease;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #555;
        }

        .back-link {
            display: inline-block;
            margin: 20px 0;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
        }

        .back-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assignment Table</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Assignment ID</th>
                        <th>Assignment Title</th>
                        <th>Course ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["assignment_id"]); ?></td>
                            <td><?= htmlspecialchars($row["assignment_name"]); ?></td>
                            <td><?= htmlspecialchars($row["course_id"]); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No assignments found.</p>
        <?php endif; ?>

        <a href="../dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
