<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- cdn for jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Include jQuery and SweetAlert2 libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        a {
            color: blue;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: #512da8;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }

        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input,
        .container select {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle {
            background-color: #512da8;
            height: 100%;
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        .btn-primary {
            color: #fff !important;
            background-color: #1cc88a !important;
            border-color: #1cc88a !important;
        }

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer !important;
        }

        .toggle {
            background: linear-gradient(to right, #5c6bc0, #1cc88a) !important;
        }

        #emailError {
            padding-right: 117px;
        }

        #passwordError {
            padding-right: 150px;
        }

        .swal2-styled.swal2-confirm {
            background-color: #1cc88a !important;
        }

        #roleError {
            padding-right: 134px;
        }
    </style>
</head>

<body>
    <!-- student part  -->
    <div class="container" id="container">
        <div class="form-container sign-up">
        </div>

        <!-- admin part  -->
        <div class="form-container sign-in">
            <form class="user" action="#" method="POST" id="loginForm">
                <h1>Login</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <!-- <select class="form-control form-control-user" id="selectRole" placeholder="" name="">
                    <option value="">Select role</option>
                    <?php
                    // $query = 'SELECT * FROM roles';
                    // $result = mysqli_query($conn, $query);

                    // while ($row = mysqli_fetch_array($result)) {
                    //     $className = $row['roles_name'];
                    //     echo "<option value='$className'>$className</option>";
                    // }
                    ?>
                </select> -->
                <span id="roleError" style="color: red;"></span>
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Your Email Address..." name="email" value="<?php if (isset($_POST['email'])) {
                                                                                                                                                                                            echo $_POST['email'];
                                                                                                                                                                                        } ?>">
                <span id="emailError" style="color: red;"></span>
                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Your Password..." name="password">
                <span id="passwordError" style="color: red;"></span>
                <a href="forgot-password.php" style="color: blue;">Forgot Password?</a>
                <input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">

                <div class="toggle-panel toggle-right">
                    <h1>Welcome</h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            $('#exampleInputEmail').on('input', function() {
                var email = $(this).val();

                if (!emailRegex.test(email) || !email) {
                    $('#emailError').text('Please enter a valid email address.');
                } else {
                    $('#emailError').text('');
                }
            });

            $('#exampleInputPassword').on('input', function() {
                var password = $(this).val();

                if (!password) {
                    $('#passwordError').text('Please enter your password.');
                } else {
                    $('#passwordError').text('');
                }
            });

            $('#loginForm').submit(function(e) {
                e.preventDefault();

                var email = $('#exampleInputEmail').val();
                var password = $('#exampleInputPassword').val();
                // var selectedRole = $('#selectRole').val();

                var isValid = true;

                if (!emailRegex.test(email) || !email) {
                    $('#emailError').text('Please enter a valid email address.');
                    isValid = false;
                } else {
                    $('#emailError').text('');
                }

                if (!password) {
                    $('#passwordError').text('Please enter your password.');
                    isValid = false;
                } else {
                    $('#passwordError').text('');
                }

                if (!isValid) {
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'check_login.php',
                    data: {
                        email: email,
                        password: password
                        // role: selectedRole
                    },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Successful',
                                text: 'Redirecting to Dashboard...',
                                showConfirmButton: false,
                                timer: 2000,
                                allowOutsideClick: false
                            }).then(function() {
                                <?php
                                $sql = "SELECT * FROM Permission";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $redirectURL = ''; // Initialize redirectURL variable

                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        // Convert CheckboxValues to an array
                                        $checkboxValuesArray = explode(",", $row["CheckboxValues"]);

                                        // Check for specific permissions and set redirectURL accordingly
                                        if (in_array('members_view', $checkboxValuesArray)) {
                                            $redirectURL = 'data.php';
                                            break; // Break out of the loop if the condition is met
                                        } elseif (in_array('dashboard_view', $checkboxValuesArray)) {
                                            $redirectURL = 'dashboard.php';
                                        } elseif (in_array('timetable_view', $checkboxValuesArray)) {
                                            $redirectURL = 'timetable.php';
                                        } elseif (in_array('permissions_view', $checkboxValuesArray)) {
                                            $redirectURL = 'Staff_Permissions.php';
                                        }
                                    }

                                    // Redirect to the determined URL
                                    echo "window.location.href = '{$redirectURL}';";
                                }
                                ?>
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Failed',
                                text: 'Invalid credentials. Please try again.',
                            });
                        }
                    },

                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.',
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>