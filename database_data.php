<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sumit";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}

// Query to get information about tables and columns
$query = "
    SELECT 
        table_name,
        column_name,
        data_type,
        character_maximum_length,
        column_type,
        column_key,
        is_nullable,
        column_default,
        extra
    FROM
        information_schema.columns
    WHERE
        table_schema = '$dbname';
";

$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Start an HTML table
    echo "<table border='1'>";
    echo "<tr>
            <th>Table Name</th>
            <th>Column Name</th>
            <th>Data Type</th>
            <th>Character Max Length</th>
            <th>Column Type</th>
            <th>Column Key</th>
            <th>Is Nullable</th>
            <th>Column Default</th>
            <th>Extra</th>
          </tr>";

    // Loop through the result set
    while ($row = $result->fetch_assoc()) {
        // Display a row for each table
        echo "<tr>
                <td>{$row['table_name']}</td>
                <td>{$row['column_name']}</td>
                <td>{$row['data_type']}</td>
                <td>{$row['character_maximum_length']}</td>
                <td>{$row['column_type']}</td>
                <td>{$row['column_key']}</td>
                <td>{$row['is_nullable']}</td>
                <td>{$row['column_default']}</td>
                <td>{$row['extra']}</td>
              </tr>";
    }

    // End the HTML table
    echo "</table>";

    // Free the result set
    $result->free();
} else {
    echo "Error executing main query: " . $conn->error;
}

// Close connection
$conn->close();
?>
