<?php
require 'config.inc';
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
        <title>Welcome to Departmental Portal | Homepage</title>
        <meta name="keyword" content=""/>
        <meta name="description" content=""/>
        <link rel="stylesheet" href="<?=HOST?>_eclassroom_stylesheet/css/vendor/bootstrap.min.css" />
        <link rel="stylesheet" href="<?=HOST?>_eclassroom_stylesheet/css/flat-ui.min.css" />
        <link rel="stylesheet" href="<?=HOST?>_eclassroom_stylesheet/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?=HOST?>_eclassroom_stylesheet/_eclassroom_styles.css" />
        <link rel="stylesheet" href="<?=HOST?>_eclassroom_stylesheet/css/color.css" />
        <link rel="stylesheet" href="<?=HOST?>_eclassroom_stylesheet/css/utility.css" />
        <script type="text/javascript" src="<?=HOST?>_eclassroom_js/jquery-3.3.1.min.js"></script>
        <!--<script src="_eclassroom_js/js.js"></script> -->
        <script src="<?=HOST?>_eclassroom_js/js.js"></script>
        <script src="<?=HOST?>_eclassroom_js/bootstrap.min.js"></script>
        <script src="<?=HOST?>_eclassroom_js/collapse.js"></script>
    </head>

    <body >

        <nav class="navbar navbar-inverse navbar-embossed" role="navigation" style="border-radius: 0px !important">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand" href="<?=HOST?>"> <span class="fa  fa-mortar-board"></span></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
                <ul class="nav navbar-nav" style="width: 50%;">
                    <?php

                    if ($page == 'pages') {
                        print '<li ' . (($nav == 'home') ? 'class="active" ' : '') . '><a href="' . HOST . '"> Home </a></li>
<li ' . (($nav == 'about') ? 'class="active" ' : '') . '><a href="' . HOST . 'about.php">About</a></li>
<li ' . (($nav == 'student') ? 'class="active" ' : '') . '><a href="' . HOST . 'people.php?page=student"> Students</a></li>
<li ' . (($nav == 'lecturer') ? 'class="active" ' : '') . '><a href="' . HOST . 'people.php?page=lecturer"> Lecturers</a></li>';
                    } elseif ($page == 'student') {
                        print '<li ' . (($nav == 'home') ? 'class="active" ' : '') . '><a href="../"> Home </a></li>
<li ' . (($nav == 'lectures') ? 'class="active" ' : '') . '><a href="student_class.php">Lectures</a></li>
<li ' . (($nav == 'assignment') ? 'class="active" ' : '') . '><a href="student_assignment_s.php"> Assignment</a></li>

<li><a href="?url=logout"> Logout</a></li>';
                    } elseif ($page == 'lecturer') {
                        print '<li ' . (($nav == 'home') ? 'class="active" ' : '') . '><a href="../"> Home </a></li>
<li ' . (($nav == 'class') ? 'class="active" ' : '') . '><a href="lecturers_class.php">Lectures </a></li>
<li ' . (($nav == 'assignment') ? 'class="active" ' : '') . '><a href="lecturerAssignment.php"> Assignment</a></li>

<li ><a href="?url=logout"> Logout</a></li>';
                    } else {
                        print '<li class="active"><a href="../"> Home </a></li>
                        <li><a href="lecturers_class.php">Lecturers</a></li>
                        <li><a href="lecturers_assignment.php"> Assignment</a></li>
                        <li><a href="?url=logout"> Logout</a></li>';
                    }
                    ?>
                </ul>

            </div><!-- /.navbar-collapse -->
        </nav><!-- /navbar -->
