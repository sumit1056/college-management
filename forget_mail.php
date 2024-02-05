<?php
// Include PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

include 'connection.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (!empty($email)) {
        $sql = "SELECT id FROM admin WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['id'];

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'moryasumit1056@gmail.com'; // Your email address
            $mail->Password = 'xcoegntezxiztuqi'; // App password obtained from Gmail
            $mail->Port = 465; // SMTP port
            $mail->SMTPSecure = "ssl"; // Enable SSL encryption

            // Recipients
            $mail->setFrom('moryasumit1056@gmail.com', 'Sumit');
            $mail->addAddress($email, 'User ID: ' . $userId); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Dear User,<br><br>
                           You have requested to reset your password. Click the link below to proceed:<br>
                           <a href="http://localhost/project/password_resert_page.php?id=' . $userId . '" target="_blank">Reset Password</a><br><br>
                           If you did not request this, please ignore this email.<br><br>
                           Regards,<br>
                           Your Website Team';

            // Send the email
            if ($mail->send()) {
                // Email sent successfully, show SweetAlert
                echo 'success';
            } else {
                // Error sending email
                echo 'error';
            }
        } else {
            // Email not found in the database
            echo 'not_exists';
        }
    } else {
        // Email is empty
        echo 'empty';
    }
} else {
    // Email is not set
    echo 'not_set';
}

mysqli_close($conn);
