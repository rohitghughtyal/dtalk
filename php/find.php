<?php
    session_start();
    include_once "connect.php";

    $outgoing_id = $_SESSION['unique_id'];

    if($_POST['searchTerm'] != '' and !ctype_space($_POST['searchTerm'])){
    
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%') AND (lastactive is not NULL) LIMIT 4";   // adde last active on 27 jun 21
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "query.php";
    }else{
        $output .= 'Unable to find given name.';
    }
    echo $output;}else{
        echo 'Please enter something';
    }
?>