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
$nav = 'assignment';

require '../header.php';
?>

<script>
    window.onload = function() {
        studentClass()
    }
</script>
<section class="thumbnail0">

    <div class="welcome-board1 text-center txt color-white container">
        <h3> E-Classroom </h3>
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

            <?=$_SESSION['student']?> </b>
        </div>
        <hr/>

        <div>

            <div style="margin-top:10px;">

                <div class="row">
                    <div class="col-md-3">

                        <div class="list-group">
                            <a href="#" class="list-group-item disabled b"> Quick Links </a>
                            <a href="student_logged.php" class="list-group-item">Home</a>
                            <a href="student_assignment_s.php" class="list-group-item">View Assignment</a>

                        </div>

                    </div>
                    <div class="col-md-7 txt">

                        <?php

                        $getID = $_GET['id'];

                        $query = phpEasy::$db_connect->prepare("SELECT * FROM assignment WHERE id = ?");
                        $query->execute(array($getID));

                        if ($query->rowCount() > 0) {
                            while ($fetch = $query->fetch()) {
                                print '
                                                 <h3> <i class="fa fa-lightbulb-o"></i>&nbsp;' . $fetch['topic'] . ' </h3>

                                            <small style="color:#666666;"><b>by ' . $phpEasy->get_name($fetch['lecturer']) . '</b> on ' . $fetch['datetime'] . '</small>

                                     <hr/>';

                                /**
                                 *  Display Description Content.
                                 */
                                print '<div>
                                         <b style="margin:0px;padding:0px;color: #1abc9c;display: block"></b>

                                                    <p>
                                                        ' . $fetch['question'] . '
                                                    </p>';

                                $qt = phpEasy::$db_connect->prepare("SELECT * FROM assignment_answer WHERE assignID = ? ORDER BY id DESC");
                                $qt->execute(array($getID));

                                if ($qt->rowCount() > 0) {
                                    print '
                                                 <h6> Student Submission </h6>
                                                 <hr/>';

                                    while ($fetch = $qt->fetch()) {
                                        if ($fetch['answer'] == '' || empty($fetch['answer'])) {
                                        } else {
                                            print '<div style="border-bottom:1px dashed #cccccc">';

                                            print '<small style="color:#666666;"><b>By <i class="fa fa-user"></i> ' . $phpEasy->getName($fetch['matric_no']) . '
                                                            (' . $fetch['matric_no'] . ' )</b> on
                                                        ' . $fetch['datetime'] . '</small><br/>' . $fetch['answer'] . '
                                                      <br/>

                                         <div style="margin-left: 20px;">
                                          </div></div>';
                                        }
                                    }
                                } else {
                                    echo '<br/>No Assignment Submitted <hr/>';
                                }

                                print '<Br/><span style="color:#111" class="qtn">reply assignment</span>
                                <form method="POST">
                     <input type="hidden" id="matric_no" value="' . $_SESSION['student'] . '" />
                                    <textarea  name="reply"  class="quest2 form-control" style="resize: none;"></textarea><br/>

                            <button class="btn btn-primary sub_qtn" type="submit" name="sub_reply"> <b>Submit</b> </button> &nbsp;&nbsp;
                            <button class="btn btn-default"> <b>Cancel</b> </button>

                            ';

                                if (isset($_POST['sub_reply'])) {
                                    $txt = $_POST['reply'];

                                    if (empty($txt) || $txt == '') {
                                        print '<h4 style="color: red">All field are required</h4>';
                                    } else {
                                        $sql = phpEasy::$db_connect->
                                            prepare('INSERT INTO assignment_answer(matric_no, assignID, answer, datetime)
                                           VALUES(?, ?, ?, ?)');
                                        $sql->execute(array($_SESSION['student'], $getID, $txt, date('d-m-y h:ia')));
                                        print '<h4 style="color: lightgreen"><i class="fa fa-check"></i> Assignment Submitted !</h4>';
                                    }
                                }

                                print '</form>
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
require '../footer.php';
?>
</body>

</html>
