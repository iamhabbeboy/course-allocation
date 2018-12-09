<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */

include '../_eclassroom_Controller/config.php';

if (!isset($_SESSION['student'])) {
    header('location:../');
}

if (isset($_GET['url']) && $_GET['url'] == "logout") {
    unset($_SESSION['student']);
    header('location:../');
}

$page = 'student';
$nav = 'lectures';

require ('../header.php');
?>

<script>
    window.onload = function() {
        studentClass()
    }
</script>
<section class="thumbnail0">

    <div class="welcome-board1 text-center txt color-white container">
        <h3> Virtual Classroom System </h3>
    </div>
</section>

<div class="container">

    <div style="height: 50px;">
        &nbsp;
    </div>
    <div >
        <hr/>
        <div >
            <b> <img src="../_eclassroom_images/online_mini.gif" border="0"/> Logged in as :

            <?=$_SESSION['student'] ?>
            </b>
        </div>
        <hr/>

        <div>

            <div style="margin-top:10px;">

                <div class="row">
                    <div class="col-md-3">

                        <div class="list-group">
                            <a href="#" class="list-group-item disabled b"> Quick Links </a>
                            <a href="student_logged.php" class="list-group-item">Home</a>
                            <a href="student_view_lectures.php" class="list-group-item">View Lectures</a>
                   

                        </div>

                    </div>
                    <div class="col-md-7 txt">

                        <?php

                        $getID = $_GET['id'];

                        $query = phpEasy::$db_connect -> prepare("SELECT * FROM lectures WHERE id = ?");
                        $query -> execute(array($getID));

                if ($query -> rowCount() > 0) {

                while ($fetch = $query -> fetch()) {

                    print '<h3> <i class="fa fa-lightbulb-o"></i>&nbsp;' . $fetch['topic'] . ' </h3>
                                                
                      <small style="color:#666666;"><b>by ' . $phpEasy -> get_name($fetch['lecturer']) . '</b> on ' . $fetch['datetime'] . '</small>
                             
                                     <hr/>';

                                /**
                                 *  Display Description Content.
                                 */
        print '<div>
            <b style="margin:0px;padding:0px;color: #1abc9c;display: block"></b>
                                
            <p> 
               ' . $fetch['description'] . '
            </p>' . ((!empty($fetch['handout'])) ? '<a href="'.$fetch['handout'].'" style="color:lightblue;font-weight: bold;"><i class="fa fa-cloud-download"></i>download course materials</a>' : '');
            if($fetch['rating']){
             echo "<p><b>Rating</b><br>".(!empty($fetch['rating']) ? "This topic is rated: ".$fetch['rating'] : "")."</p>";
            }else{

            }

            if($fetch['refree']){

                $exp = explode(',',$fetch['refree']);
             //echo "<p><b>Refrences</b><br>".(!empty($fetch['refree']) ? : "")."</p>";
               foreach ($exp as $key => $value) {
                   # code...
                echo "<a href='".$value."' target='_blank'>".$value."</a>) ";
                // echo "<a href='http://{$value}' target='_blank'>".$value."</a>, &nbsp;";
               }
            }else{

            }

            $qt = phpEasy::$db_connect -> prepare("SELECT * FROM student_question WHERE lectID = ? ORDER BY id DESC");
            $qt -> execute(array($getID ) );

            if ($qt -> rowCount() > 0) {

                  print '
                                                 <h6> Question Recently Asked </h6>
                                                 <hr/>';

                                    while ($fetch = $qt -> fetch()) {

                                         if($fetch['question'] == '' || empty($fetch['question'])) {
                                             
                                         } else {
                                        print '<div style="border-bottom:1px dashed #cccccc">';
                                        
                                         print '<small style="color:#666666;"><b>By <i class="fa fa-user"></i> ' . $phpEasy -> getName($fetch['matric_no']) . '
                                                            (' . $fetch['matric_no'] . ' )</b> on
                                                        ' . $fetch['datetime'] . '</small> asked <br/>'.$fetch['question'] . '
                                                      <br/>
                                         
                                         <div style="margin-left: 20px;">  
                                            <b><a href="#" style="color: #1abc9c" class="reply_show"><i class="fa fa-share" ></i>&nbsp; Reply from lecturer</a></b><br/>';         
                                                
                                                 
                                         $sql100 = phpEasy::$db_connect -> prepare("SELECT * FROM student_reply WHERE qID = ?");
                                            $sql100 -> execute(array($fetch['id']));
                                            if ($sql100 -> rowCount() > 0) {

                                                while ($ft100 = $sql100 -> fetch()) {

                                                    print '<div>
                                                       ' . $ft100['ans'] . ' <br/> on '.$ft100['datetime'].'
                                                     </div><hr/>';
                                                }
                                            } else {

                                                print 'No reply';
                                            }
                                                
                                                  
                                                print '</div></div>';

                                    } }
                                } else {
                                    
                                     echo '<br/>No Question Asked <hr/>';
                                }   

                                print '<Br/><span style="color:#111" class="qtn" id="' . $getID . '">ask question</span>
                     <input type="hidden" id="matric_no" value="'. $_SESSION['student']. '" />               
                                    <textarea  name="question"  class="quest2 form-control" style="resize: none;"></textarea><br/>
                                    
                            <button class="btn btn-primary sub_qtn" id="'. $getID. '" > <b>Submit</b> </button> &nbsp;&nbsp;
                            <button class="btn btn-default"> <b>Cancel</b> </button>
                                                                          
                                                </div>';

                            }
                        } else {

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


<br/>
<br/>
<br/>

</div>

<?php
require ('../footer.php');
?>
</body>

</html>