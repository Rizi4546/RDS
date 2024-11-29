<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$searchTerm = '';
$searchResults = [];

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchTerm =   $_POST['search'];
    $searchResults = [];

    // Get all table names except the 'users' table
    $tablesResult = $conn->query("SHOW TABLES");
    while ($tableRow = $tablesResult->fetch_row()) {
        $table = $tableRow[0];

        if ($table !== 'users') { // Restriction to exclude the 'users' table
            // Get column names for the table
            $columnsResult = $conn->query("SHOW COLUMNS FROM $table");
            $conditions = [];
            while ($columnRow = $columnsResult->fetch_assoc()) {
                $conditions[] = "{$columnRow['Field']} LIKE '$searchTerm'";
            }

            if (!empty($conditions)) {
                $sql = "SELECT * FROM $table WHERE " . implode(" OR ", $conditions);
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    $searchResults[$table] = $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }
    }
}





// Function to get column names from a table
function getTableColumns($table) {
    global $conn;
    $columns = [];
    $result = $conn->query("SHOW COLUMNS FROM $table");
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    return $columns;
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

        input[type="text"] {
            width: 50%;
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

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 10px 0;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 18px;
            color: #333;
            background: #e7f3e7;
            padding: 10px 15px;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s, transform 0.3s;
        }

        nav ul li a:hover {
            background: #4CAF50;
            color: white;
            transform: translateX(5px);
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
            text-decoration: underline;
        }
        .dashboard{
            display: block;
            width: fit-content;
            margin: 20px auto 0;
            text-align: center;
            text-decoration: none;
            color: white;
            background: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <form method="POST" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Enter search term" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if (!empty($searchResults)) {
            foreach ($searchResults as $table => $results) {
                if (!empty($results)) {
                    echo '<h2>Results from ' . htmlspecialchars($table) . ' Table</h2>'; 
                    echo '<table>'; 
                    echo '<tr>'; 
                    foreach (array_keys($results[0]) as $header) {
                        echo "<th>" . htmlspecialchars($header) . "</th>";
                    }
                    echo '</tr>';
                    foreach ($results as $row) {
                        echo '<tr>'; 
                        foreach ($row as $value) {
                            echo "<td>" . htmlspecialchars($value) . "</td>";
                        }
                        echo '</tr>';
                    }
                    echo '</table>'; 
                }
            }
        } elseif ($searchTerm) {
            echo '<p>No results found.</p>';
            
        }
        ?>
         <a class="dashboard" href="dashboard.php">Return to Dashboard</a>
         <a class="logout" href="login.php">Logout</a>
        </div>
</body>
</html>