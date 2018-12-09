<?php require '_eclassroom_Controller/config.php';
function slot($phpEasy, $slot_id)
{
    $level = $_GET['level'];
    $semester = $_GET['semester'];
    $dept = $_GET['dept'];
    $sql = $phpEasy::$db_connect->query("SELECT * FROM slots, allocation WHERE allocation.level = '{$level}' AND allocation.semester = '{$semester}' AND allocation.dept = '{$dept}' AND allocation.id = slots.allocation_id AND slots.slot_id='{$slot_id}'");
    if ($sql->rowCount() > 0) {
        $fetch = $sql->fetch();
        echo '<h5>' . $fetch['lecturer'] . '</h5><p>' . $fetch['course'] . '</p>';
    } else {
        echo '-';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Export Data </title>
    <style >
        body {
            font-family: calibri,arial,helvetica;
        }
    </style>
</head>
<body>

<div style="width: 80%;margin: auto;">
    <a href="dashboard.php"><small><b>&laquo; Back </b></small></a> &nbsp;
    <a href="javascript:window.print()"><small><b>Print </b></small></a>
    <h3 style="text-align: center;color: green">Level: <?php echo strtoupper($_GET['level']) ?> &nbsp; Semester: <?php echo strtoupper($_GET['semester']) ?>
        &nbsp; Dept: <?php echo strtoupper($_GET['dept']) ?>
    </h3>
    <p style="font-size: 12px;text-align: center;color: #993300">please select landscape layout </p>
    <table style="width: 100%;background: #CCC;text-align: left;" cellpadding="5" cellspacing="1">
        <tr style="color: #000">
            <th>Days</th>
            <th>8-10AM</th>
            <th>10-12PM</th>
            <th>12-2PM</th>
            <th>2-4PM</th>
            <th>4-6PM</th>
        </tr>
        <tr style="background: #FFF">
            <th> MON </th>
            <th> <?php echo slot($phpEasy, 'A-0') ?></th>
            <th> <?php echo slot($phpEasy, 'B-0') ?></th>
            <th> <?php echo slot($phpEasy, 'C-0') ?></th>
            <th> <?php echo slot($phpEasy, 'D-0') ?></th>
            <th> <?php echo slot($phpEasy, 'E-0') ?></th>
        </tr>
        <tr style="background: #FFF">
            <th> TUE </th>
            <th> <?php echo slot($phpEasy, 'A-1') ?></th>
            <th> <?php echo slot($phpEasy, 'B-1') ?></th>
            <th> <?php echo slot($phpEasy, 'C-1') ?></th>
            <th> <?php echo slot($phpEasy, 'D-1') ?></th>
            <th> <?php echo slot($phpEasy, 'E-1') ?></th>
        </tr>
        <tr style="background: #FFF">
            <th> WED</th>
            <th> <?php echo slot($phpEasy, 'A-2') ?></th>
            <th> <?php echo slot($phpEasy, 'B-2') ?></th>
            <th> <?php echo slot($phpEasy, 'C-2') ?></th>
            <th> <?php echo slot($phpEasy, 'D-2') ?></th>
            <th> <?php echo slot($phpEasy, 'E-2') ?></th>
        </tr>
        <tr style="background: #FFF">
            <th> THUR</th>
            <th> <?php echo slot($phpEasy, 'A-3') ?></th>
            <th> <?php echo slot($phpEasy, 'B-3') ?></th>
            <th> <?php echo slot($phpEasy, 'C-3') ?></th>
            <th> <?php echo slot($phpEasy, 'D-3') ?></th>
            <th> <?php echo slot($phpEasy, 'E-3') ?></th>
        </tr>
        <tr style="background: #FFF">
            <th> FRI</th>
            <th> <?php echo slot($phpEasy, 'A-4') ?></th>
            <th> <?php echo slot($phpEasy, 'B-4') ?></th>
            <th> <?php echo slot($phpEasy, 'C-4') ?></th>
            <th> <?php echo slot($phpEasy, 'D-4') ?></th>
            <th> <?php echo slot($phpEasy, 'E-4') ?></th>
        </tr>
        <tr style="background: #FFF">
            <th> SAT </th>
            <th> <?php echo slot($phpEasy, 'A-5') ?></th>
            <th> <?php echo slot($phpEasy, 'B-5') ?></th>
            <th> <?php echo slot($phpEasy, 'C-5') ?></th>
            <th> <?php echo slot($phpEasy, 'D-5') ?></th>
            <th> <?php echo slot($phpEasy, 'E-5') ?></th>
        </tr>
    </table>
</div>
</body>
</html>