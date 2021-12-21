<?php 
//   session_start();
//   include_once "php/config.php";
include_once "connect.php";
include_once "Mail.php";
if (isset($_POST['email'])){


$email = mysqli_real_escape_string($conn, $_POST['email']);
// $password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($email)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

            $otp = uniqid();

            $otp_query =   mysqli_query($conn, "INSERT INTO resetpasswords VALUES ( NULL, '{$email}', '{$otp}' )");

            if ($otp_query) {

                // echo 'wait';
                Mail::sendMail('Reset Password', " <br>DON'T SHARE <br> <br>  <br>Your reset password otp is  : $otp", $email);
                echo nl2br("OTP sent to : ");
                echo nl2br($email);
            }

                    // echo "success";
                
            

    } else {
        echo "$email - Not Registered!";
    }
} }
?>