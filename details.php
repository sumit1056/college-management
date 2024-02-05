<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data from the database
    $query = "SELECT * FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);

        // Return user data as JSON
        header('Content-Type: application/json');
        echo json_encode($userData);
    } else {
        // Handle error
        echo json_encode(['error' => 'Error fetching user data']);
    }
} else {
    // Handle the case where 'id' parameter is not set
    echo json_encode(['error' => 'User ID not provided']);
}
?>
