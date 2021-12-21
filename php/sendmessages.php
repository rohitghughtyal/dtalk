<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "connect.php";
    $outgoing_id = $_SESSION['unique_id'];
    // echo $outgoing_id;
    date_default_timezone_set("Asia/Calcutta");
    $d = gmdate(date('Y-m-d G:i:s'));

    $speID = $_SESSION['unique_id'];
    $sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE unique_id = '{$speID}'");

    // echo date("Y-m-d", strtotime(date('Y-m-d G:i:s')));
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if (!empty($message) and strlen($message) < 100 and !ctype_space($message)) {



        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '3214567891011121';

        // Store the encryption key
        $encryption_key = "ArTqW";

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt(
            $message,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );



        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg , sendat)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$encryption}' , '{$d}' )") or die("bye");
    }
} else {
    header("location: ../index.php");
}
