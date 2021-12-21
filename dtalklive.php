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

<style>

@media screen and (max-width: 1024px) {
    .example {
      display: none !important;
    }

  }

  


  @media screen and (max-width: 500px) {

    /* body{
      max-width:  !important;
    } */
    

    .smallchat{
      min-height: 450px !important; 
       max-height: 450px !important;
      /* max-height: 250px !important; */
      /* background-color: red; */
    }

    .small{
      background-color: green;
      max-height: 300px !important;
      min-height: 300px !important;
      /* min-height: 200px !important; */
      /* min-height: 400px !important; */
    }
    .example2{
      /* max-height: 50px !important; */
      min-height: 400px !important;
      /* min-height: 300px !important; */
      /* background-color: orange; */
    }
    .example {
      display: none !important;
    }
    
    .mobile {
      /* when colapsed */
      /* seeing */
      display: block !important;
      /* border-radius: 5000px;  */
     font-size: 14px; min-width: 100px;


    }
    .mobilename{
      word-break: break-all !important;
      /* font-size: 10px; */
    }
    .mobilebtn{
      min-width: 50px;
      min-height: 30px;
      border-radius: 40px;
      padding: 1px;
      margin-left: -5px;
    }
  }

  @media screen and (min-width: 500px) {
    /* when wide */
    .mobilename{
      min-width: 150px !important;
    }
    .mobile {
      display: block !important;
      padding: 1px;border-radius: 15px; 
      font-size: 14px; min-width: 100px;
      margin: 0 0px 0 50px;
    }
    .mobilebtn{
      min-width: 60px;

      min-height: 30px;
      border-radius: 40px;
    }
  }
</style>

<body>
  <!-- <div class="example" style="width: 500px;"> -->


  <div style="max-width: 400px; min-height: 700px ; margin: 0 10px 0 0;" class="wrapper example " id=" chat">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>

          <div> </div>

          <div style="display: flex;">
            <img style="float: left;" src="php/images/<?php echo $row['img']; ?>" alt="">

            <div style="margin: 0px 0 0 10px;" class="details">
              <div style="width:200px; word-break:keep-all;" class="test">
              
                <div class="details">
                  <span><?php echo $row['fname'] ?></span>
                  <p><?php echo substr($row['lastactive'], 11, 5); ?></p>
                </div>
              </div>
            </div>
            <div>

            </div>

            <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="">
              <img id="logo" src="logoff.svg" style=" margin: 0 0px 0 20px; border-radius: 0;  " alt="logOff" />

            </a>

          </div>


        </div>



      </header>


      <div class="search">
        <span class="text" style="font-size: 15px;">Last Contacted By:</span>
        <input  id="findbox" type="text" placeholder="search...">
        <button style="background-color: transparent;"><img src="search.svg" style=" border-radius: 0; width:40px; height:auto" />
        </button>

      </div>

      <!-- for user list margin -->

      <div style=" max-height: 410px ; padding : 0 5px; overflow-x: hidden" class="users-list">

      </div>



  </div>

  </div>



  </section>

  <script>
    // window.opener.location = 'logout.php';
    // window.close();
  </script>

  <div class="wrapper example2" style="max-width: 500px; min-height: 700px">
    <section class="chat-area">
      <header>
        <?php

        $check = false;
        // echo $_SESSION['unique_id'];
        if(!isset($_GET['user_id'])){
            header( "location: home.php");
        }
        if($_GET['user_id'] == $_SESSION['unique_id']){
          header( "location: home.php");
      }

        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sender = $_SESSION['unique_id'];
        // echo $sender;
        // echo '<br>' . $user_id;
        $sql2 = mysqli_query($conn, "SELECT * FROM blockedchats WHERE userid = {$sender}");
        $sql3 = mysqli_query($conn, "SELECT * FROM blockedchats WHERE blockedid = {$sender}");
        // print_r($sql3);
        $isblocked = false;
        $canchat = true;
        foreach ($sql2 as $entry) {
          if ($entry['blockedid'] == $user_id) {
            // echo "you are blocked";
            $isblocked = true;
          }
        }
        foreach ($sql3 as $entry2) {

          if ($entry2['userid'] == $user_id) {
            // echo "you are blocked";
            $canchat = false;
          }
          // print_r($entry);

        }

        // if (mysqli_num_rows($sql2) > 0) {
        //   $res = mysqli_fetch_assoc($sql2);
        //   // print_r($res);
        // } else {
        //   echo "no blockage";
        //   echo $user_id;
        // }
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: home.php");
        }



        $isFollowing = false;


        ?>


        <!-- first -->

        <div style="display: flex;" >
          <a href="home.php" class="">
            <img id="logo" src="arrow-left-square.svg" style="float: left ; width: 40px; height: auto; border-radius : 0px " alt="logOff" />

          </a>

          <!-- <a href="users.php"  class="back-icon-example2"><i class="fas fa-arrow-left"> back</i></a> -->

          <!-- second and 3 -->
          <img src="php/images/<?php echo $row['img']; ?>" alt="">

        <!-- for manupulation -->
          <div class="mobilename" style="padding-right: 5px; min-width:80px ;  max-width:300px; word-break:keep-all;" class="test">

            <div class="details">
              <span style="min-width:200px ; width:auto !important ;" ><?php echo $row['fname'] ?></span>
              <p><?php if ((strtotime($d)  - strtotime($row['lastactive'])) / 60 < 20) {
                    echo ' <div style = "font-size: 10px; word-break: keep-all" >seen few mins ago </div>';
                  } ?></p>
            </div>
          </div>

          <!-- pending -->

          
          <?php
          // $check = true;

          $sen = (int) $sender;
          $use = (int) $user_id;

          if (isset($_POST['unblock'])) {
            // echo $sender . " ". $user_id;//
            $select_sql5 = mysqli_query($conn, "DELETE   FROM blockedchats  WHERE  (userid = ($sen)  AND blockedid = ($use)) ");
            $isblocked = false;
          }
          if (isset($_POST['block'])) {

            // echo $sender . " " . $user_id;

            $sqliblockedchats = mysqli_query($conn, "INSERT INTO blockedchats VALUES ( NULL , ($sen),($use) )");
            // if (!true) {
            //   echo "not";
            // } else {
            //   echo "done";
            // }
            $isblocked = true;
          }
          ?>

          <!-- four -->

          <div >
            <div >
              <form action="" method="POST" style="margin: 0 0 0 10px;">
                <?php
                if ($isblocked) {
                  echo '
                  <div class="mobile" style="width:auto !important">
            
          
                  
                  <input class="mobilebtn"  style="background-color: rgb(166,225,202);" type="submit"  name="unblock" value="unblock"> </div> ';
                              // $check = false;
                } else {
                  echo '
                  <div class="mobile" style="width:auto !important">
            
          
                  
                  <input  class="mobilebtn" style="background-color: rgb(192,119,240);" type="submit"  name="block" value="block"> </div> ';
                  // $check = true;
                }
                // echo $isblocked;

                ?>

            </div>
          </div>
        </div>


        </form>
      </header>



      <div class="chat-box  smallchat">

      </div>

