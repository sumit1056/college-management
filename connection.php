<?php
    $severname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sumit";

    $conn = mysqli_connect($severname,$username,$password,$dbname);
    if ($conn) {
        //echo "connected";
    }
    else {
        echo "connection filed";
    }
?>