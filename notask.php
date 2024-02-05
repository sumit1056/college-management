<?php
session_start();
//print_r($_SESSION['selected_ids']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #333;
        }

        #wrapper {
            overflow-x: hidden;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 83vh;
            margin: 0 auto;
        }

        .custom-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        h1 {
            color: #3498db;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        p {
            color: #6c757d;
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .container-fluid {
            padding-left: 380px;
        }

        /* Additional Styles for a Pro Look */
        h1::after {
            content: '';
            display: block;
            width: 50px;
            height: 2px;
            background-color: #3498db;
            margin: 15px auto;
        }

        .custom-container:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php
        include 'connection.php';
        include 'notaskeslider.php';
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <?php
            include 'topbar.php';
            ?>
            <div class="container">
                <div class="custom-container">
                    <h1>No Task for Today</h1>
                    <p>Enjoy your free time!</p>
                </div>
            </div>
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/sb-admin-2.min.js"></script>
        </div>
    </div>
</body>

</html>