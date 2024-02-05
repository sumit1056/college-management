<?php
session_start();
//print_r($_SESSION['selected_ids']);
//include 'connection.php';
//echo $usercheck = $_SESSION['roles_id'];
// if ($usercheck == true) {
// } else {
//     header("Location: firstpage.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <style>
        #closedeatails {
            top: 12px !important;
            right: 14px !important;
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
            background-color: #1cc88a !important;
        }

        button.dt-button.buttons-html5 {
            background: none;
        }

        a.buttons-collection {
            margin-left: 1em;
        }

        .center {
            text-align: center !important;
        }

        .inner form {
            padding-top: 8px;
        }

        .form-check-label {
            padding-right: 10px !important;
        }

        .login_form .form-group {
            margin-bottom: 0px;
        }

        .modal-xl {
            max-width: 420px !important;
        }

        h3 {
            text-align: center;

        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #1cc88a !important;
            border-color: #1cc88a !important;
        }

        /* button {
            background: #1cc88a !important;
        } */

        body button.close {
            background: #fff !IMPORTANT;
        }

        body button.close.updateclose {
            padding: 2rem 1rem !important;
        }

        body button.btn.btn-secondary {
            width: 76px !important;
            height: 40px !important;
            padding-left: 9px !important;
        }

        body button.close.thisone {
            width: 46px !important;
        }

        .modal-header {
            padding-bottom: 0px !important;
        }


        .modal-header .close {
            width: 51px;
            padding: 1rem 2rem !important;
            margin: -1rem -1rem 0rem auto !important;
        }

        #addBtn {
            width: 134px;
            height: 39px;
        }

        .swal2-styled.swal2-confirm {
            background-color: #1cc88a !important;
        }

        .error-message {
            color: red;
        }

        #openprofiledeatils {
            cursor: pointer;
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
                        <h1 class="h3 mb-0 text-gray-800"><b>Members</b></h1>
                        <div>
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

                                    if (in_array('members_add', $checkboxValuesArray)) {
                                        echo '<a href="#" class="btn btn-success centered-button" data-toggle="modal" data-target="#myModal">Add Members</a>';
                                    }
                                } elseif ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                    $pagepermission = '';

                                    foreach ($checkboxValuesArray as $value) {
                                        $pagepermission .= $value . '<br>';
                                    }

                                    echo $pagepermission;  // Output page permissions

                                    if (in_array('members_add', $checkboxValuesArray)) {
                                        echo '<a href="#" class="btn btn-success centered-button" data-toggle="modal" data-target="#myModal">Add Members</a>';
                                    }
                                } else {
                                    $check_user = $_SESSION['roles_id'];
                                    if ($check_user != 'Staff') {
                                        echo '<a href="#" class="btn btn-success centered-button" data-toggle="modal" data-target="#myModal">Add Members</a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-striped">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="center">S.NO</th>
                                        <th class="center">Role</th>
                                        <th class="center">Name</th>
                                        <th class="center">Email</th>
                                        <th class="center">Subject</th>
                                        <th class="center">Class</th>
                                        <th class="center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Assuming session_start() has been called to start the session
                                    // $_SESSION['roles_id'] should be set based on user role
                                    $roles_id = $_SESSION['roles_id'];
                                    $condition = '';

                                    switch ($roles_id) {
                                        case 'Super_Admin':
                                            // Super_Admin can see all data except their own
                                            $condition = "WHERE roles_id != 'Super_Admin'";
                                            break;
                                        case 'Admin':
                                            // Admin can see all data except Super_Admin and Admin
                                            $condition = "WHERE roles_id NOT IN ('Super_Admin', 'Admin')";
                                            break;
                                        case 'Teacher':
                                            // HOD can see all data except Super_Admin, Admin, and HOD
                                            $condition = "WHERE roles_id = '$roles_id'";
                                            break;
                                        case 'Student':
                                            // Teachers, Students, and Staff can only see their own data
                                            $condition = "WHERE roles_id = '$roles_id'";
                                            break;
                                    }

                                    $sql = "SELECT * FROM users $condition ORDER BY id DESC";
                                    $result = mysqli_query($conn, $sql);

                                    $row_count = mysqli_num_rows($result);
                                    if (!$result) {
                                        echo 'Error fetching data: ' . mysqli_error($conn);
                                    } else {
                                        $counter = 1;
                                        while ($registration = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">' . $counter . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">' . $registration['roles_id'] . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px;" class="rounded-circle profile-image detailoftheusers" id="openprofiledeatils" href="?id=' . $registration['id'] . '">
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">' . $registration['name'] . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">' . $registration['email'] . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="center">
                                    <p class="fw-normal mb-1">' . $registration['subject_id'] . '</p>
                                </td>
                                <td class="center">
                                    <span class="badge badge-success rounded-pill d-inline">' . $registration['class_id'] . '</span>
                                </td>
                                <td>';
                                            if ($_SESSION['roles_id'] == $Permissionsrole && $Permissionsname === "") {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                $pagepermission;

                                                if (in_array('members_edit', $checkboxValuesArray)) {
                                                    echo '<a href="?id=' . $registration['id'] . '" class="btn btn-success centered-button update-button" data-id="' . $registration['id'] . '" data-toggle="modal" data-target="#modalRegisterForm" style="margin-right: 4px;">Update</a>';
                                                }
                                            } else if ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                $pagepermission;

                                                if (in_array('members_edit', $checkboxValuesArray)) {
                                                    echo '<a href="?id=' . $registration['id'] . '" class="btn btn-success centered-button update-button" data-id="' . $registration['id'] . '" data-toggle="modal" data-target="#modalRegisterForm" style="margin-right: 4px;">Update</a>';
                                                }
                                            } else {
                                                $check_user = $_SESSION['roles_id'];
                                                if ($check_user != 'Staff') {
                                                    echo '<a href="?id=' . $registration['id'] . '" class="btn btn-success centered-button update-button" data-id="' . $registration['id'] . '" data-toggle="modal" data-target="#modalRegisterForm" style="margin-right: 4px;">Update</a>';
                                                }
                                            }

                                            // this is delete button 
                                            if ($_SESSION['roles_id'] == $Permissionsrole && $Permissionsname === "") {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                $pagepermission;

                                                if (in_array('members_delete', $checkboxValuesArray)) {
                                                    echo '<a href="delete_studentdata.php?id=' . $registration['id'] . '" class="btn btn-success centered-button delete-button" data-id="' . $registration['id'] . '">Delete</a>';
                                                }
                                            } else if ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                                                $pagepermission = '';

                                                foreach ($checkboxValuesArray as $value) {
                                                    $pagepermission .= $value . '<br>';
                                                }

                                                $pagepermission;

                                                if (in_array('members_delete', $checkboxValuesArray)) {
                                                    echo '<a href="delete_studentdata.php?id=' . $registration['id'] . '" class="btn btn-success centered-button delete-button" data-id="' . $registration['id'] . '">Delete</a>';
                                                }
                                            } else {
                                                $check_user = $_SESSION['roles_id'];
                                                if ($check_user != 'Staff') {
                                                    echo '<a href="delete_studentdata.php?id=' . $registration['id'] . '" class="btn btn-success centered-button delete-button" data-id="' . $registration['id'] . '">Delete</a>';
                                                }
                                            }
                                            echo '</td>
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

                <!-- modal for updation form  -->
                <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <form class="user" action="#" method="POST" enctype="multipart/form-data" name="registrationForm" id="registrationForm">
                                        <!-- Add the following HTML for error messages -->
                                        <div id="errorContainer"></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="Student_name_update">Name</label>
                                                    <input type="text" name="Student_name_update" id="Student_name_update" class="form-control" placeholder="Your name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="Student_email_update">Email</label>
                                                    <input type="text" name="Student_email_update" id="Student_email_update" class="form-control" placeholder="Your email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <?php
                                                    $query = 'SELECT * FROM classes';
                                                    $result = mysqli_query($conn, $query);
                                                    ?>
                                                    <label for="event_class_update">Select Class</label>
                                                    <select class="form-control" id="event_class_update" name="event_class_update">
                                                        <option value="">Select Class</option>
                                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value='<?php echo $row['class_name']; ?>'><?php echo $row['class_name']; ?></option>
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
                                                    <label for="event_subject_update">Select Subject</label>
                                                    <select class="form-control" id="event_subject_update" name="event_subject_update">
                                                        <option value="">Select Subject</option>
                                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value='<?php echo $row['subject_name']; ?>'><?php echo $row['subject_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="updateData" class="btn btn-primary" data-userId="">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add Members  -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">ADD Members</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <form class="user" action="#" method="POST" enctype="multipart/form-data" name="registrationFormADD" id="registrationFormADD">
                                        <!-- Add the following HTML for error messages -->
                                        <div id="errorContainer"></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <?php
                                                    $query = 'SELECT * FROM roles';
                                                    $result = mysqli_query($conn, $query);
                                                    ?>
                                                    <label for="event_role">Select role</label>
                                                    <select class="form-control" id="event_role" name="event_role">
                                                        <option value="">Select role</option>
                                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value='<?php echo $row['roles_name']; ?>'><?php echo $row['roles_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="Student_name">Name</label>
                                                    <input type="text" name="Student_name" id="Student_name" class="form-control" placeholder="Your name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="Student_email">Email</label>
                                                    <input type="text" name="Student_email" id="Student_email" class="form-control" placeholder="Your email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <?php
                                                    $query = 'SELECT * FROM classes ORDER BY class_id ASC';
                                                    $result = mysqli_query($conn, $query);
                                                    ?>
                                                    <label for="event_class">Select Class</label>
                                                    <select class="form-control" id="event_class" name="event_class">
                                                        <option value="">Select Class</option>
                                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value='<?php echo $row['class_name']; ?>'><?php echo $row['class_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <?php
                                                    // Fetch all subjects initially
                                                    $query = 'SELECT * FROM subject ORDER BY subject_id ASC';
                                                    $result = mysqli_query($conn, $query);
                                                    ?>
                                                    <label for="event_subject">Select Subject</label>
                                                    <select class="form-control" id="event_subject" name="event_subject">
                                                        <option value="">Select Subject</option>
                                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value='<?php echo $row['subject_name']; ?>'><?php echo $row['subject_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="Student_password">Password</label>
                                                    <input type="text" name="Student_password" id="Student_password" class="form-control" placeholder="Your password">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="addBtn" class="btn btn-primary">ADD</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- profiles modal -->
                <!-- https://bbbootstrap.com/snippets/social-profile-container-63944396 -->
                <div id="detailsmodal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" id="closedeatails">&times;</button>
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25">
                                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600" id="user-name"> </h6>
                                        <p id="user-role"></p>
                                        <i class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400" id="user-email"> </h6>
                                            </div>
                                        </div>
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Other Information</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Class</p>
                                                <h6 class="text-muted f-w-400" id="user-class"></h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Subject</p>
                                                <h6 class="text-muted f-w-400" id="user-subject"> </h6>
                                            </div>
                                        </div>
                                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- DATA TABLE script -->
    <script>
        $(document).ready(function() {
            var dataTableOptions = {
                // "order": [
                //     [0, 'desc']
                // ],
            };

            <?php if ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) : ?>
                var pagepermission = '';
                <?php foreach ($checkboxValuesArray as $value) : ?>
                    pagepermission += '<?php echo $value; ?> <br>';
                <?php endforeach; ?>

                dataTableOptions.dom = 'Bfrtip';
                dataTableOptions.buttons = [];
                <?php if (in_array('members_export', $checkboxValuesArray)) : ?>
                    dataTableOptions.buttons.push({
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
                    });
                <?php endif; ?>
            <?php else : ?>
                <?php $check_user = $_SESSION['roles_id']; ?>
                <?php if ($check_user != 'Staff') : ?>
                    dataTableOptions.dom = 'Bfrtip';
                    dataTableOptions.buttons = [{
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
                    }];
                <?php endif; ?>
            <?php endif; ?>

            $("#datatable").DataTable(dataTableOptions);
        });
    </script>

    <!-- data for profile in image -->
    <script>
        $(document).ready(function() {
            $(".detailoftheusers").click(function() {
                var userId = $(this).attr('href').split('=')[1];
                console.log("User ID: " + userId);

                // Fetch user details using AJAX
                $.ajax({
                    url: 'details.php',
                    type: 'GET',
                    data: {
                        id: userId
                    },
                    success: function(data) {
                        // Update modal content with fetched user data
                        $("#user-name").text(data.name);
                        $("#user-role").text(data.roles_id);
                        $("#user-email").text(data.email);
                        $("#user-class").text(data.class_id);
                        $("#user-subject").text(data.subject_id);

                        // Show the modal
                        $("#detailsmodal").modal("show");
                    },
                    error: function() {
                        console.log("Error fetching user data");
                    }
                });
            });

            $(".close").click(function() {
                $("#detailsmodal").modal("hide");
            });
        });
    </script>

    <!-- add data with inline error -->
    <script>
        $(document).ready(function() {
            var selectedClass = '';

            $('#event_class').on('change', function() {
                selectedClass = $(this).val().trim();
                if (selectedClass === '') {
                    updateErrorField($(this), 'Select a class.');
                } else {
                    updateErrorField($(this), '');
                    var $selectedClass = selectedClass;
                    console.log('Selected Class:', $selectedClass);

                    // Update the PHP variable and fetch subjects based on the selected class
                    $.ajax({
                        type: 'POST',
                        url: 'selected_class.php',
                        data: {
                            selectedClass: $selectedClass
                        },
                        success: function(response) {
                            console.log('Full Response:', response);

                            try {
                                // Parse the response JSON
                                var parsedResponse = JSON.parse(response);

                                if (parsedResponse.success && Array.isArray(parsedResponse.subjects)) {
                                    // Update the subjects dropdown options based on the response
                                    updateSubjectOptions(parsedResponse.subjects);
                                } else {
                                    console.error('Invalid response format:', response);
                                    // Handle the error, prevent further execution if needed
                                }
                            } catch (error) {
                                console.error('Error parsing JSON:', error);
                                // Handle JSON parsing error, prevent further execution if needed
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error updating PHP variable:', errorThrown);
                            // Handle the AJAX error, prevent further execution if needed
                        }
                    });
                }
            });

            function updateSubjectOptions(subjects) {
                // Clear existing options
                $('#event_subject').empty();

                // Add a default option
                $('#event_subject').append('<option value="">Select Subject</option>');

                // Add subjects based on the selected class
                for (var i = 0; i < subjects.length; i++) {
                    $('#event_subject').append('<option value="' + subjects[i] + '">' + subjects[i] + '</option>');
                }
            }

            // Function to validate email format
            function isValidEmail(email) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Function to update error messages below the input field
            function updateErrorField(inputField, message) {
                var errorField = inputField.next('.error-message');
                if (!errorField.length) {
                    errorField = $('<div class="error-message"></div>').insertAfter(inputField);
                }
                errorField.text(message).css('color', 'red');
            }

            // Function to clear all error messages
            function clearAllErrorMessages() {
                $('.error-message').text('').css('color', ''); // Reset text and color
            }

            // Real-time validation for role
            $('#event_role').on('change', function() {
                var role = $(this).val().trim();
                if (role === '') {
                    updateErrorField($(this), 'Select a role.');
                } else {
                    updateErrorField($(this), '');
                }
            });

            // Real-time validation for name
            $('#Student_name').on('input', function() {
                var name = $(this).val().trim();
                if (name === '') {
                    updateErrorField($(this), 'Name cannot be empty.');
                } else {
                    updateErrorField($(this), '');
                }
            });

            // Real-time validation for email
            $('#Student_email').on('input', function() {
                var email = $(this).val().trim();
                if (!isValidEmail(email)) {
                    updateErrorField($(this), 'Invalid email format.');
                } else {
                    updateErrorField($(this), '');
                }
            });

            // Real-time validation for subject
            $('#event_subject').on('change', function() {
                var subject = $(this).val().trim();
                if (subject === '') {
                    updateErrorField($(this), 'Select a subject.');
                } else {
                    updateErrorField($(this), '');
                }
            });

            // Real-time validation for class
            $('#event_class').on('change', function() {
                var selectedClass = $(this).val().trim();
                if (selectedClass === '') {
                    updateErrorField($(this), 'Select a class.');
                } else {
                    updateErrorField($(this), '');
                }
            });

            // Real-time validation for password
            $('#Student_password').on('input', function() {
                var name = $(this).val().trim();
                if (name === '') {
                    updateErrorField($(this), 'password cannot be empty.');
                } else {
                    updateErrorField($(this), '');
                }
            });

            // Add button click event
            $('#addBtn').on('click', function() {
                // Clear all error messages
                clearAllErrorMessages();

                // Combined check for role, name, email, class, and subject
                // Validate empty fields
                var role = $('#event_role').val().trim();
                var name = $('#Student_name').val().trim();
                var email = $('#Student_email').val().trim();
                var selectedClass = $('#event_class').val().trim();
                var selectedSubject = $('#event_subject').val().trim();
                console.log(selectedSubject);
                var password = $('#Student_password').val().trim();

                // Combined check for role, name, email, class, and subject
                if (role === '' || name === '' || selectedClass === '' || email === '' || selectedSubject === '' || password === '') {
                    if (role === '') updateErrorField($('#event_role'), 'Select a role.');
                    if (name === '') updateErrorField($('#Student_name'), 'Name cannot be empty.');
                    if (email === '') {
                        updateErrorField($('#Student_email'), 'Email cannot be empty.');
                    } else if (!isValidEmail(email)) {
                        updateErrorField($('#Student_email'), 'Invalid email format.');
                        return;
                    }
                    if (selectedClass === '') updateErrorField($('#event_class'), 'Select a class.');
                    if (selectedSubject === '') updateErrorField($('#event_subject'), 'Select a subject.');
                    if (password === '') updateErrorField($('#Student_password'), 'password cannot be empty.');
                    return;
                }



                // Perform AJAX request to insert data into the database
                $.ajax({
                    type: 'POST',
                    url: 'insert_data.php', // Change this to the actual URL of your server-side script
                    data: $('#registrationFormADD').serialize(),
                    success: function(response) {
                        // Handle the response from the server
                        if (response.success) {
                            // Display success message using SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Data inserted successfully!',
                            }).then((result) => {
                                // Close the modal when the SweetAlert success button is clicked
                                if (result.isConfirmed || result.isDismissed) {
                                    location.reload();
                                }
                            });
                        } else {
                            // Display error message using SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error inserting data. Please try again.',
                            });

                            // Log the error to the console
                            console.error('Error inserting data:', response.error);
                        }
                    },
                    error: function() {
                        // Handle AJAX errors
                        // Display error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Error occurred while processing the request.',
                        });

                        // Log the error to the console
                        console.error('Error occurred while processing the request.');
                    }
                });

            });
        });
    </script>


    <!-- update ajax  -->
    <script>
        $(document).ready(function() {
            // Function to update subjects based on the selected class
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
                                updateSubjectOptionsUpdate(parsedResponse.subjects);
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

            // Event listener for class selection change
            $('#event_class_update').on('change', function() {
                var selectedClass = $(this).val().trim();
                updateSubjects(selectedClass);
            });

            function updateSubjectOptionsUpdate(subjects) {
                $('#event_subject_update').empty();
                $('#event_subject_update').append('<option value="">Select Subject</option>');

                for (var i = 0; i < subjects.length; i++) {
                    $('#event_subject_update').append('<option value="' + subjects[i] + '">' + subjects[i] + '</option>');
                }
            }

            $('.update-button').on('click', function(e) {
                e.preventDefault();

                var userId = $(this).data('id');
                $('#updateData').data('userId', userId);
                $.ajax({
                    type: 'GET',
                    url: 'get_data.php?id=' + userId,
                    success: function(data) {
                        var userData = JSON.parse(data);

                        // Set the values for text inputs
                        $('#Student_name_update').val(userData.name);
                        $('#Student_email_update').val(userData.email);
                        $('#event_class_update').val(userData.class_id);
                        $('#event_subject_update').val(userData.subject_id);
                        // Open the modal
                        $('#modalRegisterForm').modal('show');
                        var initialClass = $('#event_class_update').val().trim();
                        updateSubjects(initialClass);
                    },
                    error: function() {
                        console.error('Error fetching user data');
                    }
                });
            });


            // Function to update error messages below the input field
            function updateErrorField(inputField, message) {
                var errorField = inputField.next('.error-message');
                if (!errorField.length) {
                    errorField = $('<div class="error-message"></div>').insertAfter(inputField);
                }
                errorField.text(message);
            }

            // Add real-time validation for empty fields
            $('#Student_name_update, #Student_email_update, #event_class_update, #event_subject_update').on('input', function() {
                var fieldId = $(this).attr('id');
                var fieldValue = $(this).val().trim();

                // Reset error message for the current field
                updateErrorField($(this), '');

                // Check for empty field
                if (fieldValue === '') {
                    var fieldName = '';
                    // Add the corresponding field name here
                    switch (fieldId) {
                        case 'Student_name_update':
                            fieldName = 'Name';
                            break;
                        case 'Student_email_update':
                            fieldName = 'Email';
                            break;
                        case 'event_class_update':
                            fieldName = 'Class';
                            break;
                        case 'event_subject_update':
                            fieldName = 'Subject';
                            break;
                    }

                    // Display error message for empty field
                    updateErrorField($(this), fieldName + ' cannot be empty.');
                }
            });

            // Add button click event
            $('#updateData').on('click', function() {
                //console.log("test");
                // Validate empty fields
                var fields = [{
                        id: 'Student_name_update',
                        name: 'Name'
                    },
                    {
                        id: 'Student_email_update',
                        name: 'Email'
                    },
                    {
                        id: 'event_class_update',
                        name: 'Class'
                    },
                    {
                        id: 'event_subject_update',
                        name: 'Subject'
                    },
                ];

                var emptyFields = false;

                // Reset all error messages
                $('.error-message').text('');

                // Combined check for empty fields
                fields.forEach(function(field) {
                    var fieldValue = $('#' + field.id).val().trim();
                    if (fieldValue === '') {
                        updateErrorField($('#' + field.id), field.name + ' cannot be empty.');
                        emptyFields = true;
                    }
                });

                if (emptyFields) {
                    return;
                }

                var userId = $('#updateData').data('userId');
                console.log(userId);

                // Rest of your existing code for updating data...
                var name = $('#Student_name_update').val().trim();
                var email = $('#Student_email_update').val().trim();
                var classId = $('#event_class_update').val().trim();
                var subjectId = $('#event_subject_update').val().trim();

                //console.log("Name: " + name);
                //console.log("Email: " + email);
                //console.log("Class ID: " + classId);
                //console.log("Subject ID: " + subjectId);


                $.ajax({
                    type: 'POST',
                    url: 'update_data.php',
                    data: {
                        id: userId,
                        name: name,
                        email: email,
                        class_id: classId,
                        subject_id: subjectId,
                    },

                    success: function(response) {
                        console.log(response);
                        console.log('Data updated successfully');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Data updated successfully',
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                location.reload();
                            }
                        });
                    },
                    error: function() {
                        console.error('Error updating data');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Error updating data',
                        });
                    }
                });
            });
        });
    </script>


    <!-- ajax for delete button  -->
    <script>
        $(document).ready(function() {
            // Add click event for delete link
            $('.delete-button').on('click', function(e) {
                e.preventDefault();

                // Get the student ID from the data attribute
                var studentId = $(this).data('id');

                // Confirm deletion with the user
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request for deletion
                        $.ajax({
                            type: 'GET',
                            url: 'delete_data.php',
                            data: {
                                id: studentId
                            },
                            success: function(response) {
                                // Parse the JSON response
                                try {
                                    var responseData = JSON.parse(response);
                                    if (responseData.success) {
                                        // Display success message using SweetAlert
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: 'Data deleted successfully!',
                                        }).then((result) => {
                                            // Reload the page or perform any other necessary actions
                                            location.reload();
                                        });
                                    } else {
                                        // Display error message using SweetAlert
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Error deleting data. Please try again.',
                                        });

                                        // Log the error to the console
                                        console.error('Error deleting data:', responseData.error);
                                    }
                                } catch (error) {
                                    console.error('Error parsing JSON response:', error);
                                }
                            },
                            error: function() {
                                // Handle AJAX errors
                                // Display error message using SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Error occurred while processing the request.',
                                });

                                // Log the error to the console
                                console.error('Error occurred while processing the request.');
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>