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
  $page = 'lecturer';
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
               foreach($phpEasy->change($_SESSION['lecturer']) as $value)
               {
                   print strtoupper($value['title']).'. '.ucfirst($value['full_name']);
               }

               ?> 
            </b>
        </div>
       <br/>
            
            <table class="table">
                <tr>
                    <th> # </th>
                    <th> Student Name</th>
                    <th> Matric No. </th>
                    <th> Payment Status</th>
                </tr>
                
               <?php
               
                  $sql = $phpEasy -> query('student');
                  
                   if($sql -> rowCount() > 0 ) {
                       
                       while($ft = $sql -> fetch()) {
                           
                       print '<tr>
                            <td> # </td>
                            <td>'.$ft['surname'].' '.$ft['othername'].'</td>
                            <td>'.$ft['matric_no'].'</td>
                            <td>
                              <input type="checkbox" data-toggle="switch" id="custom-switch-04" class="switching"/>
                              </td>
                            </tr>
                          ';
                       }    
                   } else {
                       
                       print 'No Student Record Found !';
                   }
               ?>
            </table>
             
           

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

<script>
    $(function() {
        $('.switching').on('change', function() {
            alert($(this).val())
        })
    })
</script>    

</body>

</html>