<?php
session_start();
include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}



// Handle Delete operation
if (isset($_GET['delete'])) {
    $student_id = $_GET['delete'];

    $sql = "DELETE FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    $stmt->execute();
    $stmt->close();
    header("Location: student.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        input[type="text"] {
            width: 60%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #4CAF50;
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

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.2em;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body> 
    <h1>Search for Students</h1>
    <form method="POST" action="">
        <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Enter student name or ID" required>
        <button type="submit">Search</button>
    </form>
    

    <?php
    if ($result->num_rows > 0) {
        
        // Display search results in a table
        echo'<h2>Search for Students</h2>';
        echo '<table>';
        echo '<tr><th>Student ID</th><th>Name</th><th>Department ID</th><th>Email</th></tr>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["student_id"] . "</td><td>" . $row["first_name"] . " " . $row["last_name"] . "</td><td>" . $row["department_id"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
        echo '</table>';
    } else {
        echo '<p>No results found.</p>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
