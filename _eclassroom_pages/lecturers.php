<?php session_start();
  ob_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */
 $page = 'pages';
 $nav = 'home';
 
 require('../_eclassroom_Controller/config.php');
 require('../header.php');
 
?>

<script>
    window.onload = function() {
        lect()
    }
</script>
<section class="thumbnail1">
    
    <div class="welcome-board color-white text-center container">
        <h3>Departmental Portal  </h3>
    </div>
</section>

     <div class="container">

        <div class="row">
         <div class="col-md-6 txt">

             <h3> welcome to Departmental Portal </h3>

             <p >
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
             </p>
             <hr />
             

         </div>

         <div class="col-md-5">
           <br/>
             <b>LECTURER'S PORTAL</b>

                  <p class="error_login">

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
                                      print "<font color='red'><strong style='padding: 3px 8px;border-radius: 15px;border:1px solid red'><i class='fa fa-times'></i></strong> &nbsp;invalid details</font>";
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
                  <!-- // STUDENT LOGIN -->
                  <div class="form-group lecturer_login" id="table_login">
                   <form action="" method="POST">
                  
                             <label> Username</label>
                         
                              <input type="text" name="username" id="username" class="form-control"/>
                         
                             <label> Password</label>
                         
                              <input type="password" name="pwd" id="pwd" class="form-control"/>
                         
                                <input type="submit" name="sub" id="sub_login" value="Login" class="btn btn-primary btn-sm" style="width: 100%;margin-top: 6px;"/>
                              <br/>
                              <center><a href="#" style="color:#666;"><small>forgot password ?</small></a>&nbsp;
                                  |&nbsp;<a href="#" style="color: #666" class="click_reg1"><small>register</small></a></center>
                        
                      </form>
                    </div>

                    <!-- Form 2-->
                    
                    <!---// REGISTER STUDENT HERE -->
                     <div id="table_reg" style="display:none;" class="form-group">
                     <form action="" method="POST">
                 
                              <label> Title </label>
                         
                              <select name="lec_title" id="lec_title" class="form-control">
                                  <option value="0">==>title</option>
                                  <option value="MR">MR</option>
                                  <option value="MRS">MRS</option>
                                  <option value="MISS">MISS</option>
                              </select>
                         
                              <label> Full Name</label>
                         
                              <input type="text" name="fname" id="fname" class="form-control"/>
                              
                              <label> Username</label>
                         
                              <input type="text" name="reg_username" id="reg_username" class="form-control"/>
                        
                              <label> Password</label>
                          
                              <input type="password" name="reg_pwd" id="reg_pwd" class="form-control"/>
                          
                              <input type="submit" name="subt" id="sub_register" value="Register" class="btn btn-primary btn-sm" style="margin-top: 6px;"/> &nbsp; <button class="btn btn-default" style="margin-top: 6px;"> Reset</button>
                              <br/>
                              <center>
                                  |&nbsp;<a href="#" style="color: #666" class="click_log"><small>login</small></a></center>
                        
                      </form>
                  </div>
                      
              
         </div>
          <div class="clearfix"></div>
          </div>
     </div>

<?php
  require "../footer.php";
?>
</body>

</html>