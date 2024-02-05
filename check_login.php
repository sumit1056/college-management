<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input using mysqli_real_escape_string for security
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    // $selectedRole = mysqli_real_escape_string($conn, $_POST["role"]);

    // Validate the selected role, email, and password
    if (empty($email) || empty($password)) {
        // Handle empty fields
        echo "error";
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT roles_id FROM users WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if a matching record is found
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Valid credentials
            echo "success";

            // Fetch the role from the result set
            mysqli_stmt_bind_result($stmt, $dbRolesId);
            mysqli_stmt_fetch($stmt);

            $_SESSION['email'] = $email;
            $_SESSION['roles_id'] = $dbRolesId;

        } else {
            // Invalid credentials
            echo "error";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle prepared statement error
        echo "error";
    }

    mysqli_close($conn);
} else {
    // Handle non-POST requests appropriately
    echo "error";
}
