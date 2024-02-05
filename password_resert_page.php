<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
        .bg-gradient-primary {
            background-color: #1cc88a;
            background-image: linear-gradient(180deg, #1cc88a 10%, #1cc88a 100%);
            background-size: cover;
        }

        .btn-primary {
            color: #fff;
            background-color: #1cc88a;
            border-color: #1cc88a;
        }

        .container,
        .container-fluid,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl {
            margin-top: 70px;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .swal2-styled.swal2-confirm {
            background-color: #1cc88a !important;
        }

        .o-hidden {
            width: 500px !important;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <?php
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        echo "<script>var userId = $userId;</script>";
    } else {
        echo "<script>var userId = null;</script>";
    }
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">Change Your Password?</h1>
                            <p class="mb-4">Create a new password. After the update, you will be able to use this password to login to the website.</p>
                        </div>
                        <form class="user" onsubmit="return updatePassword()">
                            <div class="form-group position-relative">
                                <input type="password" class="form-control form-control-user" id="exampleInputpassword" aria-describedby="emailHelp" placeholder="Your new password">
                                <i class="fas fa-eye eye-icon" onclick="togglePassword('exampleInputpassword')"></i>
                            </div>
                            <div class="form-group position-relative">
                                <input type="password" class="form-control form-control-user" id="exampleInputconformpassword" aria-describedby="emailHelp" placeholder="Confirm password">
                                <i class="fas fa-eye eye-icon" onclick="togglePassword('exampleInputconformpassword')"></i>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            var eyeIcon = passwordInput.nextElementSibling;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        function updatePassword() {
            var password = document.getElementById("exampleInputpassword").value;
            var conformPassword = document.getElementById("exampleInputconformpassword").value;

            if (password === "" || conformPassword === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password and Confirm Password cannot be empty!',
                });
                return false;
            }

            if (password !== conformPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password and Confirm Password do not match!',
                });
                return false;
            }

            // Use AJAX to send the updated password and user ID to the server
            $.ajax({
                url: 'update_password_indatabase.php', // Replace with your server-side script
                type: 'POST',
                data: {
                    userId: userId,
                    password: password
                },
                success: function(response) {
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Password updated successfully!',
                        }).then((result) => {
                            // Redirect to admin_login.php after the user clicks the SweetAlert button
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.href = 'http://localhost/new/admin_login.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to update password. Please try again later.',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An unexpected error occurred. Please try again later.',
                    });
                }
            });

            return false;
        }
    </script>
</body>

</html>