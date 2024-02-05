<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="actual-integrity-hash-here" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bg-gradient-primary {
            background-color: #1cc88a !important;
            background-image: linear-gradient(180deg, #1cc88a 10%, #1cc88a 100%) !important;
        }

        .active {
            background-color: #1cc88a;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Student_data.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa fa-home" aria-hidden="true"></i>
            </div>
            <div class="sidebar-brand-text mx-3">College Management</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <?php
        $activePage = basename($_SERVER['PHP_SELF'], ".php");
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

                if (in_array('dashboard_view', $checkboxValuesArray)) {
        ?>
                    <li class="nav-item <?php if ($activePage == 'dashbord') echo "active"; ?>">
                        <a class="nav-link" href="dashbord.php">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span <?php if ($activePage == 'dashbord') echo 'class="highlight"'; ?>>Dashboard</span>
                        </a>
                    </li>
                <?php
                }

                if (in_array('members_view', $checkboxValuesArray)) {
                ?>
                    <li class="nav-item <?php if ($activePage == 'data') echo "active"; ?>">
                        <a class="nav-link" href="data.php">
                            <i class="fa-solid fa-user-plus"></i>
                            <span <?php if ($activePage == 'data') echo 'class="highlight"'; ?>>Members</span>
                        </a>
                    </li>
                <?php
                }

                if (in_array('timetable_view', $checkboxValuesArray)) {
                ?>
                    <li class="nav-item <?php if ($activePage == 'timetable') echo "active"; ?>">
                        <a class="nav-link" href="timetable.php">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span <?php if ($activePage == 'timetable') echo 'class="highlight"'; ?>>Time-table</span>
                        </a>
                    </li>
                <?php
                }

                if (in_array('export_timetable_data_view', $checkboxValuesArray)) {
                ?>
                    <li class="nav-item <?php if ($activePage == 'export_timetable_data') echo "active"; ?>">
                        <a class="nav-link" href="export_timetable_data.php">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span <?php if ($activePage == 'export_timetable_data') echo 'class="highlight"'; ?>>Export Timetable Data</span>
                        </a>
                    </li>
                    <?php
                }

                if (in_array('permissions_view', $checkboxValuesArray)) {
                    $check_user = $_SESSION['roles_id'];
                    if ($check_user == 'Super_Admin' || $check_user == 'Admin') {
                    ?>
                        <li class="nav-item <?php if ($activePage == 'Staff_Permissions') echo "active"; ?>">
                            <a class="nav-link" href="Staff_Permissions.php">
                                <i class="fas fa-user-check"></i>
                                <span <?php if ($activePage == 'Staff_Permissions') echo 'class="highlight"'; ?>>Permissions</span>
                            </a>
                        </li>
                    <?php
                    }
                }
            } elseif ($_SESSION['roles_id'] == $Permissionsrole && $nameoftheuser == $Permissionsname) {
                $pagepermission = '';

                foreach ($checkboxValuesArray as $value) {
                    $pagepermission .= $value . '<br>';
                }

                if (in_array('dashboard_view', $checkboxValuesArray)) {
                    ?>
                    <li class="nav-item <?php if ($activePage == 'dashbord') echo "active"; ?>">
                        <a class="nav-link" href="dashbord.php">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span <?php if ($activePage == 'dashbord') echo 'class="highlight"'; ?>>Dashboard</span>
                        </a>
                    </li>
                <?php
                }

                if (in_array('members_view', $checkboxValuesArray)) {
                ?>
                    <li class="nav-item <?php if ($activePage == 'data') echo "active"; ?>">
                        <a class="nav-link" href="data.php">
                            <i class="fa-solid fa-user-plus"></i>
                            <span <?php if ($activePage == 'data') echo 'class="highlight"'; ?>>Members</span>
                        </a>
                    </li>
                <?php
                }

                if (in_array('timetable_view', $checkboxValuesArray)) {
                ?>
                    <li class="nav-item <?php if ($activePage == 'timetable') echo "active"; ?>">
                        <a class="nav-link" href="timetable.php">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span <?php if ($activePage == 'timetable') echo 'class="highlight"'; ?>>Time-table</span>
                        </a>
                    </li>
                <?php
                }

                if (in_array('export_timetable_data_view', $checkboxValuesArray)) {
                ?>
                    <li class="nav-item <?php if ($activePage == 'export_timetable_data') echo "active"; ?>">
                        <a class="nav-link" href="export_timetable_data.php">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span <?php if ($activePage == 'export_timetable_data') echo 'class="highlight"'; ?>>Export Timetable Data</span>
                        </a>
                    </li>
                    <?php
                }

                if (in_array('permissions_view', $checkboxValuesArray)) {
                    $check_user = $_SESSION['roles_id'];
                    if ($check_user == 'Super_Admin' || $check_user == 'Admin') {
                    ?>
                        <li class="nav-item <?php if ($activePage == 'Staff_Permissions') echo "active"; ?>">
                            <a class="nav-link" href="Staff_Permissions.php">
                                <i class="fas fa-user-check"></i>
                                <span <?php if ($activePage == 'Staff_Permissions') echo 'class="highlight"'; ?>>Permissions</span>
                            </a>
                        </li>
                    <?php
                    }
                }
            } else {
                $check_user = $_SESSION['roles_id'];
                if ($check_user != 'Staff') {
                    ?>
                    <li class="nav-item <?php if ($activePage == 'dashbord') echo "active"; ?>">
                        <a class="nav-link" href="dashbord.php">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span <?php if ($activePage == 'dashbord') echo 'class="highlight"'; ?>>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if ($activePage == 'data') echo "active"; ?>">
                        <a class="nav-link" href="data.php">
                            <i class="fa-solid fa-user-plus"></i>
                            <span <?php if ($activePage == 'data') echo 'class="highlight"'; ?>>Members</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($activePage == 'timetable') echo "active"; ?>">
                        <a class="nav-link" href="timetable.php">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span <?php if ($activePage == 'timetable') echo 'class="highlight"'; ?>>Time-table</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($activePage == 'export_timetable_data') echo "active"; ?>">
                        <a class="nav-link" href="export_timetable_data.php">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span <?php if ($activePage == 'export_timetable_data') echo 'class="highlight"'; ?>>Export Timetable Data</span>
                        </a>
                    </li>
                    <?php
                    $check_user = $_SESSION['roles_id'];
                    if ($check_user == 'Super_Admin' || $check_user == 'Admin') {
                    ?>
                        <li class="nav-item <?php if ($activePage == 'Staff_Permissions') echo "active"; ?>">
                            <a class="nav-link" href="Staff_Permissions.php">
                                <i class="fas fa-user-check"></i>
                                <span <?php if ($activePage == 'Staff_Permissions') echo 'class="highlight"'; ?>>Permissions</span>
                            </a>
                        </li>
        <?php
                    }
                }
            }
        }
        ?>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    </ul>

    <!-- End of Sidebar -->
</body>

</html>