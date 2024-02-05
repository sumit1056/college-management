<?php
include 'connection.php';

if (isset($_POST['selectedClass'])) {
    $selectedClass = null;

    switch ($_POST['selectedClass']) {
        case 'BCA':
            $selectedClass = 1;
            break;
        case 'BBA':
            $selectedClass = 2;
            break;
        case 'BCOM':
            $selectedClass = 3;
            break;
        case 'BA':
            $selectedClass = 4;
            break;

        default:
            // Invalid class
            $response = array('success' => false, 'error' => 'Invalid class selected');
            echo json_encode($response);
            exit(); // Stop execution if an invalid class is provided
    }

    // Prevent SQL injection using prepared statement
    $query = "SELECT * FROM subject WHERE class_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $selectedClass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result !== false) {
            // Fetch subjects from the result set
            $subjects = array();
            while ($row = mysqli_fetch_array($result)) {
                $subjects[] = $row['subject_name'];
            }

            // Prepare the success response
            $response = array('success' => true, 'subjects' => $subjects);
            echo json_encode($response);
        } else {
            // Handle database query error
            $response = array('success' => false, 'error' => 'Error executing database query');
            echo json_encode($response);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle prepared statement creation error
        $response = array('success' => false, 'error' => 'Error creating prepared statement');
        echo json_encode($response);
    }
} else {
    // Invalid request
    $response = array('success' => false, 'error' => 'Invalid request');
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
