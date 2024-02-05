<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <!-- DataTables DateTime plugin CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">

    <style>
        .page-item.active .page-link {
            background-color: #1cc88a !important;
            border-color: #1cc88a !important;
        }

        .form-control {
            width: 181px !important;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php
        include 'connection.php';
        include 'sidebar.php';
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                include 'topbar.php';
                ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><b>Export Timetable Data</b></h1>
                    </div>

                    <!-- Add Date Picker Input -->
                    <div class="form-group">
                        <label for="datepicker">Select Date:</label>
                        <input type="text" id="datepicker" class="form-control">
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-striped">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="center">S.NO</th>
                                        <th class="center">Date</th>
                                        <th class="center">Day</th>
                                        <th class="center">Time</th>
                                        <th class="center">Teacher name</th>
                                        <th class="center">Subject name</th>
                                        <th class="center">Class name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Handle Date Selection
                                    if (isset($_POST['selected_date'])) {
                                        $selected_date = $_POST['selected_date'];
                                        $sql = "SELECT * FROM time_table WHERE Date = '$selected_date' ORDER BY time_table_id DESC";
                                    } else {
                                        $sql = "SELECT * FROM time_table ORDER BY time_table_id DESC";
                                    }

                                    $result = mysqli_query($conn, $sql);

                                    $row_count = mysqli_num_rows($result);
                                    if (!$result) {
                                        echo 'Error fetching data: ' . mysqli_error($conn);
                                    } else {
                                        $counter = 1;
                                        while ($registration = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                                <td>' . $counter . '</td>
                                                <td>' . $registration['Date'] . '</td>
                                                <td>' . ucwords(strtolower(substr($registration['value_id_name'], 0, -2))) . '</td>
                                                <td>' . $registration['data_time'] . '</td>
                                                <td class="center">' . $registration['teacher_name'] . '</td>
                                                <td class="center">' . $registration['subject_name'] . '</td>
                                                <td class="center"><span class="badge badge-success rounded-pill d-inline">' . $registration['class_name'] . '</span></td>
                                             </tr>';
                                            $counter++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

    <!-- Datepicker Script -->
    <script>
        $(document).ready(function() {
            $("#datepicker").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                locale: {
                    format: 'DD MMMM, YYYY'
                }
            });

            // DataTable initialization
            $("#datatable").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [{
                            extend: 'excel',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ]
                }]
            });

            // Handle Date Selection Change
            $("#datepicker").on("change", function() {
                var selectedDate = $(this).val();
                $("#datatable").DataTable().destroy();
                loadDataTable(selectedDate);
            });

            function loadDataTable(selectedDate) {
                $("#datatable").DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: [{
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':not(:last-child)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: ':not(:last-child)'
                                }
                            }
                        ]
                    }],
                    ajax: {
                        url: "get_date_data.php",
                        type: "POST",
                        data: {
                            selected_date: selectedDate
                        },
                        // success: function(data) {
                        //     console.log(data); // Log the data to the console
                        // }
                    },
                    columns: [{
                            data: "time_table_id"
                        },
                        {
                            data: "Date"
                        },
                        {
                            data: "value_id_name",
                            render: function(data, type, row) {
                                // Modify the value_id_name here
                                let modifiedValueIdName = data.slice(0, -2).toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
                                return modifiedValueIdName;
                            }
                        },

                        {
                            data: "data_time"
                        },
                        {
                            data: "teacher_name"
                        },
                        {
                            data: "subject_name" 
                        },
                        {
                            data: "class_name"
                        }
                    ]
                });
            }

        });
    </script>

</body>

</html>