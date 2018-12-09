<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */

include '../_eclassroom_Controller/config.php';

if (!isset($_SESSION['lecturer'])) {
    header('location:../');
}

if (isset($_GET['url']) && $_GET['url'] == "logout") {
    unset($_SESSION['lecturer']);
    header('location:../');
}

$page = 'lecturer';
$nav = 'assignment';

require ('../header.php');
?>

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

            <?php
            foreach ($phpEasy->change($_SESSION['lecturer']) as $value) {
                print strtoupper($value['title']) . '. ' . ucfirst($value['full_name']);
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
                            <a href="#" class="list-group-item disabled b"> Quick Links </a>
                      
                             <a href="lecturers_class.php" class="list-group-item">Home</a>
          <a href="add_lectures.php" class="list-group-item">Post Assignment</a>
          <a href="view_lectures.php" class="list-group-item">View Assignment</a>

                        </div>

                    </div>
                    <div class="col-md-7 txt">

                        <?php

                        $getID = $_GET['id'];

                        $query = phpEasy::$db_connect -> prepare("SELECT * FROM assignment WHERE id = ?");
                        $query -> execute(array($getID));

                        if ($query -> rowCount() > 0) {

                            while ($fetch = $query -> fetch()) {

                                print '
                                                 <h3> <i class="fa fa-lightbulb-o"></i>&nbsp;' . $fetch['topic'] . ' </h3>
                                                
                                            <small style="color:#666666;"><b>by ' . $phpEasy -> get_name($fetch['lecturer']) . '</b> on ' . $fetch['datetime'] . '</small>
                             
                                     <hr/>';

                                /**
                                 *  Display Description Content.
                                 */
                                print '<div>
                                         <b style="margin:0px;padding:0px;color: #1abc9c;display: block"></b>
                                        
                                                    <p> <b>Assignment Question </b> <br/>
                                                        ' . $fetch['question'] . '
                                                    </p>';

                                $qt = phpEasy::$db_connect -> prepare("SELECT * FROM assignment_answer WHERE assignID = ? ORDER BY id DESC");
                                $qt -> execute(array($getID));

                                if ($qt -> rowCount() > 0) {

                                    print '
                                                 <h6>Assignment Submission </h6>
                                                 <hr/>';

                                    while ($fetch = $qt -> fetch()) {

                                        if ($fetch['answer'] == '' || empty($fetch['answer'])) {

                                        } else {
                                            print '<div style="border-bottom:1px dashed #cccccc">';

                                            print '<small style="color:#666666;"><b>By <i class="fa fa-user"></i> ' . $phpEasy -> getName($fetch['matric_no']) . '
                                                            (' . $fetch['matric_no'] . ' )</b> on
                                                        ' . $fetch['datetime'] . '</small> <br/>' . $fetch['answer'] . '
                                                      <br/>
                                                       
                                                       <div style="margin-left: 30px;">
                                                         
                                                         ';
                                                          
                                            print '</div>
                                                 
                                              </div>';

                                        }
                                    }
                                } else {

                                    echo '<br/>No student submission <hr/>';
                                }

                                print '</div>';

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