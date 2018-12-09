<?php
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

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form method="post">
            <h3>Login </h3>
            <hr>
            <label>Email Address</label>
            <input type="text" class="form-control" name="email" required>
            <label>Password</label>
            <input type="password" class="form-control" name="pass" required>
            <p></p>
            <input type="submit" class="btn btn-primary" style="width:100%;" name="btnsubmit">

            <?php
            if (isset($_POST['btnsubmit'])) {
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                if ($email == 'admin@gmail.com' && $pass == 'admin') {
                    header('location: dashboard.php');
                } else {
                    echo "<p></p><div class=\"alert alert-danger\">Invalid information supplied !</div>";
                }
            }
            ?>
        </form>
    </div>
</div>
