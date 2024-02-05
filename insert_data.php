<?php
// Assuming you have a database connection established
include 'connection.php';

// Check if all required POST values are set
if (isset($_POST['event_role'], $_POST['Student_name'], $_POST['Student_email'], $_POST['event_class'], $_POST['event_subject'], $_POST['Student_password'])) {

    // Retrieve form data
    $role = $_POST['event_role'];
    $name = $_POST['Student_name'];
    $email = $_POST['Student_email'];
    $selectedClass = $_POST['event_class'];
    $selectedSubject = $_POST['event_subject'];
    $password = $_POST['Student_password'];

    // Perform SQL query to insert data into the database
    $query = "INSERT INTO users(roles_id, name, email, class_id, subject_id, password) 
              VALUES ('$role', '$name', '$email', '$selectedClass', '$selectedSubject', '$password')";

    $response = [];

    if (mysqli_query($conn, $query)) {
        // Return success response to the AJAX request
        $response['success'] = true;
    } else {
        // Return error response to the AJAX request
        $response['success'] = false;
        $response['error'] = mysqli_error($conn); // Include the MySQL error for debugging
    }
} else {
    // Return error response if required POST values are not set
    $response['success'] = false;
    $response['error'] = 'Incomplete data received';
}

// Close the database connection
mysqli_close($conn);

// // Return the response as JSON
 header('Content-Type: application/json');
echo json_encode($response);
