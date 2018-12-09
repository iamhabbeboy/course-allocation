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
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Designed by h4663601.
Year 2014
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
     <title>Welcome to E Classroom </title>
    <meta name="keyword" content=""/>
    <meta name="description" content=""/>
        <link rel="stylesheet" href="../_eclassroom_stylesheet/_eclassroom_styles.css" />

        <script src="../_eclassroom_js/js.js"></script>
    <style>

       input[type=text],textarea {

           padding:5px;
           border:1px solid #cccccc;
           font-family:arial,helvetica;
           width:400px;
       }

    </style>
    </head>

<body onload="lectClass()">

 <div id="eclassroom-wrapper">

     <div class="eclassroom-header">

         <div class="wrap-it-up">
         <div class="title">
            <h1><font size="+4">E</font>-classroom &nbsp;<strong>...learn and study online</strong></h1>
             </div>

         <div class="nav">
            <div class="in-nav">
              <ul >

                  <li>
                      <a href="lecturers_logged.php">home</a>
                  </li>|

                  <li>

                      <a href="#"> <b>Lectures</b></a>

                  </li>|

                  <li>
                      <a href="lecturers_assignment.php">assignment</a>
                  </li>|


                  <li>
                      <a href="?url=logout">logout</a>
                  </li>|

              </ul>
                </div>
         </div>
         <br style="clear:both;" />
             </div>
     </div>



     <div class="eclassroom-content">

         <div >

             <div style="font:12px arial,sans-serif;color:#e40087;font-weight:bold;"> Logged in as :
                 <?php
                 foreach($phpEasy->change($_SESSION['lecturer']) as $value)
                 {
                     print strtolower($value['title']).'. '.strtolower($value['full_name']);
                 }

                 ?> &nbsp;<b style="color: green;"></b>

             </div>
             <hr/>

             <div>


                 <div style="margin-top:10px;">




                     <div style="float:left;width:200px;">

                         <strong style="color:#cccccc"><b>student online &nbsp; <img src="../_eclassroom_images/online_mini.gif" border="0"/></b></strong>

                            <br/><br/>
                            <h3 style="color: #dedede">No Student Online </h3>

                     </div>
                     <div style="width:500px;float:left;margin-left:20px;">
                            <br/>


                         <h3 style="color:#e40087;"> Add Lectures </h3>

                        <br/>
                           <p style="color:#666666">

                                <form action="" method="POST" enctype="multipart/form-data">
                             <table border="0" cellpadding="5px" width="400px">

                                <tr>

                                    <td>

                                        <label style="color:#cccccc">course</label>
                                    </td>
                                    <td>
                                        <input type="text" name="course" id="course"/>
                                    </td>
                                </tr>
                               <tr>

                                   <td> <label style="color: #cccccc">topic</label></td>
                                   <td> <input type="text" name="topic" id="topic"/></td>
                               </tr>

                             <tr>
                                 <td><label style="color:#cccccc">description</label></td>
                                 <td> <textarea name="description" id="description"></textarea></td>
                             </tr>

                             <tr>
                                 <td><label style="color:#cccccc">handout<br/>(optional)</label></td>
                                 <td>
                                     <input type="file" id="handout" name="handout"/>
                                 </td>
                             </tr>

                             <tr>
                                 <td colspan="2">

                                     <center><input type="submit" name="sub" id="sub" value="post topic"
                                               style="width:300px;"/> </center>
                                 </td>
                             </tr>
                             </table>

                             <?php

                                 if(isset($_POST['sub']))
                                 {
                                     $course = $_POST['course'];
                                     $topic = $_POST['topic'];
                                     $description = $_POST['description'];
                                     $handout = $_FILES['handout']['name'];
                                     $file = $_FILES['handout']['tmp_name'];
                                     $valid_format = array('.pdf','.doc','.docx','.txt','');
                                      $format = strrchr($handout, ".");
                                        $dir = (empty($file) ? '' : "handout/".rand(0,time()).$format);
                                     $lecturer = $_SESSION['lecturer'];
                                     $dat = date('d-m-y h:i a');
                                      if(!in_array($format, $valid_format))
                                      {
                                          print "<font color='red'>format not supported !</font>";

                                      }
                                     else if(!empty($course))
                                     {
                                         move_uploaded_file($file,$dir);
                       $query = phpEasy::$db_connect->prepare("SELECT * FROM lectures WHERE course=? AND topic=? AND description=? AND lecturer=?");
                                       $query->execute(array($course, $topic, $description, $lecturer));

                                          if($query->rowCount() > 0)
                                          {
                                              print "<font color='red'>Lecture Already Taught</font>";
                                          }
                                         else{

                                  $qty = phpEasy::$db_connect->prepare("INSERT INTO lectures(course, topic, description, handout, lecturer,datetime) VALUES(?,?,?,?,?,?)");
                              $qty->execute(array($course, $topic, $description, $dir, $lecturer, $dat));

                                             print "<font color='green'>Lecture posted successfully !</font>";
                                         }
                                     }
                                     else{
                                         print "<strong style='color:red'>field must not be empty!</strong>";
                                     }

                                 }

                             ?>
                             </form>
                         </p>


                         <br/>

                         <div >
                              <h2 style="color:#ccc">Lectures (<?=$phpEasy->getrows('lectures',$_SESSION['lecturer'])?>)</h2>
                             <hr/>
                             <?php

                                $query = phpEasy::$db_connect->prepare("SELECT * FROM lectures WHERE lecturer=? ORDER BY id DESC");
                                $query->execute(array($_SESSION['lecturer']));

                                 if($query->rowCount() > 0)
                                 {
                                     while($fetch = $query->fetch())
                                     {
                                      

                        echo '<div style="color:#cccccc;border-bottom:1px dashed #e40087;padding:8px;"> <h3
                                style="margin:0px;
                        padding:0px;color:#e40087;">'. $fetch['topic'] .'</h3>
                                             <small>course:
                                                 '. $fetch['course']. '</small> &nbsp; | &nbsp;<small> on '. $fetch['datetime']. '</small> ';
                      
                      
                     $qt = phpEasy::$db_connect->prepare("SELECT * FROM student_question WHERE lectID=?");
                       $qt->execute(array($fetch['id']));

                                      if($qt->rowCount() > 0)
                                      {
                                          print "<h4 style='color:#cccccc;'>&raquo; Question Asked by Student</h4>";
                                        while($ft = $qt->fetch())
                                        {
                                            
                                            print '<div style="border-bottom:1px dashed #cccccc">
                                                <small style="color:#666666;"><b>submited by '. $phpEasy->getName($ft['matric_no']).' ('. $ft['matric_no']. ')</b> on
                                                    '. $ft['datetime'] .'</small>
                                                <p style="color:#cccccc">
                                                    '. $ft['question'] .' 
                                                </p>
                                            </div>';
                             
                                        }
                                      }
                                         else
                                         {

                                         }
                             
                                print '<br/><br/>
                                    </div>';
                            
                                     }
                                 }
                             ?>

                         </div>
                     </div>

                     <br style="clear:both;" />

                 </div>
             </div>
         </div>

     </div>

     <div class="eclassroom-footer">
            <small>E-classroom &copy; 2014.</small>
     </div>

 </div>

</body>

</html>