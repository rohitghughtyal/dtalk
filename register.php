<?php
session_start();
include_once "maintop.php";
if(isset($_SESSION['unique_id']) ){
  header("location: php/logout.php");
}
                session_unset();
                session_destroy();

?>
<style>
  

  .hide {
    display: none;
  }

  .show {
    display: block;
    width: 100%;
  }

  @media screen and (max-width: 950px) {
    .example {
      display: none !important;
    }



  }
</style>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

    <img class="example" src="signUpPage.svg" style=" min-width: 600px; height: auto; margin: 0 -250px 202px 0  " alt="My Happy SVG" />


  <div class="wrapper" style="min-height: 600px; border-radius: 0 60px 60px 60px ">

    <section class="form signup">

      <header>
          <svg style="  float: left;  width: 60px; height: auto; margin: 0 15px 0 0  ;"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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

           <!--<img id="logo" xlink:href="https://drive.google.com/file/d/1bZOIhjUuc9Zbc-88lqRYRSIdZrTQYrei/view?usp=sharing" style="  float: left;  width: 60px; height: auto; margin: 0 15px 0 0  " alt="SVG" />-->
        dtalk <div style="font-weight: 200;"> for dtuites </div>
      </header>
      
        <div  style="display: none; margin-left:auto; margin-right:auto;" id ="third" class="spinner-grow" role="status">
  
</div>



      <form action="register.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div id="mainform">

          <div class="field input">
            <label>Full Name</label>
            <input style="border-radius: 100px;  " type="text" name="fname" placeholder="Full name" onkeypress="isInputName(event)" required>
          </div>
          <!-- <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div> -->

          <div  class="field input">
            <label>Year</label>
            <select style="border-radius: 100px; border-color:white;  font-size:15px; background: transparent" name="year" id="rollno" required>
              <optgroup label="Roll No">
        
                <option>2K20</option>
                <option>2K19</option>
                <option>2K18</option>
                <option>2K17</option>
                <option>2K16</option>

              </optgroup>
            </select>
            <label>Department</label>

            <select style="border-radius: 100px; border-color:white; font-size:15px; background: transparent" name="department" id="department" required>
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




          </div>


          <div class="field input">
            <label  >DTU Email Address</label>
            <input type="text" name="email" style="font-weight: 200; border-radius: 100px" placeholder="dtu emails only" required>
          </div>
          <div class="field input">
            <label>Password</label>
            <input type="password" style="border-radius: 100px;" name="password" placeholder="set a password" onkeypress="isInputPassword(event)"  required>
            <i class="fas fa-eye"></i>
          </div>
          <div class="field image">
            <label>Profile Image</label>
            <input type="file" name="image" accept="image/png,image/gif,image/jpeg,image/jpg" required>
            <div style="font-weight: 200;">
              choose a image under 200 kb</div>
          </div>

          <div id="toggle"  class="btn-grad field button">
            <input id ="btns" type="submit" style="background: transparent; margin: 0 0 0px 0; font-weight:300;" name="signup"  value="Sign Up">
          </div>
                    <div class="link">Got OTP ? <a href="enterotp.php">  Verify Here </a></div>

          <div class="link">Already signed up? <a href="index.php">Login now</a></div>
    </section>




    </form>
  </div>
  </div>
  <!-- <div class="field button"> -->




  <!-- </div>-->




  </div>


  <!-- <script src="javascript/pass-show-hide.js"></script> -->
  <script src="javascript/register.js"></script>
  <script>
    function isInputName(evt) {

      var ch = String.fromCharCode(evt.which);

      if (!((/[A-Z]/.test(ch)) || (/[a-z]/.test(ch)) || (/[ ]/.test(ch)))) {
        evt.preventDefault();
      }

    }

    function isInputPassword(evt) {

var ch = String.fromCharCode(evt.which);

if ((/[ ]/.test(ch))) {
    evt.preventDefault();
}

}

    // function onButtonClick() {
    //   document.getElementById('textInput').className = "show";
    //   document.getElementById('verifybutton').className = "show";
    //   document.getElementById('otpbutton').className = "hide";
    //   document.getElementById('mainform').className = "hide";

    // }
  </script>
  
   <script>
    const targetDiv = document.getElementById("third");
    const btn = document.getElementById("toggle");
    btn.onclick = function() {
    //   console.log("clicked");
    //   setTimeout(function() {
    //     console.log("in off");
    //     // document.getElementById("toggle").disabled = true;
    //   }, 2000);
      if (targetDiv.style.display === "none") {
        targetDiv.style.display = "block";





        setTimeout(function() {
          targetDiv.style.display = "none";
          //  document.getElementById("toggle").disabled = false;
        }, 10000);
        //  setTimeout(function(){
        //   // document.getElementById("toggle").disabled = false;
        //  },3000);

      }


    };
  
    
  </script>
  


</body>

</html>