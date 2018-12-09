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

<!--<script src="./_eclassroom_js/jquery.form.js"></script>-->

<section class="thumbnail0">
    
    <div class="welcome-board1 text-center txt color-white container">
        <h3> Enhance Courseware Management Application.  </h3>
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
          <a href="#" class="list-group-item">Add Lectures</a>
          <a href="view_lectures.php" class="list-group-item">View Lectures</a>
        
        </div>
                          
                     </div>
                     <div class="col-md-7 txt">

                         <h3> <i class="fa fa-edit"></i>&nbsp;Add Lectures </h3>
                       
                           <div class="form-group">

                                <form action="" method="POST" enctype="multipart/form-data">
                           
                                        <label class="b">course code</label>
                                  
                                        <input type="text" name="course" id="course" class="form-control"/>
                                  
                                   <label class="b">topic</label>
                                  <input type="text" name="topic" id="topic" class="form-control"/>
                               <label class="b">description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                             <label class="b">Handout &nbsp; (optional)</label>
                                
                          <input type="file" id="handout" name="handout" class="form-control"/>

                          <!--<label class="b">Refrence </label>
                          <textarea name="refrence" class="form-control"></textarea>
                          <label class="b">Rating </label>
                          <table class="table b">
                           <tr>
                            <td> 1 </td>
                            <td> 2 </td>
                            <td> 3 </td>
                            <td> 4 </td>
                            <td> 5 </td>
                           </tr>
                           <tr>
                            <td>
                             <input type="radio" name="rating" value="1">
                            </td>
                             <td>
                             <input type="radio" name="rating" value="2">
                            </td>
                             <td>
                             <input type="radio" name="rating" value="3">
                            </td>
                             <td>
                             <input type="radio" name="rating" value="4">
                            </td>
                             <td>
                             <input type="radio" name="rating" value="5">
                            </td>
                           </tr> -->
                          </table>
                         
                         <input type="submit" name="sub" id="sub" value="post topic" style="width:100%;margin-top: 6px;" class="btn btn-primary "/>
                                

        <?php

          if(isset($_POST['sub']))
          {
            $course = $_POST['course'];
            $topic = $_POST['topic'];
            $description = $_POST['description'];
            $handout = $_FILES['handout']['name'];
            $file = $_FILES['handout']['tmp_name'];
            $_file_size = ceil($_FILES['handout']['size']/1024);
            //$refree = $_POST['refrence'];
            //$rating = $_POST['rating'];
            $valid_format = array('.pdf','.doc','.docx','.txt','.mp4','.mpeg', '.avi');
            $format = strrchr($handout, ".");
            $dir = (empty($file) ? '' : "handout/".rand(0,time()).$format);
            $lecturer = $_SESSION['lecturer'];
            $dat = date('d-m-y h:i a');
            //echo $_file_size." sdf";
            if($_file_size > 5024) {
              echo "File size too large";
            }
            elseif($handout !=='' && !in_array($format, $valid_format))
            {
              print "<font color='red'>format not supported !</font>";
            }else if(!empty($handout) )
            {
              move_uploaded_file($file,$dir);
			  
			} else {
              $query = phpEasy::$db_connect->prepare("SELECT * FROM lectures WHERE course=? AND topic=? AND description=? AND lecturer=?");
            $query->execute(array($course, $topic, $description, $lecturer));

            if($query->rowCount() > 0)
            {
              print "<font color='red'>Lecture Already Taught</font>";
            }else{

              $qty = phpEasy::$db_connect->prepare("INSERT INTO lectures(course, topic, description, handout,lecturer,datetime) VALUES(?,?,?,?,?,?)");
                              $qty->execute(array($course, $topic, $description, $dir, $lecturer, $dat));

                                             print "<font color='green'>Lecture posted successfully !</font>";
                                         }
                                     }
                                     /*else{
                                         print "<strong style='color:red'>field must not be empty!</strong>";
                                     }*/

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