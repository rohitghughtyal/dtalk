<?php
//   session_start();
//   include_once "php/config.php";
include_once "connect.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);
    if (!empty($email) and !empty($otp)) {
        $sql = mysqli_query($conn, "SELECT * FROM verifyusers WHERE email = '{$email}' and otp = '{$otp}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            date_default_timezone_set("Asia/Calcutta");
            $d = gmdate(date('Y-m-d G:i:s'));
            $sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE email = '{$email}'");
            if ($sql2) {
                $delsql = mysqli_query($conn, "DELETE from verifyusers where email = '{$email}'");
                echo nl2br($email);
                echo nl2br("-->Email Verified. You can proceed to login");
            }

            // echo "success";



        } else {
            echo "$email - Not Registered! or verification done or enter value don't match";
        }
    }
