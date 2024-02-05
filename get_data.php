<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Assuming you have a "users" table in your database
    $query = "SELECT * FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        // Return user data as JSON
        echo json_encode($userData);
    } else {
        // Handle the case where user data is not found
        echo json_encode(['error' => 'User not found']);
    }
} else {
    // Handle the case where user ID is not provided
    echo json_encode(['error' => 'User ID not provided']);
}

// Close the database connection
mysqli_close($conn);
