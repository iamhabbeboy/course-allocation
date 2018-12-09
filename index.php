<?php session_start();
ob_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */
$page = 'pages';
include './_eclassroom_Controller/config.php';
?>

<?php
$page = 'pages';
$nav = 'home';
require 'header.php';
?>

<script>
    window.onload = function() {
        init()
    }

      function regAccount() {

        var sur = document.querySelector('#surname'),
            other = document.querySelector('#other'),
            mat = document.querySelector('.matricno'),
            pwd = document.querySelector('#reg_pwd')

            if(sur.value == '') {
                sur.focus()
                return false
            } else if(other.value == '') {
                other.focus()
                return false
            } else if(mat.value =='') {
                mat.focus()
                return false
            } else if(pwd.value =='') {
                pwd.focus()
                return false
            }

  }
</script>
<section class="thumbnail1">

    <div class="welcome-board color-white text-center container">
        <h3> E-classroom  </h3>
    </div>
</section>

     <div class="container">

        <div class="row">
         <div class="col-md-6 txt">

             <h3> Welcome to E-classroom </h3>

             <p >
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
             </p>

             <strong class="text-center"><a href="<?=HOST?>_eclassroom_pages/lecturers.php" target="_blank"> Click here to Lecturer's Portal </a> </strong>
             <hr />


         </div>

         <div class="col-md-5">
           <br/>
             <b>STUDENT PORTAL</b>

                  <p class="error_login">

                        <?php

                        if (isset($_POST['sub'])) {
                            $matric_no = $_REQUEST['matricno'];
                            $pwd = $_REQUEST['pwd'];

                            if (!empty($matric_no) && !empty($pwd)) {
                                $query = phpEasy::$db_connect->prepare("SELECT * FROM student WHERE matric_no=? AND pwd=?");
                                $query->execute(array($matric_no, $pwd));

                                if ($query->rowCount() > 0) {
                                    $_SESSION['student'] = $matric_no;

                                    header('location:_eclassroom_pages/student_logged.php');
                                } else {
                                    print "<font color='red'><strong style='padding: 3px 8px;border-radius: 15px;border:1px solid red'><i class='fa fa-times'></i></strong> &nbsp;invalid details</font>";
                                }
                            }
                        }

                        if (isset($_POST['subt'])) {
                            $phpEasy->register(array('surname', 'other', 'matricno', 'reg_pwd', 'photo'));
                        }
                        ?>
                  </p>
                  <!-- // STUDENT LOGIN -->
                  <div class="form-group" id="table_login">
                  <form action="" method="POST">

                             <label> Matric no</label>

                              <input type="text" name="matricno" id="matricno" class="form-control"/>

                              <label >Password</label>

                              <input type="password" name="pwd" id="pwd" class="form-control"/>

                              <input type="submit" name="sub" id="sub_log" value="Login" class="btn btn-primary btn-sm" style="width: 100%;margin-top: 6px;"/>
                              <br/>
                              <center><a href="#" style="color:#666;"><small>forgot password ?</small></a>&nbsp;
                                  |&nbsp;<a href="#" style="color: #666" class="reg_click"><small>register</small></center>

                    </form>
                    </div>

                    <!-- Form 2-->

                    <!---// REGISTER STUDENT HERE -->
                     <div id="table_reg" style="display:none;" class="form-group">
                     <form action="" method="post" enctype="multipart/form-data">
                          <label>
                              Photo
                          </label>
                          <input type="file" name="photo" id="photo" />
                              <label> Surname</label>

                              <input type="text" name="surname" id="surname" class="form-control"/>

                              <label>Othernames</label>

                              <input type="text" name="other" id="other" class="form-control"/>

                              <label>Matric No</label>

                              <input type="text" name="matricno" class="matricno form-control"/>

                              <label>Password</label>

                              <input type="password" name="reg_pwd" id="reg_pwd" class="form-control"/>

                            <input type="submit" name="subt" id="sub_reg" value="Register" class="btn btn-primary btn-sm subReg" style="width: 100%;margin-top: 6px;" onclick=" return regAccount()" />
                              <br/>
                              <center><a href="#" style="color:#666;"><small>forgot password ?</small></a>&nbsp;
                                  |&nbsp;<a href="#" style="color: #666" class="log_click"><small>Login</small> </a> </center>
                       </form>


                  </div>


         </div>
          <div class="clearfix"></div>
          </div>
     </div>

<?php
require "footer.php";
?>
</body>

</html>
