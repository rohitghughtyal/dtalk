<?php

// printintg search query;
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);

        
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="";

        $ciphering = "AES-128-CTR";


        $options = 0;
        $encryption = $result;
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
        (strlen($decryption) > 20) ? $msg =  substr($decryption, 0, 16) . '...' : $msg = $decryption;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        // ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";



        $output .= '<a         " href="dtalklive.php?user_id='. $row['unique_id'] .'">
                   <div style= "overflow-x: hidden ;" class="details"> <div class="content" style = "min-width: 400px ; "  >
                    
                   <img style = "float: left; margin : 0px 7px 0px 2px ; "  src="php/images/'. $row['img'] .'" alt=""> 
                        <span style= " display: block;  ; color:black ; font-size: 15px" >' . $row['fname']. " " .'
                        <p style = "min-width:250px ;color: rgb(56,56,56); display : flex; font-weight: 100 " >'. $you . $msg .'</p></span>
                    </div> 
                    </div>
                    
                    
                    
                </a>';
    }
?>