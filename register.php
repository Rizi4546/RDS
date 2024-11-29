<?php
session_start();
include('config.php');
if (isset($_POST['register'])) {
    // Registration functionality
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

// Check if username exists
$result = $conn->query("SELECT * FROM users WHERE username='$newUsername'");

if ($result->num_rows > 0) {
    $registerError = "Username already exists.";
} else {
    // Insert new user
    if ($conn->query("INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')")) {
        $registerSuccess = "Registration successful! You can now log in.";
    } else {
        $registerError = "Registration failed. Please try again.";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .toggle {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .toggle a {
            color: #4CAF50;
            text-decoration: none;
        }

        .toggle a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Management System</h1>
        <!-- Registration Form -->
        <form method="POST" class="form">
            <label for="new_username">New Username</label>
            <input type="text" id="new_username" name="new_username" required>

            <label for="new_password">New Password</label>
            <input type="text" id="new_password" name="new_password" required>

            <button type="submit" name="register">Register</button>
            <?php
            if (isset($registerError)) echo "<p class='error'>$registerError</p>";
            if (isset($registerSuccess)) echo "<p class='success'>$registerSuccess</p>";
            ?>
        </form>

        <div class="toggle">
            <p>Already have an account? <a href="Login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
