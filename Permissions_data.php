<?php
session_start(); // Start the session if not already started
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $_POST['allCheckboxValues'] is set
    $allCheckboxValues = json_decode($_POST['allCheckboxValues'], true);

    $Permissionsrole = $allCheckboxValues[0];
    $Permissionsname = $allCheckboxValues[1];
    $checkboxValues = array_slice($allCheckboxValues, 2);

    // Output the values for testing
    // echo "Role Name: " . $Permissionsrole . "<br>";
    // echo "Name: " . $Permissionsname . "<br>";
    // echo "Checkbox Values: ";
    // print_r($checkboxValues);

    $countthedata = "SELECT COUNT(id) FROM permission;";
    $result = $conn->query($countthedata);

    if ($result !== false) {
        $row = $result->fetch_row();
        $rowCount = $row[0];

        if ($rowCount > 0) {
            $truncateQuery = "TRUNCATE TABLE permission";
            if ($conn->query($truncateQuery) === TRUE) {
            } else {
                echo "Error truncating table: " . $conn->error;
            }
        } else {
            echo "No rows found in the table.";
        }
    } else {
        echo "Error: " . $conn->error;
    }


    // Prepare and execute SQL query to insert data into the database
    $sql = "INSERT INTO Permission (Permissionsrole, Permissionsname, CheckboxValues)
            VALUES ('$Permissionsrole', '$Permissionsname', '" . implode(",", $checkboxValues) . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Permission set successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method.";
}
