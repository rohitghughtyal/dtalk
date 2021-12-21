<?php
session_start();
include_once "php/connect.php";
if (!isset($_SESSION['unique_id'])) {
  // echo $_SESSION['unique_id'];
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

<style>


@media screen and (max-width: 500px) {

.small{
  min-height: 600px !important;
}

}

</style>

<body>
<!-- <img id="logo" src = "untitled-3.svg" style="  float: left;  width: 80px; height: auto; margin: 0 15px 550px 0  " alt="My Happy SVG"/> -->

  <div style="max-width: 800px; min-height: 700px" class="wrapper small">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          // print_r($sql);
          // echo ($_SESSION['unique_id']);
          // print_r($sql);
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }else{
            // header("location: php/logout.php");
            die('Error');
          }
          ?>

          <img style="float: left;" src="php/images/<?php echo $row['img']; ?>" alt="">
          <div style="width:auto; word-break:keep-all; display:flex; padding-left: 10px" class="test">
            <div class="details">
              <span style="font-size: 16px; font-weight: 0"><?php echo $row['fname'] ?></span>
              <p>
                <?php
                echo substr($row['lastactive'], 11,5);
                ?>
              </p>
            </div>
          </div>
        </div>
        


        <!-- <a href="php/logout.php?logout_id=" class="logout">Logout</a> -->
        
        <a href="findfriends.php" style="background-color: rgb(169,137,230); font-size: 16px ; color: black ; font-weight:200" class="logout"> 
        
        Find Friends</a>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="">
        
              <img id="logo" src="logoff.svg" style= " border-radius: 0" alt="logOff" />

            </a>

      </header>


      <div class="search">
        <span class="text" style="font-size: 15px;">Last Contacted By:</span>
        <input id="findbox"  type="text" placeholder="search...">
        <button style="background-color: transparent;"><img src="search.svg" style= " border-radius: 0; width:40px; height:auto" />
      </button>

      </div>




      <div style="max-height: 460px ; padding : 0 5px" class="users-list">
      </div>



  </div>


  </div>


  </section>
  <script src="javascript/home.js"></script>
  <script>
    // window.opener.location = 'logout.php';
    // window.close();
  </script>


</body>

</html>