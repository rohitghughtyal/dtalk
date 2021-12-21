<?php
    session_start(); // removeds session
    include_once "mainf.php";
    if(isset($_SESSION['unique_id'])){
        include_once "connect.php";
        
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        // print_r($_GET['logout_id']);
        if(isset($logout_id)){

            date_default_timezone_set("Asia/Calcutta");
             $d = gmdate(date('Y-m-d G:i:s'));
            $sql = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE unique_id={$_GET['logout_id']}");
            // $sql = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE unique_id={$_GET['logout_id']}");
            
            
            
                print_r("logged out success:  ");
                echo '<a href= "https://dtalkproject.000webhostapp.com/index.php"> Login Again </a>';
                // $sql4 = mysqli_query($conn , "DELETE from logintokens where userid = {$_GET['logout_id']}");
                // DB::query('DELETE FROM loginTokens WHERE UserID= :UserID', array(':UserID'=>LoginC::isLoggedIn()));

                session_unset();
                session_destroy();
                // header("location: https://projectdtalk.000webhostapp.com/index.php"); // added address
            
        }else{
            print_r("Error: no logout");
            // header("location: ../users.php");
        }
    }else{  
        print_r("NOT LOGGED IN");
        // header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>dtalk</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" href="finalfav.png" type="image/png" > 
 
  
  <style>
    .btn-grad {
    background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%)
  }

  .btn-grad {
    margin: 0px 0 0 0;
    /* padding: 15px 45px; */
    height: 50px;
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    /* color: white;             */
    /* box-shadow: 0 0 20px #eee; */
    border-radius: 100px;
    /* display: block; */
  }

  .btn-grad:hover {
    background-position: right center;
    /* change the direction of the change here */
    color: #fff;
    text-decoration: none;
  }

  </style>
</head>