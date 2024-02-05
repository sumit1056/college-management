<?php
include 'connection.php';
session_start();

if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedClass = $_POST['selected_class'];
        $tdId = $_POST['td_id'];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM time_table WHERE class_name = ? AND value_id_name = ?");
        $stmt->bind_param("ss", $selectedClass, $tdId);

        if ($stmt->execute()) {
            $stmt = $conn->prepare("INSERT INTO deleted_time_table (time_table_id, value_id_name, data_time, Date, teacher_name, subject_name, class_name, delete_by)
                        SELECT time_table_id, value_id_name, data_time, Date, teacher_name, subject_name, class_name, ? AS delete_by
                        FROM time_table WHERE class_name = ? AND value_id_name = ?");
            $stmt->bind_param("sss", $userEmail, $selectedClass, $tdId);


            if ($stmt->execute()) {
                $response = array('status' => 'success', 'message' => 'Data deleted and stored successfully');
                echo json_encode($response);
            } else {
                $response = array('status' => 'error', 'message' => 'Error storing deleted data: ' . $stmt->error . ' - ' . mysqli_error($conn));
                echo json_encode($response);
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Error deleting data: ' . $stmt->error);
            echo json_encode($response);
        }

        $stmt->close();
        $conn->close();
    } else {
        $response = array('status' => 'error', 'message' => 'Invalid request method');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
