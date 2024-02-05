<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_class'], $_POST['td_id'], $_POST['updated_teacher'], $_POST['updated_subject'])) {
        $selectedClass = $_POST['selected_class'];
        $tdId = $_POST['td_id'];
        $updatedTeacher = $_POST['updated_teacher'];
        $updatedSubject = $_POST['updated_subject'];

        // Prepare and bind the parameters
        $stmt = $conn->prepare("UPDATE time_table SET teacher_name = ?, subject_name = ? WHERE class_name = ? AND value_id_name = ?");
        $stmt->bind_param("ssss", $updatedTeacher, $updatedSubject, $selectedClass, $tdId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Update successful";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}
