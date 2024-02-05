<?php
include 'connection.php';

if (isset($_POST['selected_class'])) {
    $selectedClass = mysqli_real_escape_string($conn, $_POST['selected_class']);
    $query = "SELECT * FROM time_table WHERE class_name = '$selectedClass'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $error = mysqli_error($conn);
        echo json_encode(['error' => $error]);
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        echo json_encode(['error' => 'No data found for the selected class.']);
        exit();
    }

    $scheduleData = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $scheduleData[$row['value_id_name']] = array(
            'event_name' => $row['value_id_name'],
            'event_time' => $row['data_time'],
            'event_teacher' => $row['teacher_name'],
            'event_subject' => $row['subject_name']
        );
    }

    echo json_encode($scheduleData);
    exit();
}
