<?php
include 'connection.php';

// Debugging: Print received POST data
print_r($_POST);

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $userId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $classId = $_POST['class_id'];
    $subjectId = $_POST['subject_id'];

    // Update query using prepared statement
    $updateQuery = "UPDATE users SET name=?, email=?, class_id=?, subject_id=? WHERE id=?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $updateQuery);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $classId, $subjectId, $userId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating data: ' . mysqli_error($conn)]);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation failure
        echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed']);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle non-POST requests
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
