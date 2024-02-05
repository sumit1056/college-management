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
            margin-top: 94px;
        }

        .swal2-styled.swal2-confirm {
            background-color: #1cc88a !important;
        }

        .btn-primary.focus,
        .btn-primary:focus {
            background-color: #1cc88a !important;
            border-color: #1cc88a !important;
        }
        .o-hidden {
            width: 500px !important;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to your mail to reset your password! </p>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Your Email Address...">
                                    </div>
                                    <a href="#" class="btn btn-primary btn-user btn-block" onclick="resetPassword()">
                                        Reset Password
                                    </a>
                                </form>

                            </div>
                        </div>
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
        function resetPassword() {
            var email = document.getElementById('exampleInputEmail').value;

            // Check if email is empty
            if (!email) {
                // Show SweetAlert error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter your email address.',
                });
                return;
            }

            $.ajax({
                url: 'forget_mail.php',
                type: 'POST',
                data: {
                    email: email
                },
                success: function(response) {
                    console.log('Response from the server:', response);

                    if (response === 'success') {
                        // Show SweetAlert success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email sent successfully. Check your inbox!',
                        });
                    } else if (response === 'error') {
                        // Show SweetAlert error for email sending failure
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error sending email. Please try again later.',
                        });
                    } else if (response === 'not_exists') {
                        // Show SweetAlert when email not found in the database
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Email not found in the database.',
                        });
                    } else if (response === 'empty' || response === 'not_set') {
                        // Show SweetAlert for empty or not set email
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Please enter a valid email address.',
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>


</body>

</html>