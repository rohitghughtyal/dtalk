<?php
session_start();
include_once "php/connect.php";
if(!isset($_SESSION['unique_id'])){
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


<body>

<style>


@media screen and (max-width: 500px) {

.small{
  min-height: 600px !important;
}

}

</style>

<div class="wrapper small" style="max-width: 800px; min-height: 700px">
    <section class="users">
      <header>
      <!-- <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
      <a href="home.php" class="">
              <img id="logo" src="arrow-left-square.svg" style="float: left ; width: 40px; height: auto; border-radius : 0px " alt="back" />

            </a>
            
      
        <svg style=" max-width :45px; height : 45px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
      

           <div style="font-size: 18px; font-weight: bold" > Find Friends  </div>       
          
        <a href="advancedsearch.php" style=" background-color: rgb(169,137,230); font-weight: 200; font-size: 16px ; color: black" class="logout">Advance Search</a>
       
        

        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="">
        
              <img id="logo" src="logoff.svg" style="width:40px ; border-radius: 0" alt="logOff" />

            </a>
          

      </header>



      <div class="search">
        <span style="font-size: 15px; font-weight:80" class="text">Following Might be your Friends from your department:</span>
        <input id= "findbox" type="text" placeholder="search...">
        <button style="background-color: transparent;"><img src="search.svg" style= " border-radius: 0; width:40px; height:auto" />
      </button>

      </div>
      
       <!-- for user list margin -->
      
      <div style="max-height: 460px ; padding : 0 5px" class="users-list" >
      
      </div>
</div>
  </div>


  </section>
  <!-- <script src="javascript/tryuusers.js"></script> -->

</body>

<script src="javascript/findfriends.js"></script>

</html>