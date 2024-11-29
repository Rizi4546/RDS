<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header(".. /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .logout {
            display: block;
            width: fit-content;
            margin: 20px auto 0;
            text-align: center;
            text-decoration: none;
            color: white;
            background: #d9534f;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .logout:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        
        <form method="POST" action="dashboard_1.php">
            <button type="submit" name="showTable">Show All Tables</button>
        </form>
        <form method="POST" action="search.php">
            <button type="submit" name="Search">Search</button>
        </form>

        <?php
        ?>
        <a class="logout" href="login.php">Logout</a>
    </div>
</body>
</html>