<?php
session_start();
include_once "connect.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if ($row['lastactive'] != '') {


            // $user_pass = md5($password);

            $orgpassword = $row['password'];
            if (password_verify($password , $orgpassword)) {

                date_default_timezone_set("Asia/Calcutta");
                $d = gmdate(date('Y-m-d G:i:s'));
                $sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE unique_id = {$row['unique_id']}");
                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];

                    // $cstrong = True;
                    // $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    // // $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id , year, department, fname, email, password, img, lastactive)
                    // // VALUES ({$ran_id},'{$year}','{$department}', '{$fname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', NULL)");
                    // $stoken = sha1($token);
                    // $sql3 = mysqli_query($conn , "INSERT into logintokens (userid, token) values ({$row['unique_id']} , '{$stoken}')");
                    // // $user_id = DB::query('SELECT UserID FROM verifiedAccounts WHERE UserID=:USERID', array(':USERID' => $userID))[0]['UserID'];
                    // // echo $token;
                    // // DB::query('INSERT INTO loginTokens VALUES ( :token , :UserID)', array(':token' => sha1($token), ':UserID' => $user_id));
                    // setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    // setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                    echo "success";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Email or Password is Incorrect!";
            }
        } else {
            echo "not verified";
        }
    } else {
        echo "$email - This email not Exist!";
    }
} else {
    echo "All input fields are required!";
}
