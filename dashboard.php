<?php
session_start();
include('config.php'); // Ensure database connection is included

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
    <link rel="stylesheet" href="styles/style.css">
    <title>Dashboard</title>
</head>
<body>
<h2>Dashboard</h2>

<!-- Display Example Statistics -->
<div class="stats-container">
    <div>Total Students: <?php echo $total_students; ?></div>
    <div>Total Courses: <?php echo $total_courses; ?></div>
</div>

<!-- Links to Tables -->
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

<!-- Logout Button -->
<a href="logout.php">Logout</a>
</body>
</html>