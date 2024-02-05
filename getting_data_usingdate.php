<?php
include 'connection.php';

$date = $_POST['date'];

// Perform a database query to fetch data based on the date and all classes
$query = "SELECT * FROM time_table WHERE Date = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $date);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error in prepared statement: " . mysqli_error($conn));
}

// Prepare the data in an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    // Filter data based on the selected class
    $classFilter = $_POST['selected_class'];
    if ($row['class_name'] == $classFilter) {
        $data[$row['value_id_name']] = array(
            'event_subject' => $row['subject_name'],
            'event_time' => $row['data_time'],
            'event_teacher' => $row['teacher_name']
            // Add more fields as needed
        );
    }
}

// Close the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Return the data as JSON
echo json_encode($data);
