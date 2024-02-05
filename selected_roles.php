<?php
include 'connection.php';

$selectedRole = $_POST['role'];
$query = "SELECT name FROM users WHERE roles_id = '$selectedRole'";
$result = $conn->query($query);

$userNames = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userNames[] = $row['name']; // Fix: use 'name' instead of 'user_name'
    }
}

// Return the user names as JSON
echo json_encode($userNames);

$conn->close();
