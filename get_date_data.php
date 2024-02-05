<?php
// Include your database connection file
include 'connection.php';

//echo $_POST['selected_date'];

// Get the selected date from the frontend
$selectedDate = $_POST['selected_date'];

// SQL query to fetch data for the selected date
$sql = "SELECT * FROM time_table WHERE Date = '$selectedDate' ORDER BY time_table_id DESC";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    $response = array('error' => true, 'message' => 'Error fetching data: ' . mysqli_error($conn));
} else {
    $data = array();

    // Fetch data and add to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $response = array('error' => false, 'data' => $data);
}

// Close the database connection
mysqli_close($conn);

// Send the JSON response back to the frontend
header('Content-Type: application/json');
echo json_encode($response);
