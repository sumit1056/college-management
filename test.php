<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Permissions | Bootstrap Simple Admin Template</title>
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">
    <script src="https://kit.fontawesome.com/a1892d470d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1cc88a;
            margin: 0;
            padding: 0;
        }

        button {
            background-color: #1cc88a;
            border: 2px solid #1cc88a;
            border-radius: 0.9em;
            padding: 0.8em 1.2em;
            transition: background-color 0.3s;
            font-size: 16px;
            margin-top: -3%;
            margin-left: 28%;
        }

        button span {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: 600;
        }

        button:hover {
            background-color: #1cc88a;
        }

        /* Page Layout */
        #wrapper {
            display: flex;
        }

        #content-wrapper {
            flex: 1;
            overflow-x: hidden;
        }

        /* Image and Button Section */
        .wapperImage {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 70px;
        }

        #imageandbutton {
            max-width: 300px;
            margin: auto;
            gap: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #buttondive button {
            width: 100%;
            margin: 0;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            transform: scale(0.8);
        }

        .modal.show {
            display: flex;
            opacity: 1;
            transform: scale(1);
        }

        /* Permission Set Form */
        .permission-set {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            padding-bottom: 7px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: blowUp 0.3s ease-in-out;
        }

        @keyframes blowUp {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Buttons and Inputs */
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        select,
        input[type="text"] {
            flex: 1;
            width: 100%;
            margin-left: 10px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .buttons.saveandcancle {
            margin-top: 23px;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #1cc88a;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        button[type="submit"],
        button.Cancelbutton {
            margin-left: 10px;
        }

        h3 {
            margin-right: 54%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            button,
            #imageandbutton {
                margin-left: 0;
            }

            .close-button {
                cursor: pointer;
                font-size: 15px;
                color: #333;
            }

            .headingandclose h3 {
                margin-right: 54%;
            }

            .buttons {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                /* Align items to the top */
            }

            button[type="submit"],
            button.Cancelbutton {
                margin-left: 10px;
            }
        }

        .line {
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .headingandclose {
            display: flex;
        }

        .savebutton,
        .Cancelbutton {
            color: #fff;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            padding-left: 16px;
        }

        #select_role {
            width: 337%;    
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
            <?php
            include 'topbar.php';
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="content">
                        <div class="container">
                            <div class="page-title">
                                <h4>Staff Permissions</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wapperImage">
                    <div id="imageandbutton">
                        <div id="imagedive">
                            <img src="Remove background project.png" alt="Image">
                        </div>
                        <div id="buttondive">
                            <button onclick="openModal()">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                                    </svg> Add Permissions
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="myModal" class="modal">
                <div class="permission-set">
                    <div class="buttons">
                        <div class="headingandclose">
                            <h3>Add Permission Set</h3>
                            <span class="close-button" onclick="closePopup()">X</span>
                        </div>
                    </div>
                    <div class="line"></div>
                    <form>
                        <div class="form-group">
                            <?php
                            $query = 'SELECT * FROM roles';
                            $result = mysqli_query($conn, $query);
                            ?>
                            <label for="select_role">Name</label>
                            <div class="select-container">
                                <select id="select_role" name="select_role">
                                    <option value="">Select Role</option>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <option value='<?php echo $row['roles_name']; ?>'><?php echo $row['roles_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span id="roleError" class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="select_name">Name</label>
                            <select id="select_name" name="select_name">
                                <option value="">Select Role first</option>
                            </select>
                        </div>

                        <h4>Set Permissions</h4>
                        <table>
                            <tr>
                                <th>Page</th>
                                <th>View</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Export Data</th>
                            </tr>
                            <tr>
                                <td>Dashboard</td>
                                <td><input type="checkbox" id="dashboard_view"></td>
                                <td><!--<input type="checkbox" id="dashboard_add">--></td>
                                <td><!--<input type="checkbox" id="dashboard_edit">--></td>
                                <td><!--<input type="checkbox" id="dashboard_delete">--></td>
                                <td><input type="checkbox" id="dashboard_export"></td>
                            </tr>
                            <tr>
                                <td>Members</td>
                                <td><input type="checkbox" id="members_view"></td>
                                <td><input type="checkbox" id="members_add"></td>
                                <td><input type="checkbox" id="members_edit"></td>
                                <td><input type="checkbox" id="members_delete"></td>
                                <td><input type="checkbox" id="members_export"></td>
                            </tr>
                            <tr>
                                <td>Time-table</td>
                                <td><input type="checkbox" id="timetable_view"></td>
                                <td><input type="checkbox" id="timetable_add"></td>
                                <td><input type="checkbox" id="timetable_edit"></td>
                                <td><input type="checkbox" id="timetable_delete"></td>
                                <td><input type="checkbox" id="timetable_export"></td>
                            </tr>
                            <tr>
                                <td>Permissions</td>
                                <td><input type="checkbox" id="permissions_view"></td>
                                <td><input type="checkbox" id="permissions_add"></td>
                                <td><input type="checkbox" id="permissions_edit"></td>
                                <td><input type="checkbox" id="permissions_delete"></td>
                                <td><input type="checkbox" id="permissions_export"></td>
                            </tr>
                        </table>

                        <div class="line"></div>
                        <div class="buttons saveandcancle" style="text-align: right;">
                            <button type="button" class="savebutton" onclick="getValues()">Save</button>
                            <button type="button" onclick="closePopup()" class="Cancelbutton">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/sb-admin-2.min.js"></script>

            <script>
                // JavaScript code to get the value of the input based on click on the save button
                function getValues() {
                    var roleName = document.getElementById("select_role").value;
                    var name = document.getElementById("select_name").value;

                    // Get the error message element
                    var roleError = document.getElementById("roleError");

                    // Check if a role is selected
                    if (roleName === '') {
                        // Display the error message
                        roleError.innerHTML = 'Please select a role.';
                        return; // Stop execution if the role is not selected
                    }

                    // Clear the error message if a role is selected
                    roleError.innerHTML = '';

                    var allCheckboxValues = [];
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

                    checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                            allCheckboxValues.push(checkbox.id);
                        }
                    });

                    console.log("Role Name:", roleName);
                    console.log("Name:", name);

                    console.log("All Checkbox Values:", allCheckboxValues);
                }

                // JavaScript code to show the name based on the roles you selected
                $(document).ready(function() {
                    $('#select_role').on('change', function() {
                        var selectedRole = $(this).val();
                        var selectNameDropdown = $('#select_name');
                        selectNameDropdown.empty().append('<option value="">Select name</option>');

                        // Clear the error message when a role is selected
                        document.getElementById("roleError").innerHTML = '';

                        if (selectedRole !== '') {
                            $.ajax({
                                url: 'selected_roles.php',
                                type: 'POST',
                                data: {
                                    role: selectedRole
                                },
                                success: function(response) {
                                    var userNames = JSON.parse(response);
                                    $.each(userNames, function(index, userName) {
                                        selectNameDropdown.append('<option value="' + userName + '">' + userName + '</option>');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error fetching user names:', error);
                                }
                            });
                        }
                    });
                });

                // JavaScript function to open the modal
                function openModal() {
                    document.getElementById('myModal').classList.add('show');
                }

                // JavaScript function to close the modal
                function closePopup() {
                    document.getElementById('myModal').classList.remove('show');
                }
            </script>


</body>

</html>