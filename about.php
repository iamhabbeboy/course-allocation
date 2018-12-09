<?php session_start();
ob_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */
$page = 'pages';
include './_eclassroom_Controller/config.php';
?>

<?php
$page = 'pages';
$nav = 'about';
require 'header.php';
?>

<script>
    window.onload = function() {
        init()
    }

      function regAccount() {

        var sur = document.querySelector('#surname'),
            other = document.querySelector('#other'),
            mat = document.querySelector('.matricno'),
            pwd = document.querySelector('#reg_pwd')

            if(sur.value == '') {
                sur.focus()
                return false
            } else if(other.value == '') {
                other.focus()
                return false
            } else if(mat.value =='') {
                mat.focus()
                return false
            } else if(pwd.value =='') {
                pwd.focus()
                return false
            }

  }
</script>
<section class="thumbnail1">

    <div class="welcome-board color-white text-center container">
        <h3> E-classroom </h3>
    </div>
</section>

     <div class="container">

        <div class="row">
         <div class="col-md-6 txt">

             <h3> About Project </h3>

             <p >
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
             </p>



         </div>

         <div class="col-md-5">
            <br/><br/>
              <h1 class="text-center color-grey" style="font-size: 5.3em;padding: 50px 20px;border-radius: 100px;border: 3px solid grey;width: 200px;margin:auto;"> <i class="fa  fa-graduation-cap"></i></h1>
         </div>
          <div class="clearfix"></div>
          <br/><br/>

          </div>
     </div>

<?php
require "footer.php";
?>
</body>

</html>