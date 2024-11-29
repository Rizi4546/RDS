<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['register'])) {
    // Retrieve form inputs
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $department_id = $_POST['department_id'];

    // Check if the department ID exists
    $stmt = $conn->prepare("SELECT * FROM department WHERE department_id = ?");
    $stmt->bind_param("s", $department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $registerError = "Invalid department ID.";
    } else {
        // Check if the student already exists
        $stmt = $conn->prepare("SELECT * FROM student WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $registerError = "Student already exists.";
        } else {
            // Insert the new student into the database
            $stmt = $conn->prepare("INSERT INTO student (student_id, first_name, last_name, email, department_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $student_id, $first_name, $last_name, $email, $department_id);

            if ($stmt->execute()) {
                $registerSuccess = "Student added successfully.";
            } else {
                $registerError = "Student addition failed. Please try again.";
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 32px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
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
    <div class="container">
        <h1>Student Management System</h1>
        <!-- Registration Form -->
        <form method="POST" class="form">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="department_id">Department ID</label>
            <input id="department_id" name="department_id" required>
                
            </input>

            <button type="submit" name="register">Register</button>
            <?php
            if (isset($registerError)) echo "<p class='error'>$registerError</p>";
            if (isset($registerSuccess)) echo "<p class='success'>$registerSuccess</p>";
            ?>
        </form>
        <div>
            <a class="btn-back" href="table/student.php">Student Table</a>
        </div>
    </div>
</body>
</html>
