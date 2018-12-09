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
 $nav = 'assignment';
 
  require('../header.php');
?>


<section class="thumbnail0">
    
    <div class="welcome-board1 text-center txt color-white container">
        <h3> Departmental Portal </h3>
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
          <a href="lecturers_class.php" class="list-group-item">Home</a>
          <a href="add_assignment.php" class="list-group-item">Post Assignment</a>
          <a href="lecturerAssignment.php" class="list-group-item">View Assignment</a>
        
        </div>
                          
                     </div>
                     <div class="col-md-7 txt">

                         <h3> <i class="fa fa-lightbulb-o"></i>&nbsp;Assignment Posted </h3>
                        <h6> (<?=$phpEasy->getrows('assignment',$_SESSION['lecturer'])?>) assignment posted </h6>
                           <div class="form-group">

                                    <div >
                             
                             <hr/>
                           <?php
                        

                                $query = phpEasy::$db_connect->prepare("SELECT * FROM assignment WHERE lecturer=? ");
                                $query->execute(array($_SESSION['lecturer']));

                                 if($query->rowCount() > 0)
                                 {
                                     while($fetch = $query->fetch())
                                     {
                                         
                                  print '<div style="color:#111;border-bottom:1px dashed #ccc;padding:8px;"> <b style="margin:0px;
                        padding:0px;color: #1abc9c;display: block">'. $fetch['topic'] .'</b>';
                                
                                
                    print '<small>course:'. $fetch['course'] . '</small> &nbsp;  &nbsp;<a href="s_student_view_ass.php?id=' . $fetch['id'] . '" style="color:#111;text-decoration: underline;" class="view" id="'. $fetch['id'] . '">view</a>&nbsp;&nbsp;
                    
                    <span style="color:#111" class="qtn" id="'. $fetch['id']. '">submission</span>';
                    
                 print '<span class="qtnTimes'. $fetch['id']. '"> 
                      <b>( '. $phpEasy->assignment($fetch['id']) .' )</b></span> <br/>
                      <small> posted on '. $fetch['datetime']. '</small>
                      &nbsp;&nbsp; '; 
                      
                      
                    
                      echo '</div>';
                      
                      }} else {
                          
                          print '<b> No Lecture Posted </b>';
                      }
                      ?>

                         </div>
                         </div>
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