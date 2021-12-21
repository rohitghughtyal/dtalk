<?php
session_start();
include_once "php/connect.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
$uniqueid = $_SESSION['unique_id'];
date_default_timezone_set("Asia/Calcutta");
$d = gmdate(date('Y-m-d G:i:s'));
$sql2 = mysqli_query($conn, "UPDATE users SET lastactive = '{$d}' WHERE unique_id = '{$uniqueid}'");
?>
<?php
include_once "maintop.php";
?>
<?php
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

 <style>

@media screen and (max-width: 500px) {

.small{
  min-height: 600px !important;
}

}
 </style>

</head>


<body>
    <div class="wrapper small" style="max-width: 800px; min-height: 700px;">
        <section class="users">
            <header> 

            <a href="findfriends.php" class="">
              <img id="logo" src="arrow-left-square.svg" style="float: left ; width: 40px; height: auto; border-radius : 0px " alt="back" />

            </a>

            
            
            
             <!-- <a href="findfriends.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->

            


               <div style="font-size: 18px ; font-weight:bold">Advanced Search
               </div> 

                <!-- <a href="advancedsearch.php" class="logout">Advance Search</a> -->
                <!-- <a href="php/logout.php?logout_id=" class="logout">Logout</a> -->
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="">
              <img id="logo" src="logoff.svg" style=" border-radius:0   " alt="logOff" />

            </a>

            </header>
            <section class="users">


                <div>
                </div>
                <header >
                    Enter Year And Department





                    <form style="display: flex" action="" method="POST">
                        <select name="year" id="rollno" required>
                            <optgroup label="Roll No">
                                <option>2K20</option>
                                <option>2K19</option>
                                <option>2K18</option>
                                <option>2K17</option>
                                <option>2K16</option>

                            </optgroup>
                        </select>
                        <select style="margin-left: 5px;" name="department" id="department" required>
                            <optgroup label="Department">
                                <option>BT</option>
                                <option>CE</option>
                                <option>CO</option>
                                <option>IT</option>
                                <option>SE</option>
                                <option>MC</option>
                                <option>EC</option>
                                <option>EE</option>
                                <option>AE</option>
                                <option>EN</option>
                                <option>EP</option>
                                <option>ME</option>
                                <option>PE</option>
                                <option>PS</option>
                                 <option>B.Des</option>
                                


                            </optgroup>
                        </select>

            
          
                  

      
                        <input style="margin:0 0 0 15px; padding: 1px;border-radius: 15px; font-size: 12px; min-height: 30px; min-width: 60px; " type="submit" name="search" value="search">

                    </form>
                    
            </section>
            </header>

            <!-- <div> -->


            <!-- </div>       <div class="search"> -->



            <!-- 
                <span class="text">Search more</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button> -->
            <!-- </div> -->


            <div class="users-list">
                <?php
                if (isset($_POST['search'])) {


                    $year = mysqli_real_escape_string($conn, $_POST['year']);
                    $department = mysqli_real_escape_string($conn, $_POST['department']);

                    $sql = "SELECT * FROM users  WHERE NOT unique_id = {$uniqueid} AND year= '{$year}' AND department = '{$department}'  AND (lastactive is not NULL)   ORDER BY rand() LIMIT 10";

                    $query = mysqli_query($conn, $sql);

                    $output = "";
                    // echo "You might know them:";
                    if (mysqli_num_rows($query) == 0) {
                        $output .= "NONE FOUND in ". $department . " of " . $year;
                    } elseif (mysqli_num_rows($query) > 0) {

                        // print_r($query);
                        $outgoing_id = $uniqueid;
                        include_once "php/query.php";
                    }
                    echo    $output . '<hr>';
                    // echo  $year . " - " . $department;
                }
                ?>

            </div>
    </div>
    </div>

    </section>


</body>

<script src="javascript/findfriends.js"></script>
<script>
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>