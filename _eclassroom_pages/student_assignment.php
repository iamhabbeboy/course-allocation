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
    <title>Welcome to Departmental Portal </title>
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

                            <a href="student_class.php"> class</a>

                        </li>|

                        <li>
                            <a href="#"><b>assignment</b></a>
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
                        <h3 style="color:#e40087;margin:0px;padding:0px;"> Assignment (<?=$phpEasy->getrows1('lectures')?>)</h3>
                        <hr/>

                        <div>

                            <?php

                            $query = phpEasy::$db_connect->query("SELECT * FROM assignment ORDER BY id DESC");
//$query->execute(array($_SESSION['lecturer']);

                            if ($query->rowCount() > 0) {
                                while ($fetch = $query->fetch()) {
                                    print '<div style="color:#cccccc;border-bottom:1px dashed #e40087;padding:8px;"> <h3
                                            style="margin:0px;
                        padding:0px;color:#e40087;">' . $fetch['topic'] . '</h3>
                                        <small>course:
                                            ' . $fetch['course'] . '</small> &nbsp; | &nbsp;<a
                                            href="#" style="color:#dedede" id="' . $fetch['id'] . '" class="assignment"
                                            >attempt
                                            assignment</a>&nbsp;
                                        <small> posted
                                            on
                                            ' . $fetch['datetime'] . '</small>
    <br/>

                                        <ol><li><' . $fetch['question'] . '</li></ol>';

                                    $qt = phpEasy::$db_connect->prepare("SELECT * FROM assignment_answer WHERE assignID=? ORDER BY id DESC");
                                    $qt->execute(array($fetch['id']));

                                    if ($qt->rowCount() > 0) {
                                        $ft = $qt->fetch();

                                        print '<h3 style="color:#e40087">Answer</h3>
                                    <p>
                                        ' . $ft['answer'] . '
                                    </p>';
                                    }

                                    print '<div style="display: none" class="pAssign' . $fetch['id'] . '">
                                            <div style="float:left;">
                                                <textarea style="width:300px;height:50px;" name="question"   class="quest1' . $fetch['id'] . '"></textarea>

                                            </div>
                                            <div style="float:left;">
                                                <input type="submit" name="sub" class="subQ" id="' . $fetch['id'] . '"
                                                       value="submit" style="padding:5px;height:60px;"/>
                                            </div>
                                            <br style="clear:both;" />
                                            <input type="hidden" id="matric_no" value="' . $_SESSION['student'] . '" />
                                            <input type="hidden" id="assignID" value="' . $fetch['id'] . '" />
                                        </div>
                                    </div>';
                                }
                            } else {
                                print "<h3 style=\"color:#e40087\">No Assignment Posted</h3><br/>";
                            }
                            ?>

                        </div>



                    </div>

                    <br style="clear:both;" />

                </div>
            </div>
        </div>

    </div>
    <br/><br/><br/>
    <div class="eclassroom-footer">
        <small></small>
    </div>

</div>

</body>

</html>