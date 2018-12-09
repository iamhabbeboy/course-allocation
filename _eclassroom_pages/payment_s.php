<?php session_start();
  ob_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */

include '../_eclassroom_Controller/config.php';
?>

<?php
  $page = 'student';
  $nav = 'payment';
  require('../header.php');
?>

<script src="<?=HOST?>/_eclassroom_js/flat-ui.min.js"></script>
<script src="<?=HOST?>/_eclassroom_js/application.js"></script>
<script>

    window.onload = function() {
        init()
    }
</script>
<section class="thumbnail1">
    
    <div class="welcome-board color-white text-center container">
        <h3> Virtual Classroom System  </h3>
    </div>
</section>

     <div class="container">

        <div class="row">
         <div class="col-md-6 txt">

             <h3><i class="fa fa-credit-card"></i> NACOSS Payment </h3>

            <hr/>
        <div >
            <b> <img src="../_eclassroom_images/online_mini.gif" border="0"/> Logged in as :

             <?php
               
                $uid = $_SESSION['student'];
               print $uid;
               
              $q = $phpEasy -> query('student', 'matric_no', $uid );
              
              
               ?> 
            </b>
        </div>
       <br/>
            
            <h1> <i class="fa fa-user"></i></h1>
             
             <?php
             
               if($q -> rowCount() > 0 ) {
                   
                   while($ft = $q -> fetch()) {
                   print '<h5>Full Name: '. $ft['surname'].' '.$ft['othername'] .' </h5>
                    <h5>Matric No.:  '. $_SESSION['student'] .'</h5>
                    <h5> Payment Status: <i class="fa fa-check"></i> paid</h5>';
                    
                    
                   }
               } else {
                   
                   
               }
             ?>
           

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
  require "../footer.php";
?>
</body>

</html>