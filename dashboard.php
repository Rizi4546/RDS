<?php
session_start();
include('config.php');

// Redirect if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch some example data from the database (optional)
$sql = "SELECT COUNT(*) AS total_students FROM student";
$result = $conn->query($sql);
$total_students = $result->fetch_assoc()['total_students'] ?? 0;

$sql_courses = "SELECT COUNT(*) AS total_courses FROM course";
$result_courses = $conn->query($sql_courses);
$total_courses = $result_courses->fetch_assoc()['total_courses'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 28px;
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
            background: #c9302c;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .stats div {
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }

        .stats div h3 {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        .stats div p {
            font-size: 24px;
            color: #4CAF50;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .stats {
                flex-direction: column;
            }

            .stats div {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

        <div class="stats">
            <div>
                <h3>Total Students</h3>
                <p><?php echo htmlspecialchars($total_students); ?></p>
            </div>
            <div>
                <h3>Total Courses</h3>
                <p><?php echo htmlspecialchars($total_courses); ?></p>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="table/assignment.php">Assignment Table</a></li>
                <li><a href="table/attendance.php">Attendance Table</a></li>
                <li><a href="table/attendance_status.php">Attendance Status Table</a></li>
                <li><a href="table/classroom.php">Classroom Table</a></li>
                <li><a href="table/class_schedule.php">Class Schedule Table</a></li>
                <li><a href="table/course.php">Course Table</a></li>
                <li><a href="table/department.php">Department Table</a></li>
                <li><a href="table/enrollment.php">Enrollment Table</a></li>
                <li><a href="table/grade.php">Grade Table</a></li>
                <li><a href="table/instructor.php">Instructor Table</a></li>
                <li><a href="table/program.php">Program Table</a></li>
                <li><a href="table/semester.php">Semester Table</a></li>
                <li><a href="table/student.php">Student Table</a></li>
                <li><a href="table/subject.php">Subjects Table</a></li>
                <li><a href="table/submission.php">Submission Table</a></li>
            </ul>
        </nav>

        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>
