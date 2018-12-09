<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */

if (!isset($_SESSION['student'])) {
    header('location:../');
}

if (isset($_GET['url']) && $_GET['url'] == "logout") {
    unset($_SESSION['student']);
    header('location:../');
}
$page = 'student';
$nav = 'lectures';
require '../header.php';
?>


<section class="thumbnail0">

    <div class="welcome-board1 text-center txt color-white container">
        <h3> E-Classroom  </h3>
    </div>
</section>

     <div class="container">

     <div style="height: 50px;">
         &nbsp;
     </div>
         <div >
    <hr/>
             <div > <b> <img src="../_eclassroom_images/online_mini.gif" border="0" /> Logged in as : <?=$_SESSION['student']?>
                              </b>
             </div>
             <hr/>

             <div>


                 <div style="margin-top:10px;">



                 <div class="row">
                     <div class="col-md-3">

                          <div class="list-group">
          <a href="#" class="list-group-item disabled b">
            Quick Links
          </a>
          <a href="lecturers_class.php" class="list-group-item">Home</a>
          <a href="student_view_lectures.php" class="list-group-item">View Lectures</a>

        </div>

                            <br/><br/>

                     </div>
                     <div class="col-md-7 txt">

                         <h3> Welcome Message </h3>
                        <p style="color:#666666">
                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                         </p>
                     </div>

                     <div class="clearfix"></div>
    <br/><br/><br/>
                 </div>
             </div>
         </div>

     </div>



 </div>

<?php
require '../footer.php';
?>
</body>

</html>