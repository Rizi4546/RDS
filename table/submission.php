<?php
session_start();
include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM submission";
$result = $conn->query($sql);

if (!$result) {
    echo "<p>Error: " . $conn->error . "</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Table</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: #fff;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Styling for empty tables */
        .no-records {
            text-align: center;
            font-size: 18px;
            color: #888;
            background-color: #f9f9f9;
            padding: 20px;
            font-weight: bold;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
                overflow-x: auto;
                display: block;
                -webkit-overflow-scrolling: touch;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submission Table</h2>
        <table>
            <tr>
                <th>Submission ID</th>
                <th>Assignment ID</th>
                <th>Student ID</th>
                <th>Submission Date</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["submission_id"] . "</td><td>" . $row["assignment_id"] . "</td><td>" . $row["student_id"] . "</td><td>" . $row["submission_date"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='no-records'>No records found</td></tr>";
            }
            ?>
        </table>
        <a href="../dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>
