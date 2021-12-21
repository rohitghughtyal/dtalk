<?php
    session_start();
    include_once "connect.php";
    $outgoing_id = $_SESSION['unique_id'];
    // echo $outgoing_id;

    $res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$outgoing_id}'"));
    // $dept = mysqli_fetch_assoc(mysqli_query($conn, "SELECT department FROM users WHERE unique_id = {$outgoing_id}"));
    // print_r ($res);
    $year = $res ['year'];
    $dept  = $res['department'];
    // echo $dept . $year;
    $myq = "SELECT max(msg_id),incoming_msg_id,outgoing_msg_id , msg FROM messages WHERE incoming_msg_id =  {$outgoing_id} GROUP by outgoing_msg_id order by max(msg_id) desc ";
    $query4 = mysqli_query($conn, $myq);
    // print_r($query4);
    if (mysqli_num_rows($query4) > 0){
        echo '<div style = "margin: 0 0 6px 0; font-size: 15px"> Chats : </a></div>';
        foreach ($query4 as $r){
            // print_r($r);
            
      

    $sql = "SELECT * FROM users  WHERE unique_id = {$r['outgoing_msg_id']}";
  
    // session_abort();
    // print_r($sql);
    $query = mysqli_query($conn, $sql);
    $output = "";
    // echo"You asasa might know them:";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include "query.php";
    }
    echo $output;}  }
?>