<!-- typebox -->

      <form action="#" class="typing-area">


        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <?php
        if (!$isblocked and $canchat) {
          echo '
        <input id="question" type="text" name="message" class="input-field" placeholder="type here (100 char)" autocomplete="off" required>
        <button>
        <svg style="max-width :45px; height : 45px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="400px" height="400px" viewBox="0 0 400 400" enable-background="new 0 0 400 400" xml:space="preserve">
<circle fill="#020202" cx="200.013" cy="199.987" r="199.991"/>
<path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M199.676,64.182v90.904c-11.751-7.834-25.891-12.372-41.081-12.372
	c-41.081,0-74.376,33.295-74.376,74.376c0,13.28,3.487,25.747,9.602,36.495L64.204,311.48l57.896-29.617
	c10.748,6.115,23.215,9.602,36.495,9.602c41.081,0,74.376-33.295,74.376-74.376V64.182H199.676z M178.514,253.012l-2.484,1.242
	c-5.303,2.532-11.226,3.917-17.436,3.917c-11.321,0-21.639-4.586-29.043-12.038c-7.452-7.452-12.037-17.674-12.037-29.043
	c0-6.21,1.385-12.133,3.869-17.388l1.624-3.2c7.165-12.277,20.397-20.493,35.588-20.493c22.69,0,41.081,18.391,41.081,41.081
	C199.676,232.566,191.125,246.037,178.514,253.012z"/>
<path fill="#7F7F7F" d="M324.792,255.601c0,10.455,0,20.713,0,31.259c-0.736,0.09-1.438,0.251-2.141,0.251
	c-9.188,0.001-18.38,0.192-27.562-0.125c-4.683-0.162-9.389-0.944-14.007-1.976c-8.332-1.861-18.43-11.636-18.786-26.33
	c-0.184-7.598-0.791-15.188-0.811-22.783c-0.089-35.2-0.039-70.4-0.039-105.6c0-1.209,0-2.418,0-3.955c-3.577,0-6.928,0-10.44,0
	c0-10.362,0-20.394,0-30.804c3.376,0,6.723,0,10.314,0c0-10.605,0-20.843,0-31.356c16.232,0,32.215,0,48.474,0
	c0,10.321,0,20.566,0,31.143c4.441,0,8.616,0,12.95,0c0,10.456,0,20.575,0,30.978c-4.28,0-8.467,0-12.945,0c0,1.491,0,2.701,0,3.912
	c0,34.789-0.027,69.577,0.031,104.365c0.008,4.819,0.326,9.65,0.696,14.452c0.34,4.415,1.184,5.322,4.865,5.746
	C318.43,255.129,321.48,255.318,324.792,255.601z"/>
</svg>

        </button>






      </form>';
        } else {
          echo "ONE OF YOU BLOCKED THE OTHER. SORT IT OUT WHATEVER IT IS!!";
        }
        ?>
    </section>
  </div>



</body>
<script>
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!--<script src="javascript/liveuser.js"></script>-->
<script src="javascript/dtalklive.js"></script>

</html>