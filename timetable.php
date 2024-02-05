<?php
session_start();
//print_r($_SESSION['selected_ids']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="css/classic.css">
    <link rel="stylesheet" href="css/classic.date.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        #Export_Data {
            width: 122px;
            padding-top: 9px;
        }

        .btn {
            width: 100px;
            height: 45px;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        #searchbuttonofdate {
            color: #ffffff;
            border-color: #ffffff;
            width: 127px;
            height: 43px;
            margin-left: 0px;
            margin-top: 30px !important;
        }

        .btn:not(:disabled):not(.disabled) {
            margin-top: 0px;
        }

        .timetable_form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .time_col {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 20px;
        }

        .time_btns {
            text-align: end;
        }

        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            background-color: #F8F9FC !important;
        }

        hr {
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }

        @media (min-width: 992px) {

            .mb-lg-0,
            .my-lg-0 {
                bottom: 15px !important;
            }
        }

        .card {
            border: 1px solid #e5e5e5 !important;
        }

        button {
            background: #1cc88a !important;
        }

        body button.close {
            background: #fff !important;
        }

        .bg-light-gray {
            background-color: #f7f7f7;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }


        .bg-sky.box-shadow {
            box-shadow: 0px 5px 0px 0px #00a2a7
        }

        .bg-orange.box-shadow {
            box-shadow: 0px 5px 0px 0px #af4305
        }

        .bg-green.box-shadow {
            box-shadow: 0px 5px 0px 0px #4ca520
        }

        .bg-yellow.box-shadow {
            box-shadow: 0px 5px 0px 0px #dcbf02
        }

        .bg-pink.box-shadow {
            box-shadow: 0px 5px 0px 0px #e82d8b
        }

        .bg-purple.box-shadow {
            box-shadow: 0px 5px 0px 0px #8343e8
        }

        .bg-lightred.box-shadow {
            box-shadow: 0px 5px 0px 0px #d84213
        }


        .bg-sky {
            background-color: #02c2c7
        }

        .bg-orange {
            background-color: #e95601
        }

        .bg-green {
            background-color: #5bbd2a
        }

        .bg-yellow {
            background-color: #f0d001
        }

        .bg-pink {
            background-color: #ff48a4
        }

        .bg-purple {
            background-color: #9d60ff
        }

        .bg-lightred {
            background-color: #ff5722
        }

        .padding-15px-lr {
            padding-left: 15px;
            padding-right: 15px;
        }

        .padding-5px-tb {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .margin-10px-bottom {
            margin-bottom: 10px;
        }

        .border-radius-5 {
            border-radius: 5px;
        }

        .margin-10px-top {
            margin-top: 10px;
        }

        .font-size14 {
            font-size: 14px;
        }

        .text-light-gray {
            color: #d6d5d5;
        }

        .font-size13 {
            font-size: 13px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .modal-header .close {
            width: 50px;
            padding-bottom: 31px !important;
            padding-top: 28px !important;
        }

        .modal-header {
            padding-bottom: 0px;
        }

        .text-light-gray {
            color: #000000 !important;
        }

        #event_class {
            width: 31% !important;
        }

        .swal2-styled.swal2-confirm {
            background-color: #1cc88a !important;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include 'connection.php';
        include 'sidebar.php';
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-12 timetable_form">
                                <div class="col-md-6 time_col">
                                    <label for="event_class">Select Class</label>
                                    <select class="form-control" id="event_class" name="event_class" onchange="handleClassSelection(this)">
                                        <option value="">Select class</option>
                                        <?php
                                        $query = 'SELECT * FROM classes';
                                        $result = mysqli_query($conn, $query);

                                        while ($row = mysqli_fetch_array($result)) {
                                            $className = $row['class_name'];
                                            $selected = isset($_SESSION['selected_class']) && $_SESSION['selected_class'] === $className ? 'selected' : '';
                                            echo "<option value='$className' $selected>$className</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- this is the button to export the data  -->
                                <div class="col-md-6 time_btns">
                                    <?php
                                    $sql = "SELECT * FROM Permission";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $Permissionsrole = $row["Permissionsrole"];
                                            $Permissionsname = $row["Permissionsname"];

                                            // Convert CheckboxValues to an array
                                            $checkboxValuesArray = explode(",", $row["CheckboxValues"]);
                                        }
                                    }

                                    $emailoftheuser = $_SESSION['email'];
                                    $query = "SELECT name FROM users WHERE email = '$emailoftheuser'";
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $nameoftheuser = $row['name'];

                                        if ($_SESSION['roles_id'] == $Permissionsrole && $Permissionsname === "") {
                                            $pagepermission = '';

                                            foreach ($checkboxValuesArray as $value) {
                                                $pagepermission .= $value . '<br>';
                                            }

                                            if (in_array('timetable_export', $checkboxValuesArray)) {
                                                echo '<a href="export_timetable_data.php" class="btn btn-primary" id="Export_Data">Export Data</a>';
                                            }
                                        } elseif ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                            $pagepermission = '';

                                            foreach ($checkboxValuesArray as $value) {
                                                $pagepermission .= $value . '<br>';
                                            }

                                            echo $pagepermission;  // Output page permissions

                                            if (in_array('timetable_export', $checkboxValuesArray)) {
                                                echo '<a href="export_timetable_data.php" class="btn btn-primary" id="Export_Data">Export Data</a>';
                                            }
                                        } else {
                                            $check_user = $_SESSION['roles_id'];
                                            if ($check_user != 'Staff') {
                                                echo '<a href="export_timetable_data.php" class="btn btn-primary" id="Export_Data">Export Data</a>';
                                            }
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                            <!-- date picker  -->
                            <div class="col-lg-7">
                                <form action="#" class="row flex-nowrap">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_from">DATE</label>
                                            <!-- Set default value to today's date using JavaScript -->
                                            <input type="text" class="form-control" id="input_from" placeholder="Select Date">
                                            <div id="fromError" class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_to">To</label>
                                            <input type="text" class="form-control" id="input_to" placeholder="End Date">
                                            <div id="toError" class="error-message"></div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary mt-4" data-mdb-ripple-init id="searchbuttonofdate">Search</button>
                                </form>
                            </div>

                        </div>
                        <label for="event_class" id="selectedDateLabel">DATE : </label>

                        <div class="table-responsive">
                            <table id="scheduleTable" class="table table-bordered text-center" style="display: none;">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-uppercase">Time</th>
                                        <th class="text-uppercase">Monday</th>
                                        <th class="text-uppercase">Tuesday</th>
                                        <th class="text-uppercase">Wednesday</th>
                                        <th class="text-uppercase">Thursday</th>
                                        <th class="text-uppercase">Friday</th>
                                        <th class="text-uppercase">Saturday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle">09:00am</td>
                                        <td id="MONDAY_1" class="clickable-td" data-time="09:00-10:00"></td>
                                        <td id="TUESDAY_1" class="clickable-td" data-time="09:00-10:00"></td>
                                        <td id="WEDNESDAY_1" class="clickable-td" data-time="09:00-10:00"></td>
                                        <td id="THURSDAY_1" class="clickable-td" data-time="09:00-10:00"></td>
                                        <td id="FRIDAY_1" class="clickable-td" data-time="09:00-10:00"></td>
                                        <td id="SATURDAY_1" class="clickable-td" data-time="09:00-10:00"></td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle">10:00am</td>
                                        <td id="MONDAY_2" class="clickable-td" data-time="10:00-11:00"></td>
                                        <td id="TUESDAY_2" class="clickable-td" data-time="10:00-11:00"></td>
                                        <td id="WEDNESDAY_2" class="clickable-td" data-time="10:00-11:00"></td>
                                        <td id="THURSDAY_2" class="clickable-td" data-time="10:00-11:00"></td>
                                        <td id="FRIDAY_2" class="clickable-td" data-time="10:00-11:00"></td>
                                        <td id="SATURDAY_2" class="clickable-td" data-time="10:00-11:00"></td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle">11:00am</td>
                                        <td id="MONDAY_3" class="clickable-td" data-time="11:00-12:00"></td>
                                        <td id="TUESDAY_3" class="clickable-td" data-time="11:00-12:00"></td>
                                        <td id="WEDNESDAY_3" class="clickable-td" data-time="11:00-12:00"></td>
                                        <td id="THURSDAY_3" class="clickable-td" data-time="11:00-12:00"></td>
                                        <td id="FRIDAY_3" class="clickable-td" data-time="11:00-12:00"></td>
                                        <td id="SATURDAY_3" class="clickable-td" data-time="11:00-12:00"></td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle">12:00pm</td>
                                        <td id="MONDAY_4" class="clickable-td" data-time="12:00-1:00"></td>
                                        <td id="TUESDAY_4" class="clickable-td" data-time="12:00-1:00"></td>
                                        <td id="WEDNESDAY_4" class="clickable-td" data-time="12:00-1:00"></td>
                                        <td id="THURSDAY_4" class="clickable-td" data-time="12:00-1:00"></td>
                                        <td id="FRIDAY_4" class="clickable-td" data-time="12:00-1:00"></td>
                                        <td id="SATURDAY_4" class="clickable-td" data-time="12:00-1:00"></td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle">01:00pm</td>
                                        <td id="MONDAY_5" class="clickable-td" data-time="1:00-2:00"></td>
                                        <td id="TUESDAY_5" class="clickable-td" data-time="1:00-2:00"></td>
                                        <td id="WEDNESDAY_5" class="clickable-td" data-time="1:00-2:00"></td>
                                        <td id="THURSDAY_5" class="clickable-td" data-time="1:00-2:00"></td>
                                        <td id="FRIDAY_5" class="clickable-td" data-time="1:00-2:00"></td>
                                        <td id="SATURDAY_5" class="clickable-td" data-time="1:00-2:00"></td>
                                    </tr>
                                </tbody>
                            </table>


                            <!-- modal for inserting data -->
                            <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="event_classes">Class</label>
                                                            <input type="text" name="event_classes" id="event_classes" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="event_name">Week</label>
                                                            <input type="text" name="event_name" id="event_name" class="form-control" readonly>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="event_time">Time</label>
                                                            <input type="text" name="event_time" id="event_time" class="form-control" readonly>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <?php
                                                            $query = 'SELECT * FROM users WHERE roles_id IN ("Teacher", "HOD")';
                                                            $result = mysqli_query($conn, $query);
                                                            ?>
                                                            <label for="event_teacher">Select Teacher</label>
                                                            <select class="form-control" id="event_teacher" name="event_teacher">
                                                                <option value="">Select Teacher</option>
                                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                                    <option value='<?php echo $row['name']; ?>'>
                                                                        <?php echo $row['name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <!-- Error message container -->
                                                            <div id="teacherError" style="color: red;"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <?php
                                                            $query = 'SELECT * FROM subject';
                                                            $result = mysqli_query($conn, $query);
                                                            ?>
                                                            <label for="event_subject">Select Subject</label>
                                                            <select class="form-control" id="event_subject" name="event_subject">
                                                                <option value="">Select Subject</option>
                                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                                    <option value='<?php echo $row['subject_name']; ?>'>
                                                                        <?php echo $row['subject_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <div id="subjectError" style="color: red;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="saveEventBtn" onclick="savevalidateForm()">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal for updation data -->
                            <div class="modal fade" id="event_updation_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Update data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <div class="row">
                                                    <div class="col-sm-12" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="event_id">id</label>
                                                            <input type="text" name="event_id" id="event_id" class="form-control" placeholder="Enter your event name">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <?php
                                                            $query = 'SELECT * FROM users WHERE roles_id IN ("Teacher", "HOD")';
                                                            $result = mysqli_query($conn, $query);
                                                            ?>
                                                            <label for="event_teacher_updation">Select Teacher</label>
                                                            <select class="form-control" id="event_teacher_updation" name="event_teacher_updation">
                                                                <option value="">Select Teacher</option>
                                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                                    <option value='<?php echo $row['name']; ?>'>
                                                                        <?php echo $row['name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <?php
                                                            $query = 'SELECT * FROM subject';
                                                            $result = mysqli_query($conn, $query);
                                                            ?>
                                                            <label for="event_subject_updation">Select Subject</label>
                                                            <select class="form-control" id="event_subject_updation" name="event_subject_updation">
                                                                <option value="">Select Subject</option>
                                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                                    <option value='<?php echo $row['subject_name']; ?>'>
                                                                        <?php echo $row['subject_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <?php
                                            // delete button 
                                            if ($_SESSION['roles_id'] == $Permissionsrole && $Permissionsname === "") {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                if (in_array('timetable_delete', $checkboxValuesArray)) {
                                                    echo '<button type="button" id="deleteBtn" class="btn btn-primary">Delete</button>';
                                                }
                                            } elseif ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                echo $pagepermission; // Output page permissions

                                                if (in_array('timetable_delete', $checkboxValuesArray)) {
                                                    echo '<button type="button" id="deleteBtn" class="btn btn-primary">Delete</button>';
                                                }
                                            } else {
                                                $check_user = $_SESSION['roles_id'];
                                                if ($check_user != 'Staff') {
                                                    echo '<button type="button" id="deleteBtn" class="btn btn-primary">Delete</button>';
                                                }
                                            }

                                            //update button
                                            if ($_SESSION['roles_id'] == $Permissionsrole && $Permissionsname === "") {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                if (in_array('timetable_edit', $checkboxValuesArray)) {
                                                    echo '<button type="button" id="updateBtn" class="btn btn-primary">Update</button>';
                                                }
                                            } elseif ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                echo $pagepermission; // Output page permissions

                                                if (in_array('timetable_edit', $checkboxValuesArray)) {
                                                    echo '<button type="button" id="updateBtn" class="btn btn-primary">Update</button>';
                                                }
                                            } else {
                                                $check_user = $_SESSION['roles_id'];
                                                if ($check_user != 'Staff') {
                                                    echo '<button type="button" id="updateBtn" class="btn btn-primary">Update</button>';
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/sb-admin-2.min.js"></script>
        <script src="js/picker.js"></script>
        <script src="js/picker.date.js"></script>
        <script src="js/main.js"></script>

        <!--this is the code to show the subject base on the class you select -->
        <script>
            $(document).ready(function() {
                // Function to update subjects based on the selected class
                function updateSubjects(selectedClass) {
                    $.ajax({
                        type: 'POST',
                        url: 'selected_class.php',
                        data: {
                            selectedClass: selectedClass
                        },
                        success: function(response) {
                            try {
                                var parsedResponse = JSON.parse(response);

                                if (parsedResponse.success && Array.isArray(parsedResponse.subjects)) {
                                    updateSubjectOptions(parsedResponse.subjects);
                                    updateSubjectOptionsupdate(parsedResponse.subjects);
                                } else {
                                    console.error('Invalid response format:', response);
                                }
                            } catch (error) {
                                console.error('Error parsing JSON:', error);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error updating subjects:', errorThrown);
                        }
                    });
                }

                // Initial load of subjects based on the selected class
                var initialClass = $('#event_class').val().trim();
                updateSubjects(initialClass);

                // Event listener for class selection change
                $('#event_class').on('change', function() {
                    var selectedClass = $(this).val().trim();
                    updateSubjects(selectedClass);
                });

                function updateSubjectOptions(subjects) {
                    $('#event_subject').empty();
                    $('#event_subject').append('<option value="">Select Subject</option>');

                    for (var i = 0; i < subjects.length; i++) {
                        $('#event_subject').append('<option value="' + subjects[i] + '">' + subjects[i] + '</option>');
                    }
                }

                function updateSubjectOptionsupdate(subjects) {
                    $('#event_subject_updation').empty();
                    $('#event_subject_updation').append('<option value="">Select Subject</option>');

                    for (var i = 0; i < subjects.length; i++) {
                        $('#event_subject_updation').append('<option value="' + subjects[i] + '">' + subjects[i] + '</option>');
                    }
                }
            });
        </script>


        <!--this is the script for remove the autofill in the insert modal  -->
        <script>
            // Add this script to clear the selected values before showing the modal
            $('#event_entry_modal').on('show.bs.modal', function(event) {
                // Clear the values of the input fields
                $('#event_teacher, #event_subject').val('');
            });
        </script>

        <!--  Use JavaScript to hide the div -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.col-lg-7').style.display = 'none';
            });
        </script>


        <!-- insert data , show data , updatedata , delete data, check class is selcted , datepicker -->
        <script>
            // Event listener for the date search button
            document.getElementById('searchbuttonofdate').addEventListener('click', function() {
                var startDate = document.getElementById('input_from').value;
                var selectedDateLabel = document.getElementById('selectedDateLabel');
                var scheduleTable = document.getElementById('scheduleTable');
                document.getElementById('fromError').innerText = '';

                if (startDate === '') {
                    document.getElementById('fromError').innerText = 'Please enter a date.';
                    return;
                }

                selectedDateLabel.textContent = formatDateForLabel(startDate);

                // Clear data from the table
                clearTableContent();

                // Fetch data from the database based on the date
                $.ajax({
                    type: 'POST',
                    url: 'getting_data_usingdate.php',
                    data: {
                        date: startDate,
                        selected_class: document.getElementById('event_class').value
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.trim() === '' || response.trim() === '[]') {
                            console.error('No data available for the selected date.');
                            Swal.fire({
                                icon: 'error',
                                title: 'No Data',
                                text: 'No data available for the selected date.',
                            });
                        } else {
                            var scheduleData = JSON.parse(response);
                            for (var key in scheduleData) {
                                var tdId = key;
                                var eventData = scheduleData[key];
                                updateTdContent(tdId, eventData);
                            }
                            scheduleTable.style.display = 'table';
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching data from the database:', error);
                    }
                });
            });

            // Function to format date for label
            function formatDateForLabel(date) {
                let new_date = new Date(date);
                let day = String(new_date.getDate()).padStart(2, '0');
                let monthIndex = new_date.getMonth();
                let year = new_date.getFullYear();

                let monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                let formattedDate = `DATE: ${day} ${monthNames[monthIndex]}, ${year}`;
                return formattedDate;
            }

            // Get today's date and set it as the default selected date label
            var today = new Date();
            today = today.toISOString().split('T')[0];
            document.getElementById('selectedDateLabel').textContent = formatDateForLabel(today);

            // Event listener for the date search button
            document.getElementById('searchbuttonofdate').addEventListener('click', function() {
                var startDate = document.getElementById('input_from').value;
                document.getElementById('fromError').innerText = '';

                if (startDate === '') {
                    document.getElementById('fromError').innerText = 'Please enter a date.';
                    return;
                }
                document.getElementById('selectedDateLabel').textContent = formatDateForLabel(startDate);
            });

            // Check if the class is already selected in local storage
            var storedClass = localStorage.getItem('selected_class');
            if (storedClass) {
                document.getElementById('event_class').value = storedClass;
                handleClassSelection(document.getElementById('event_class'));
            }

            // Function to update content in a table cell
            function updateTdContent(tdId, eventData) {
                var tdElement = document.getElementById(tdId);
                if (tdElement) {
                    var content =
                        '<span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">' +
                        eventData['event_subject'] + '</span>' +
                        '<div class="margin-10px-top font-size14">' + eventData['event_time'] + '</div>' +
                        '<div class="font-size13 text-light-gray">' + eventData['event_teacher'] + '</div>';
                    tdElement.innerHTML = content;
                } else {
                    // console.error('Error: Element with id ' + tdId + ' not found.');
                }
            }

            // Function to handle class selection
            function handleClassSelection(selectElement) {
                var selectedClass = selectElement.value;
                var table = document.getElementById('scheduleTable');
                var eventClassesInput = document.getElementById('event_classes');

                clearTableContent();
                eventClassesInput.value = selectedClass;
                // Store the selected class in local storage, including the "Select class" option
                localStorage.setItem('selected_class', selectedClass);

                if (selectedClass === '') {
                    table.style.display = 'none';
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'show_timetable_data.php',
                    data: {
                        selected_class: selectedClass
                    },
                    success: function(response) {
                        var scheduleData = JSON.parse(response);
                        for (var key in scheduleData) {
                            var tdId = key;
                            var eventData = scheduleData[key];
                            updateTdContent(tdId, eventData);
                        }
                        table.style.display = 'table';
                    },
                    error: function(error) {
                        console.error('Error fetching schedule data:', error);
                    }
                });
            }

            // Function to clear content of the timetable table
            function clearTableContent() {
                var table = document.getElementById('scheduleTable');
                var cellsWithId = table.querySelectorAll('td[id]');
                cellsWithId.forEach(function(td) {
                    td.innerHTML = '';
                });
            }

            // Function to save event data

            function savevalidateForm() {
                var className = document.getElementById('event_classes').value;
                var week = document.getElementById('event_name').value;
                var time = document.getElementById('event_time').value;
                var teacher = document.getElementById('event_teacher').value;
                var subject = document.getElementById('event_subject').value;
                var dateLabel = document.getElementById('selectedDateLabel').textContent;
                var date = dateLabel.replace(/DATE\s*:\s*/i, '');
                var returnvalue;

                $('#teacherError, #subjectError').text('');

                // Check if the selected values are empty
                if ($('#event_teacher').val() === '') {
                    $('#teacherError').text('Please select a teacher.');
                    returnvalue = false;
                }

                if ($('#event_subject').val() === '') {
                    $('#subjectError').text('Please select a subject.');
                    returnvalue = false;
                } else {
                    returnvalue = true;
                }

                $('#event_teacher, #event_subject').change(function() {
                    savevalidateForm();
                });

                if (returnvalue) {
                    document.getElementById('saveEventBtn').addEventListener('click', function() {
                        $.ajax({
                            type: 'POST',
                            url: 'time_table_insert.php',
                            data: {
                                class_name: className,
                                week: week,
                                time: time,
                                teacher: teacher,
                                subject: subject,
                                date: date
                            },
                            success: function(response) {
                                console.log('Event saved successfully:', response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Event saved successfully.',
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        $.ajax({
                                            type: 'POST',
                                            url: 'show_timetable_data.php',
                                            data: {
                                                selected_class: className
                                            },
                                            success: function(newDataResponse) {
                                                var newData = JSON.parse(newDataResponse);
                                                for (var key in newData) {
                                                    var tdId = key;
                                                    var tdElement = document.getElementById(tdId);
                                                    if (tdElement) {
                                                        var eventData = newData[key];
                                                        var content =
                                                            '<span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">' +
                                                            eventData['event_subject'] + '</span>' +
                                                            '<div class="margin-10px-top font-size14">' + eventData['event_time'] + '</div>' +
                                                            '<div class="font-size13 text-light-gray">' + eventData['event_teacher'] + '</div>';
                                                        tdElement.innerHTML = content;
                                                    } else {
                                                        // console.error('Error: Element with id ' + tdId + ' not found.');
                                                    }
                                                }
                                            },
                                            error: function(error) {
                                                console.error('Error fetching new data:', error);
                                            }
                                        });
                                        $('#event_entry_modal').modal('hide');
                                    }
                                });
                            },
                            error: function(error) {
                                console.error('Error saving event:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Error saving event. Please try again.',
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {}
                                });
                            }
                        });
                    })
                }
            }

            // Event listener for the DOMContentLoaded event
            document.addEventListener('DOMContentLoaded', function() {
                // Event listener for clickable table cells
                var clickableTds = document.querySelectorAll('.clickable-td');
                clickableTds.forEach(function(td) {
                    td.addEventListener('click', function() {
                        var tdId = this.id;
                        console.log('Clicked TD id:', tdId);
                        var tdContent = this.innerHTML.trim();

                        if (tdContent === '') {
                            var eventTime = this.getAttribute('data-time');
                            document.getElementById('event_name').value = tdId;
                            document.getElementById('event_time').value = eventTime;

                            <?php
                            if ($_SESSION['roles_id'] == $Permissionsrole && $Permissionsname === "") {
                                $pagepermission = '';

                                foreach ($checkboxValuesArray as $value) {
                                    $pagepermission .= $value . '<br>';
                                }

                                if (in_array('timetable_add', $checkboxValuesArray)) {
                                    echo "\$('#event_entry_modal').modal('show');";
                                }
                            } elseif ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                $pagepermission = '';

                                foreach ($checkboxValuesArray as $value) {
                                    $pagepermission .= $value . '<br>';
                                }

                                echo $pagepermission; // Output page permissions

                                if (in_array('timetable_add', $checkboxValuesArray)) {
                                    echo "\$('#event_entry_modal').modal('show');";
                                }
                            } else {
                                $check_user = $_SESSION['roles_id'];
                                if ($check_user != 'Staff') {
                                    echo "\$('#event_entry_modal').modal('show');";
                                }
                            }
                            ?>
                        } else {
                            $('#event_updation_modal').modal('show');

                            var selectedClassElement = document.getElementById('event_classes');
                            var selectedClass = selectedClassElement ? selectedClassElement.value : null;

                            if (selectedClass !== null) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'time_table_update.php',
                                    data: {
                                        selected_class: selectedClass,
                                        td_id: tdId
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        var data = typeof response === 'string' ? JSON.parse(response) : response;
                                        if (data && data.status === 'success' && data.data) {
                                            $("#event_id").val(data.data.value_id_name);
                                            $("#event_teacher_updation").val(data.data.teacher_name);
                                            $("#event_subject_updation").val(data.data.subject_name);
                                        } else {
                                            $("#event_teacher_updation").val(data.teacher_name);
                                            $("#event_subject_updation").val(data.subject_name);
                                        }
                                    },
                                    error: function(error) {
                                        console.error('Error fetching data for update:', error);
                                    }
                                });
                            } else {
                                console.error("Element with ID 'event_classes' not found.");
                            }
                        }
                    });
                });

                // Event listener for the update button
                document.getElementById('updateBtn').addEventListener('click', function() {
                    var selectedClassElement = document.getElementById('event_class');
                    var selectedClass = selectedClassElement ? selectedClassElement.value : null;
                    var tdId = document.getElementById('event_id').value;

                    var clickedTdElement = document.getElementById(tdId);
                    var eventDataTime = clickedTdElement.getAttribute('data-time');

                    var updatedTeacher = document.getElementById('event_teacher_updation').value;
                    var updatedSubject = document.getElementById('event_subject_updation').value;

                    if (selectedClass !== null) {
                        $.ajax({
                            type: 'POST',
                            url: 'update_time_table.php',
                            data: {
                                selected_class: selectedClass,
                                td_id: tdId,
                                updated_teacher: updatedTeacher,
                                updated_subject: updatedSubject
                            },
                            success: function(response) {
                                console.log('Data updated successfully:', response);
                                var updatedContent =
                                    '<span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">' +
                                    updatedSubject + '</span>' +
                                    '<div class="margin-10px-top font-size14">' + eventDataTime + '</div>' +
                                    '<div class="font-size13 text-light-gray">' + updatedTeacher + '</div>';
                                var updatedTdElement = document.getElementById(tdId);
                                if (updatedTdElement) {
                                    updatedTdElement.innerHTML = updatedContent;
                                } else {
                                    console.error('Error: Element with id ' + tdId + ' not found.');
                                }
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Data updated successfully.'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {}
                                });
                                $('#event_updation_modal').modal('hide');
                            },
                            error: function(error) {
                                console.error('Error updating data:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Error updating data. Please try again.'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {}
                                });
                            }
                        });
                    } else {
                        console.error("Element with ID 'event_class' not found.");
                    }
                });

                // Event listener for the delete button
                document.getElementById('deleteBtn').addEventListener('click', function() {
                    var selectedClassElement = document.getElementById('event_classes');
                    var selectedClass = selectedClassElement ? selectedClassElement.value : null;
                    var tdId = document.getElementById('event_id').value;

                    // Assuming user's email is stored in a session variable
                    var userEmail = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";

                    if (selectedClass !== null) {
                        $.ajax({
                            type: 'POST',
                            url: 'time_table_delete.php',
                            data: {
                                selected_class: selectedClass,
                                td_id: tdId,
                                user_email: userEmail // Include user's email in the data sent to the server
                            },
                            success: function(response) {
                                console.log('Data deleted successfully:', response);
                                var deletedTdElement = document.getElementById(tdId);
                                if (deletedTdElement) {
                                    deletedTdElement.innerHTML = '';
                                } else {
                                    console.error('Error: Element with id ' + tdId + ' not found.');
                                }
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Data deleted successfully.'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {}
                                });
                                $('#event_updation_modal').modal('hide');
                            },
                            error: function(error) {
                                console.error('Error deleting data:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Error deleting data. Please try again.'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {}
                                });
                            }
                        });
                    } else {
                        console.error("Element with ID 'event_classes' not found.");
                    }
                });
            });
        </script>


        <!-- this is the code to convert the data into the excel sheet  -->
        <!-- <script>
            function exportToExcelcheck() {
                var selectedClass = document.getElementById('event_class').value;
                console.log("Selected Class: ", selectedClass);

                if (selectedClass === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a class.',
                    });
                    return;
                } else {
                    exportToExcel(selectedClass);
                }
            }

            function exportToExcel(selectedClass) {
                var table = document.getElementById('scheduleTable');

                // Convert the table to a worksheet using SheetJS
                var ws = XLSX.utils.table_to_sheet(table);

                // Create a workbook with a single sheet
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Timetable');

                // Save the workbook as an Excel file
                var fileName = 'Timetable.xlsx';
                XLSX.writeFile(wb, fileName);

                // Additional code to work with the selected class if needed
                console.log("Selected Class (from exportToExcel): ", selectedClass);
            }
        </script> -->

        <!-- this is the code to convert the data into the csv file  -->
        <!-- <script>
            document.getElementById('exportincsv').addEventListener('click', exportToCSVcheck);

            function exportToCSVcheck() {
                var selectedClass = document.getElementById('event_class').value;
                console.log("Selected Class: ", selectedClass);

                if (selectedClass === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a class.',
                    });
                    return;
                } else {
                    exportToCSV(selectedClass);
                }
            }

            function exportToCSV(selectedClass) {
                var table = document.getElementById('scheduleTable');
                var csvContent = "";

                // Add the table headers to the CSV content
                var headers = [];
                for (var i = 0; i < table.rows[0].cells.length; i++) {
                    headers.push(table.rows[0].cells[i].textContent);
                }
                csvContent += headers.join(',') + "\n";

                // Add the table data to the CSV content
                for (var j = 1; j < table.rows.length; j++) {
                    var row = table.rows[j];
                    var rowData = [];
                    for (var k = 0; k < row.cells.length; k++) {
                        rowData.push(row.cells[k].textContent);
                    }
                    csvContent += rowData.join(',') + "\n";
                }

                // Create a blob and create a link to trigger the download
                var blob = new Blob([csvContent], {
                    type: 'text/csv'
                });
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'Timetable.csv';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Additional code to work with the selected class if needed
                console.log("Selected Class (from exportToCSV): ", selectedClass);
            }
        </script> -->
</body>

</html>