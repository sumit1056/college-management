<?php
include 'connection.php';

// print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $className = mysqli_real_escape_string($conn, $_POST['class_name']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $teacher = mysqli_real_escape_string($conn, $_POST['teacher']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    // Retrieve session email
    session_start();
    $sessionemail = $_SESSION['email'];

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO time_table (class_name, value_id_name, data_time, teacher_name, subject_name, Date, delete_by) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        // Handle the error if the statement preparation fails
        die('Error: ' . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssss", $className, $week, $time, $teacher, $subject, $date, $sessionemail);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo 'Success';
    } else {
        // Handle the error
        die('Error: ' . mysqli_stmt_error($stmt));
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
