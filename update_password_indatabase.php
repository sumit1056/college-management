<?php
include 'connection.php';

if (isset($_POST['userId']) && isset($_POST['password'])) {
    $userId = $_POST['userId'];
    //convert the password into a code 
    // $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newPassword = $_POST['password'];

    $sql = "UPDATE admin SET password = '$newPassword' WHERE id = $userId";

    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid_data';
}

mysqli_close($conn);
?>
