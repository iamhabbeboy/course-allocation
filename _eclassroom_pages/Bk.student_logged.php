<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */

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
       
    <link rel="stylesheet" href="_eclassroom_stylesheet/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="_eclassroom_stylesheet/css/flat-ui.min.css" />
    <link rel="stylesheet" href="_eclassroom_stylesheet/css/font-awesome.min.css" />
    <link rel="stylesheet" href="_eclassroom_stylesheet/_eclassroom_styles.css" />
    <link rel="stylesheet" href="_eclassroom_stylesheet/css/color.css" />
    <link rel="stylesheet" href="_eclassroom_stylesheet/css/utility.css" />
    <script type="text/javascript" src="_eclassroom_js/jquery.js"></script>
    <!--<script src="_eclassroom_js/js.js"></script> -->
    <script src="_eclassroom_js/app.js"></script>
    <script src="_eclassroom_js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="_eclassroom_js/jquery.min_ajax.js" type="text/javascript"></script>
    <script src="_eclassroom_js/slides.min.jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="_eclassrooom_stylesheet/global.css"/>
    </head>

<body>

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
                      <a href="../"> <b>home</b></a>
                  </li>|

                  <li>

                      <a href="student_class.php"> class</a>

                  </li>|

                  <li>
                      <a href="#">assignment</a>
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

                         <strong style="color:#cccccc"><b>lecturer online &nbsp; <img src="../_eclassroom_images/online_mini.gif" border="0"/></b></strong>

                            <br/><br/>
                            <h3 style="color: #dedede">No Lecturer Online </h3>

                     </div>
                     <div style="width:500px;float:left;margin-left:20px;">

                         <h3 style="color:#e40087;"> Welcome Message </h3>
                        <p style="color:#666666">
                         this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login area
                            this is the lecturer login areathis is the lecturer login areathis is the lecturer login area
                         </p>
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