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
          <a href="lecturers_class.php" class="list-group-item">Home</a>
          <a href="add_assignment.php" class="list-group-item">Post Assignment</a>
          <a href="view_lectures.php" class="list-group-item">View Assignment</a>
        
        </div>
                          
                     </div>
                     <div class="col-md-7 txt">

                         <h3> <i class="fa fa-edit"></i>&nbsp;Post Assignment </h3>
                       
                           <div class="form-group">

                                <form action="" method="POST" enctype="multipart/form-data">
                           
                                
                                 <label>course</label>
                                   
                                       <select name="course" id="course" class="form-control">
                                           <option value="0"> ==> select course</option>

                                           <?php
                           $query = phpEasy::$db_connect->prepare("SELECT * FROM lectures WHERE lecturer=? GROUP BY course");
                                           $query->execute(array($_SESSION['lecturer']));

                                            if($query->rowCount() > 0)
                                            {
                                                while($fetch = $query->fetch())
                                                {
                                              
                                                print '<option value="'. $fetch['course']. '">'. strtoupper($fetch['course']). '</option>';
                                               
                                                }
                                            }
                                           else{
                                            
                                           }

                                           ?>
                                       </select>
                                   
                                         <label>topic</label>
                                     
                                         <select name="topic" id="course" class="form-control">
                                             <option value="0"> ==> select topic</option>

                                             <?php
                                             
                                             $query = phpEasy::$db_connect->prepare("SELECT * FROM lectures WHERE lecturer=? GROUP BY topic");
                                             $query->execute(array($_SESSION['lecturer']));

                                             if($query->rowCount() > 0)
                                             {
                                                 while($fetch = $query->fetch())
                                                 {
                                                     
                                                     print '<option
                                                         value="'. $fetch['topic']. '">'. strtoupper($fetch['topic']). '</option>';
                                               
                                                 }
                                             }
                                             else{
                                              
                                             }

                                             ?>
                                         </select>
                                 
                                 <label>question</label>
                                 <textarea name="qtn" id="description" class="form-control"></textarea>
                            

                                     <input type="submit" name="sub" id="sub" value="Post Assignment" style="width:100%;margin-top: 6px;" class="btn btn-primary "/>
                                
                                 <?php

                                 if(isset($_POST['sub']))
                                 {
                                     $course = $_POST['course'];
                                     $topic = $_POST['topic'];
                                     $qtn = $_POST['qtn'];
                                     $lec = $_SESSION['lecturer'];
                                     $da = date('d-m-y h:i a');
                                   if(empty($course) || empty($topic) || empty($qtn))
                                   {
                                       print "<strong style='color:red'>All field must not be empty</strong>";

                                   }
                                     else
                                     {
            $query = phpEasy::$db_connect->prepare("SELECT * FROM assignment WHERE course=? AND topic=? AND question=? AND lecturer=?");
            $query->execute(array($course, $topic, $qtn, $lec));


                              if($query->rowCount() > 0)
                              {
                                  print "<h4 style='color:red'><i class='fa fa-times'></i> Assignment Already Given</h4>";
                              }
                            else
                           {
                 $qtnn = phpEasy::$db_connect->prepare("INSERT INTO assignment(course, topic, question, lecturer, datetime) VALUES(?,?,?,?,?)");
                 $qtnn->execute(array($course, $topic, $qtn, $lec, $da));

                         print "<h4 style='color:lightgreen'><i class='fa fa-check'></i>Assignment Posted Successfully </h4>";
                               
                              //print '<meta http-equiv="refresh;" content="3;url=lecturers_assignment.php" />';
                                
                          }

                                     }
                                 }

                             ?>
                             </form>
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