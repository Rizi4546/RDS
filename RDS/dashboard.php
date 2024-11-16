<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/style.css">
    <title>Dashboard</title>
</head>
<body>
<h2>Dashboard</h2>
<ul>
    <li><a href="tables/assignment.php">Assignment Table</a></li>
    <li><a href="tables/attendance.php">Attendance Table</a></li>
    <li><a href="tables/attendance_status.php">Attendance Status Table</a></li>
    <li><a href="tables/classroom.php">Classroom Table</a></li>
    <li><a href="tables/class_schedule.php">Class Schedule Table</a></li>
    <li><a href="tables/course.php">Course Table</a></li>
    <li><a href="tables/department.php">Department Table</a></li>
    <li><a href="tables/enrollment.php">Enrollment Table</a></li>
    <li><a href="tables/grade.php">Grade Table</a></li>
    <li><a href="tables/instructor.php">Instructor Table</a></li>
    <li><a href="tables/program.php">Program Table</a></li>
    <li><a href="tables/semester.php">Semester Table</a></li>
    <li><a href="tables/student.php">Student Table</a></li>
    <li><a href="tables/submission.php">Submission Table</a></li>
    <li><a href="tables/subject.php">Submission Table</a></li>
</ul>
<a href="logout.php">Logout</a>
</body>
</html>
