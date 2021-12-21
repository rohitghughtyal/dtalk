<?php
//   session_start();
//   include_once "php/config.php";
include_once "connect.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$otp = mysqli_real_escape_string($conn, $_POST['otp']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($email) and !empty($otp)) {
    $sql = mysqli_query($conn, "SELECT * FROM resetpasswords WHERE userid = '{$email}' and token = '{$otp}'");
    // print_r($sql);
    if (mysqli_num_rows($sql) > 0) {

        if (strlen($password) > 5) {
            $encPass = password_hash($password, PASSWORD_BCRYPT);
            $pasSql = mysqli_query($conn, "UPDATE users set password = '{$encPass}'  where email = '{$email}'");
            // $row = mysqli_fetch_assoc($sql);
            date_default_timezone_set("Asia/Calcutta");
            $d = gmdate(date('Y-m-d G:i:s'));
            $sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE email = '{$email}'");
            if ($sql2) {
                $delsql = mysqli_query($conn, "DELETE from resetpasswords where userid = '{$email}'");
                echo nl2br($email);
                echo nl2br("-->Email Verified and password change. You can proceed to login");
            }
        } else {
            echo "make password length more than 5";
        }



        // echo "success";



    } else {
        echo "$email - Not Requested change Password";
    }
}
