<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_class']) && isset($_POST['td_id'])) {
        $selectedClass = $_POST['selected_class'];
        $tdId = $_POST['td_id'];

        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM time_table WHERE class_name = ? AND value_id_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $selectedClass, $tdId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Set Content-Type header
        header('Content-Type: application/json');

        if ($result === false) {
            // Handle query execution error during development
            error_log('Error executing the query: ' . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Error executing the query.']);
        } else {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo json_encode(['status' => 'success', 'data' => $row]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No data found for the selected class and td_id']);
            }
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing POST parameters']);
    }
}

$conn->close();
