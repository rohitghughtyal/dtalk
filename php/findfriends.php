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
    
    $sql = "SELECT * FROM users  WHERE NOT unique_id = {$outgoing_id} AND year= '{$year}' AND department = '{$dept}' AND (lastactive is not NULL)  ORDER BY user_id";
    
  
    // session_abort();
    // print_r($sql);
    $query = mysqli_query($conn, $sql);
    $output = "";
    echo '<div style ="font-weight: 50">You might know them: </div>';
    if(mysqli_num_rows($query) == 0){
        $output .= '<div style= "font-weight: 100;">No users are available to chat</div>';
    }elseif(mysqli_num_rows($query) > 0){
        include_once "query.php";
    }
    echo $output;
?>