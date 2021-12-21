<?php

include_once "php/connect.php";
include_once "maintop.php";
if (isset($_GET['token'])){
    $token = $_GET['token'];
// WHERE otp = '{$token}'
    $stoken = sha1($token);
    $select_sql2 = mysqli_query($conn, "SELECT * from verifyusers  where otp = '{$stoken}' ");
    
    // echo $token;
    if (mysqli_num_rows($select_sql2) > 0) {
        $result = mysqli_fetch_assoc($select_sql2);
        $email =  $result['email'];
        // print_r($email);
        $select_sql3 = mysqli_query($conn, "SELECT * from users  where email = '{$email}' ");
        // print_r($select_sql3);
        if (mysqli_num_rows($select_sql3) > 0){
            $result2 = mysqli_fetch_assoc($select_sql3);
            echo nl2br($result2['fname']) . "<br>";
            date_default_timezone_set("Asia/Calcutta");
            $d = gmdate(date('Y-m-d G:i:s'));
            $sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE email = '{$email}'");
            if($sql2) {
                $delsql = mysqli_query($conn , "DELETE from verifyusers where email = '{$email}'");
                echo nl2br($email). "<br><br>";
                echo nl2br("Email Verified \n You can proceed to login");
                
                echo '<section> <a href="index.php">Login now</a> <section>';
            }
            
        }else{
            echo "not applied for registration";
        }
        // $_SESSION['unique_id'] = $result['unique_id'];
    } else {
        echo "Link not valid";
    }

    // echo $token;
    
    // echo '<div> ijsijd</div>' ;
    //  echo "tokenfound";
}else{
    echo "dies";
    die; 
}

?>
