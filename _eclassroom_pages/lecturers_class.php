<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */
 
 include '../_eclassroom_Controller/config.php';

if(!isset($_SESSION['lecturer']))
{
    header('location:../');
}

if(isset($_GET['url']) && $_GET['url']=="logout")
{
    unset($_SESSION['lecturer']);
    header('location:../');
}

 $page = 'lecturer';
 $nav = 'class';
 
  require('../header.php');
?>


<section class="thumbnail0">
    
    <div class="welcome-board1 text-center txt color-white container">
        <h3> Departmental Portal  </h3>
    </div>
</section>

     <div class="container">
  
     <div style="height: 50px;">
         &nbsp;
     </div>
         <div >
    <hr/>
             <div > <b> <img src="../_eclassroom_images/online_mini.gif" border="0"/> Logged in as :
                   
             <?php
               foreach($phpEasy->change($_SESSION['lecturer']) as $value)
               {
                   print strtoupper($value['title']).'. '.ucfirst($value['full_name']);
               }

               ?> 
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
          <a href="#" class="list-group-item">Home</a>
          <a href="add_lectures.php" class="list-group-item">Add Lectures</a>
          <a href="view_lectures.php" class="list-group-item">View Lectures</a>
        
        </div>
                          
                     </div>
                     <div class="col-md-7 txt">

                         <h3> Welcome Message </h3>
                        <p style="color:#666666">
                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                         </p>
                     </div>

                     <div class="clearfix"></div>

                 </div>
             </div>
         </div>

     </div>

       <br/>  <br/>  <br/>

 </div>

<?php
 require('../footer.php');
?>
</body>

</html>