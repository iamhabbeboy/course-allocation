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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Designed by h4663601.
Year 2014
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
     <title>Welcome to E Classroom | Lecturers</title>
    <meta name="keyword" content=""/>
    <meta name="description" content=""/>
        <link rel="stylesheet" href="../_eclassroom_stylesheet/_eclassroom_styles.css" />

    <script src="../_eclassroom_js/js.js"></script>
    </head>

<body onload="lect()">

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
                      <a href="../">home</a>
                  </li>|

                  <li>

                      <a href="#">about</a>
                      <ul>
                          <li><a href="#">contact </a></li>
                          <li><a href="#">others</a></li>
                      </ul>
                  </li>|

                  <li>
                      <a href="#">students</a>
                  </li>|

                  <li>
                      <a href="#">lecturers</a>
                  </li>
              </ul>
                </div>
         </div>
         <br style="clear:both;" />
             </div>
     </div>


      <div class="slideshow">

         <img src="../_eclassroom_images/Students-2.jpg" border="0" />
      </div>

     <div class="eclassroom-content">

<br/><br/>
              <fieldset style="width: 60%;margin:auto;">
                  <legend style="color: #cccccc"><b>LECTURER LOGIN</b></legend>

                    <p class="error">

                        <?php

                            if(isset($_POST['sub']))
                            {
                                 $user = $_POST['username'];
                                $pwd = $_POST['pwd'];

                           $query = phpEasy::$db_connect->prepare("SELECT * FROM lecturer WHERE username=? AND  pwd=?");
                                $query->execute(array($user, $pwd));

                                 if($query->rowCount() > 0)
                                 {
                                     $_SESSION['lecturer'] = $user;
                                     header('location:lecturers_logged.php');
                                 }
                                else
                                {
                                    print "<font color='red'>Invalid Details </font>";
                                }
                            }

                        if(isset($_POST['subt']))
                        {
                            $title = $_POST['lec_title'];
                            $fname = $_POST['fname'];
                            $user = $_POST['reg_username'];
                            $pwd = $_POST['reg_pwd'];

                         $query = phpEasy::$db_connect->prepare("SELECT * FROM lecturer WHERE full_name=? AND  username=?");
                            $query->execute(array($fname, $user));

                             if($query->rowCount() > 0)
                             {
                                 print "<font color='red'>Account Already Exists</font>";
                             }
                            else{

                              $quer = phpEasy::$db_connect->prepare("INSERT INTO lecturer(title, full_name, username, pwd) VALUES(?,?,?,?)");
                                $quer->execute(array($title, $fname, $user, $pwd));

                                 $_SESSION['lecturer']  = $user;
                                 header('location:lecturers_logged.php');
                            }

                        }
                        ?>
                    </p>

                  <!-- //LECTURER LOGIN -->
                  <form action="" method="POST">
                  <table border="0" width="60%" cellpadding="5px" class="lecturer_login">
                      <tr>
                          <td>
                             <label style="color:#cccccc"> username</label>
                          </td>
                          <td>
                              <input type="text" name="username" id="username" style="border:1px solid #cccccc;
                              width:100%;"/>
                          </td>
                      </tr>
                      <tr>
                          <td>
                             <label style="color:#cccccc;"> password</label>
                          </td>
                          <td>
                              <input type="password" name="pwd" id="pwd" style="border:1px solid #cccccc;
                              width:100%;"/>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" name="sub" id="sub_login" value="login"  style="width:100%;
                              background:#444444;color:#cccccc;border:0px;padding:4px;font:13px arial,
                              helvetica;text-transform:uppercase;font-weight:bold;cursor:pointer"/>
                              <br/>
                              <center><a href="#" style="color:#666;"><small>forgot password ?</small></a>&nbsp;
                                  |&nbsp;<a href="#" style="color: #666"
                                            class="click_reg"><small>register</small></a></center>
                          </td>
                      </tr>
                  </table>
                      </form>


                  <!-- // LECTURER REGISTER -->
                  <form action="" method="POST">
                  <table border="0" width="70%" cellpadding="5px" class="lecturer_reg" style="display:none;">
                      <tr>
                          <td>
                              <label style="color:#cccccc"> Title </label>
                          </td>
                          <td>
                              <select name="lec_title" id="lec_title" style="border:1px solid #cccccc;width:100%;">
                                  <option value="0">==>title</option>
                                  <option value="MR">MR</option>
                                  <option value="MRS">MRS</option>
                                  <option value="MISS">MISS</option>
                              </select>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <label style="color:#cccccc;"> Full Name</label>
                          </td>
                          <td>
                              <input type="text" name="fname" id="fname" style="border:1px solid #cccccc;
                              width:100%;"/>
                          </td>
                      </tr>

                      <tr>
                          <td>
                              <label style="color:#cccccc;"> Username</label>
                          </td>
                          <td>
                              <input type="text" name="reg_username" id="reg_username" style="border:1px solid #cccccc;
                              width:100%;"/>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <label style="color:#cccccc;"> Password</label>
                          </td>
                          <td>
                              <input type="password" name="reg_pwd" id="reg_pwd" style="border:1px solid #cccccc;
                              width:100%;"/>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" name="subt" id="sub_register" value="register"  style="width:100%;
                              background:#444444;color:#cccccc;border:0px;padding:4px;font:13px arial,
                              helvetica;text-transform:uppercase;font-weight:bold;cursor:pointer"/>
                              <br/>
                              <center>
                                  |&nbsp;<a href="#" style="color: #666"
                                            class="click_log"><small>login</small></a></center>
                          </td>
                      </tr>
                  </table>
                      </form>
              </fieldset>
         <Br/><br/>

     </div>

     <div class="eclassroom-footer">
            <small>E-classroom &copy; 2014.</small>
     </div>

 </div>

</body>

</html>