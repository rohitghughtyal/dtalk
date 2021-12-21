<?php
// session_start();
include_once "connect.php";
include "Mail.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$year = mysqli_real_escape_string($conn, $_POST['year']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
// 


// if(isset($_POST['signup'])){
//     // $otpGiven = mysqli_real_escape_string($conn, $_POST['otpgiven']);
//     // echo "otp given ".$otpGiven;
//     die;

//   }


$allowed = [
    'dtu.ac.in'
];

if (!empty($fname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "Check spams in your mail. -->";
            echo $email . " --> This dtu email already applied for registration! You might see a mail in spams. Thank You.";
        } else {
            $parts = explode('@', $email);
            $domain = array_pop($parts);
            if (in_array($domain, $allowed)) {


                if(strlen($password) > 5){

                



                if (isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $img_size = $_FILES['image']['size'];
                    // print_r($_FILES['image']);

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ["jpeg", "png", "jpg"];
                    if (in_array($img_ext, $extensions) === true) {
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if (in_array($img_type, $types) === true) {
                            $time =  time();

                            $new_img_name = uniqid() . $time . '.jpg';
                            // echo $tmp_name;
                            if($img_size < 210000) {

                            
                            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                                $ran_id = rand(time(), 100000000);
                                $status = "not verified";
                                $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);
                                // $encrypt_pass = md5($password);

                                // $cstrong = True;
                                // $token = bin2hex(openssl_random_pseudo_bytes(30, $cstrong));
                                // // $stoken = sha1($token);

                                // $otp_query =   mysqli_query($conn, "INSERT INTO verifyusers VALUES ( NULL, '{$email}', '{$stoken}' )")

                                    $otp = uniqid();

                                $otp_query =   mysqli_query($conn, "INSERT INTO verifyusers VALUES ( NULL, '{$email}', '{$otp}' )");

                                if ($otp_query) {
                                    
                                    // echo 'wait';
                                    Mail::sendMail('Verify Email', " <br><br> Welcome to the dtalk . <br>DON'T SHARE <br> <br>  <br>Your verification otp is  : $otp <br>  Thank You <br> Regards <br> <b> dtalk </b> ", $email);
                                    echo nl2br("OTP sent to : ");
                                    echo nl2br($email);
                                    
                                } else {
                                    echo time();
                                    echo "\n dienow :" . uniqid();
                                    exit();
                                }
                                
                                $d = "";


                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id , year, department, fname, email, password, img, lastactive)
                                VALUES ({$ran_id},'{$year}','{$department}', '{$fname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', NULL)");

                                // $secureotp = uniqid();

                                // $encrypt_otp = md5($secureotp);
                                


                                if ($insert_query) {

                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if (mysqli_num_rows($select_sql2) > 0) {
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                    } else {
                                        echo "This email address not Exist!";
                                    }
                                } else {
                                    echo "Something went wrong. Please try again!";
                                }
                            }else{
                                echo "image not uploaded: failed!";
                            }}else{
                                echo "image size more than 200 KB";
                            }
                        } else {
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    } else {
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }
}else{
    echo "make password length more than 5";
}

            } else {
                echo "$email is not dtu email id";
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
