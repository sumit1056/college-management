<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $studentId = $_GET['id'];

        // Assuming $conn is your mysqli connection
        $query = "DELETE FROM users WHERE id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "i", $studentId);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => mysqli_error($conn)));
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(array('success' => false, 'error' => mysqli_error($conn)));
        }

        // Close the connection
        mysqli_close($conn);
    }
}
