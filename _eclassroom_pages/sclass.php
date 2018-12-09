<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */

include '../_eclassroom_Controller/config.php';

if(!isset($_SESSION['student']))
{
    header('location:../');
}

if(isset($_GET['url']) && $_GET['url']=="logout")
{
    unset($_SESSION['student']);
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

        <script src="../_eclassroom_js/jquery.js"></script>
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

<body onload="studentClass()">

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
                      <a href="student_logged.php">home</a>
                  </li>|

                  <li>

                      <a href="#"> <b>class</b></a>

                  </li>|

                  <li>
                      <a href="student_assignment.php">assignment</a>
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


             <div style="font:12px arial,sans-serif;color:#e40087;font-weight:bold;"> Logged in as : <?=$_SESSION['student']?> &nbsp;<b style="color: green;"> Message (0)
                 </b>

             </div>
             <hr/>

             <div>


                 <div style="margin-top:10px;">




                     <div style="float:left;width:200px;">

                         <strong style="color:#cccccc"><b>student online &nbsp; <img src="../_eclassroom_images/online_mini.gif" border="0"/></b></strong>


                            <h3 style="color: #dedede">No Student Online </h3>

                     </div>
                     <div style="width:500px;float:left;margin-left:20px;">
                          
                            <br/><br/> 
             <h3 style="color:#e40087;margin:0px;padding:0px;"> Lectures (<?=$phpEasy->getrows1('lectures') ?>)</h3>
                         <hr/>

                             <?php

                             $query = phpEasy::$db_connect->query("SELECT * FROM lectures ORDER BY id DESC");
                             //$query->execute(array($_SESSION['lecturer']));

                             if($query->rowCount() > 0)
                             {
                                 while($fetch = $query->fetch())
                                 {
                                     

                                  echo '<div style="color:#cccccc;border-bottom:1px dashed #e40087;padding:8px;"> <h3 style="margin:0px;
                        padding:0px;color:#e40087;">'. $fetch['topic'] . '</h3>';
                                
                                
                    print '<small>course:'. $fetch['course'] . '</small> &nbsp; | &nbsp;<a href="#" style="color:#dedede" class="view" id="'. $fetch['id'] . '">view lecture</a>&nbsp;|&nbsp;
                    
                    <a href="#" style="color:#dedede" class="qtn" id="'. $fetch['id']. '">ask question</a>';
                    
                 print '<span class="qtnTimes'. $fetch['id']. '"> 
                      <b>('. $phpEasy->qtn($fetch['id']) .' )</b></span>
                      <small> on'. $fetch['datetime']. '</small>
                      &nbsp;|&nbsp; '. ((!empty($fetch['handout'])) ? '<a href="'.$fetch['handout'].'" style="color:lightblue;">download course materials</a>' : ''); 
                                            
                                            
                                            
           print '<div class="view_lecture'.$fetch['id'].'" style="color:#cccccc" id="close">
                                         </div>
                                         <div class="qtn_view'.$fetch['id'].'" style="display:none;">
                                             <br/>

                                             <div style="float:left;">
                                                 <textarea style="width:300px;height:50px;" name="question"  class="quest1'.$fetch['id'].'"></textarea>

                                             </div>
                                             <div style="float:left;">
                                                 <input type="submit" name="sub" class="sub_qtn" id="'. $fetch['id']. '" value="ask question" style="padding:5px;height:60px;"/>
                                             </div>
                                             <div style="clear:both;" >
                                <input type="hidden" id="matric_no" value="'. $_SESSION['student']. '" />
                                <center><a href="#" class="hideme" onclick=document.querySelector(".qtn_view'. $fetch['id'] .'").style
                                                         .display="none" style="color:#ddd">
                                                         <small> hide X</small></a> </center>
                                             </div>
                                     </div>
                                         <div>';
                                             
                          $qt = phpEasy::$db_connect->prepare("SELECT * FROM student_question WHERE lectID=? ORDER BY id DESC");
                          $qt->execute(array($fetch['id']));

                                       if($qt->rowCount() > 0)
                                             {
                                                
                                                 print '<br/>
                                                 <h3 style="color:#red"> Question Asked</h3>
                                                 <hr/>';
                                                 
                                                 while($fetch = $qt->fetch())
                                                       {
                                                     

                                                   print '<div style="border-bottom:1px dashed #cccccc">
                                                    <small style="color:#666666;"><b>by '. $phpEasy->getName
                                                                ($fetch['matric_no']). '
                                                            ('. $fetch['matric_no']. ' )</b> on
                                                        '. $fetch['datetime']. '</small>
                                                    <p>
                                                        '. $fetch['question'].'
                                                    </p>
                                                </div>';
                                             
                                                 }
                                             }
                                             else 
                                             {
                                               
                                             }


                                         print '</div></div>';

                                 }
                             }
                             else
                             {
                                 print "<h3 style=\"color:#e40087\">No Assignment Posted</h3><br/>";
                             }
                             ?>



                     </div>

                     <br style="clear:both;" />

                 </div>
             </div>
         </div>

     </div>
            <br/><br/><br/>
     <div class="eclassroom-footer">
            <small>E-classroom &copy; 2014.</small>
     </div>

 </div>

</body>

</html>