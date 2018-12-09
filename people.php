<?php session_start();
ob_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */
$page = 'pages';
require '_eclassroom_Controller/config.php';

$page = 'pages';
//$nav = 'student';

if (isset($_GET['page']) && $_GET['page'] == 'student') {
    $nav = 'student';
} elseif (isset($_GET['page']) && $_GET['page'] == 'lecturer') {
    $nav = 'lecturer';
} else {
    $nav = 'student';
}

require 'header.php';
?>

<script>
    window.onload = function() {
        init()
    }
    function regAccount() {

        var sur = document.querySelector('#surname'), other = document.querySelector('#other'), mat = document.querySelector('.matricno'), pwd = document.querySelector('#reg_pwd')

        if (sur.value == '') {
            sur.focus()
            return false
        } else if (other.value == '') {
            other.focus()
            return false
        } else if (mat.value == '') {
            mat.focus()
            return false
        } else if (pwd.value == '') {
            pwd.focus()
            return false
        }

    }
</script>
<section class="thumbnail1">

    <div class="welcome-board color-white text-center container">
        <h3> E-classroom </h3>
    </div>
</section>

<div class="container">

    <div class="row">
        <div class="col-md-6 txt">

            <?php

            $title = '';

            if (isset($_GET['page']) && $_GET['page'] == 'student') {
                print '<h3> Student Registered </h3>';
            } elseif (isset($_GET['page']) && $_GET['page'] == 'lecturer') {
                print '<h3> Lecturer Registered </h3>';
            } else {
                print '<h3> People Registered </h3>';
            }
            ?>

            <div >

                <?php

                if (isset($_GET['page']) && $_GET['page'] == 'student') {
                    $query = $phpEasy->query('student');

                    if ($query->rowCount() > 0) {
                        while ($ft = $query->fetch()) {
                            print '<div class="float-left color-grey text-center" style="border-radius:10px;padding: 5px 10px;border: 1px solid #ccc;margin: 5px;width: 130px;">

                                    <h1><i class="fa fa-user"></i></h1>
                                    ' . $ft['matric_no'] . '
                                 </div>';
                        }

                        print '<div class="clear-both"></div>';
                    } else {
                        print '<h3>No Student Found !</h3>';
                    }
                } elseif (isset($_GET['page']) && $_GET['page'] == 'lecturer') {
                    $query = $phpEasy->query('lecturer');

                    if ($query->rowCount() > 0) {
                        while ($ft = $query->fetch()) {
                            print '<div class="float-left color-grey text-center" style="border-radius:10px;padding: 5px 10px;border: 1px solid #ccc;margin: 5px;width: 130px;">

                                    <h1><i class="fa fa-user"></i></h1>
                                    ' . $ft['title'] . '. ' . $ft['full_name'] . '
                                 </div>';
                        }

                        print '<div class="clear-both"></div>';
                    } else {
                        print '<h3>No Student Found !</h3>';
                    }
                } else {
                    $query = $phpEasy->query('student');

                    if ($query->rowCount() > 0) {
                        while ($ft = $query->fetch()) {
                            print '<div class="float-left color-grey text-center" style="border-radius:10px;padding: 5px 10px;border: 1px solid #ccc;margin: 5px;width: 130px;">

                                    <h1><i class="fa fa-user"></i></h1>
                                    ' . $ft['matric_no'] . '
                                 </div>';
                        }

                        print '<div class="clear-both"></div>';
                    } else {
                        print '<h3>No Student Found !</h3>';
                    }
                }
                ?>
            </div>

        </div>

        <div class="col-md-5">
            <br/>
            <br/>
            <h1 class="text-center color-grey" style="font-size: 5.3em;padding: 50px 20px;border-radius: 100px;border: 3px solid grey;width: 200px;margin:auto;"><i class="fa  fa-group"></i></h1>
        </div>
        <div class="clearfix"></div>
        <br/>
        <br/>

    </div>
</div>

<?php
require "footer.php";
?>
</body>

</html>