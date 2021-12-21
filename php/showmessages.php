<?php
session_start();


if (isset($_SESSION['unique_id'])) {

    include_once "connect.php";
    $outgoing_id = $_SESSION['unique_id'];
    $outgoing_id = $_SESSION['unique_id'];
    date_default_timezone_set("Asia/Calcutta");
    $d = gmdate(date('Y-m-d G:i:s'));
    $sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE unique_id = '{$outgoing_id}'");
    $las = $d;
    


    ?><?php
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        
        
        while ($row = mysqli_fetch_assoc($query)) {
            

            $ciphering = "AES-128-CTR";


            $options = 0;
            $encryption = $row['msg'];
            $decryption_iv = '3214567891011121';

            // Store the decryption key
            $decryption_key = "ArTqW";

            // Use openssl_decrypt() function to decrypt the data
            $decryption = openssl_decrypt(
                $encryption,
                $ciphering,
                $decryption_key,
                $options,
                $decryption_iv
            );
            $timedetail =  $row['sendat'];
            // $current_time = $timedetail.strftime("%H:%M:%S");

            // $str_time = $timedetail.strptime($timedetail, "%m/%j/%y %H:%M");



            $timedetail = explode(" ", $timedetail);
            date_default_timezone_set("Asia/Calcutta");
                $d = gmdate(date('Y-m-d G:i:s'));
                $d = explode(" ", $d);


                // $timedetail = explode(" ", $timedetail);
                $pro = "";
                if (substr($timedetail[0], 0, 4) == substr($d[0], 0, 4)) {
                    if ((substr($timedetail[0], 5, 5) != substr($d[0], 5, 5))) {
                        $monthNum  = substr($timedetail[0], 5, 2);
                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                        $pro = substr($timedetail[0], 8, 2) . " ".substr( $monthName,0,3) . " | ";
                    }
                } else {

                    $monthNum  = substr($timedetail[0], 5, 2);
                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                    $pro = substr($timedetail[0], 8, 2) ." " .substr( $monthName,0,3) . " ". substr($timedetail[0], 0, 4) . " | ";
                }
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                // $timedetail =  $row['sendat'];
                // $current_time = $timedetail.strftime("%H:%M:%S");

                // $str_time = $timedetail.strptime($timedetail, "%m/%j/%y %H:%M");

                

                // 1 for time
                // 0 for date




                // print_r($timedetail[1]);
                $output .= '
                
                
                <div class="chat outgoing">
                                <div class="details">
                                    <p>' . $decryption  . ' 

                                
                                    </p><div style= "color: black;
                                    display: block;
                                    font-size: 8px;
                                    margin: -11px -10pxs 0 0;" > &nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . $pro . substr($timedetail[1], 0, 5) . '</div>
                                    </div>
                                    </div>   
                                    
                                    ';
            } else {
                $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p>' . $decryption  . '</p>
                                    <div style="color: black;
                                    display: block;
                                    font-size: 8px;
                                    margin: -11px -10pxs 0 0; "> &nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . $pro . substr($timedetail[1], 0, 5) . '</div>
                                   
                                </div>
                                </div>
                                ';
            }
        }
    } else {
        $output .= '<div class="text"> We try to provide a platform to help you get in touch <br>with almost any student of college.<br> Chat responsibly.<br>You might face delay upto to 20 sec in refreshing the page. <br> Thank you.</div>';
    }
    echo $output;
} else {
    die("Error");
}

// <div style="width = 15px; background-color: blue;" class="chat">

?>
