<?php require_once 'helpers.php';
require '_eclassroom_Controller/config.php';

if (isset($_GET['rel']) && $_GET['rel'] == 'table') {
    $level = array_get($_REQUEST, 'level');
    $semester = array_get($_REQUEST, 'semester');
    $dept = array_get($_REQUEST, 'dept');

    $retrieve = $phpEasy::$db_connect->query("SELECT * FROM slots, allocation WHERE allocation.level = '{$level}' AND allocation.semester = '{$semester}' AND allocation.dept = '{$dept}' AND allocation.id = slots.allocation_id");
    $json_data = [];
    while ($output = $retrieve->fetch()) {
        array_push($json_data, $output);
    }
    echo json_encode(['status' => 'success', 'data' => $json_data, 'count' => count($json_data)]);
} elseif (isset($_GET['rel']) && $_GET['rel'] == 'add-course') {
    $title = array_get($_REQUEST, 'title');
    $code = array_get($_REQUEST, 'code');
    $unit = array_get($_REQUEST, 'unit');

    $store = $phpEasy::$db_connect->prepare("SELECT * FROM courses WHERE title=? AND code=?");
    $store->execute([$title, $code]);
    // echo $store->rowCount() . ' is here';
    if ($store->rowCount() < 1) {
        $save_store = $phpEasy::$db_connect->prepare("INSERT INTO courses(title, code, unit, created_at) VALUES(?,?,?,?)");
        $save_store->execute([$title, $code, $unit, date('d-m-Y h:ia')]);
        echo "saved";
    } else {
        echo "exist";
    }
} elseif (isset($_GET['rel']) && $_GET['rel'] == 'update-course') {
    $slot_id = array_get($_REQUEST, 'slot_id');
    $allocation_id = array_get($_REQUEST, 'allocation_id');
    $code = array_get($_REQUEST, 'code');
    $retrieve_store = $phpEasy::$db_connect->prepare("SELECT * FROM slots WHERE allocation_id='{$allocation_id}' AND slot_id='{$slot_id}'");
    $retrieve_store->execute([$allocation_id, $slot_id]);

    if ($retrieve_store->rowCount() > 0) {
        $update_store = $phpEasy::$db_connect->query("UPDATE slots SET course='{$code}' WHERE allocation_id='{$allocation_id}' AND slot_id='{$slot_id}'");
        echo $update_store->rowCount();
    } else {
        echo "error";
    }
} elseif (isset($_GET['rel']) && $_GET['rel'] == 'export') {
    $filename = 'file.csv';
    header('Cache-Control: must-validate, post-check=0, pre-check=0');
    header('Content-type: text/csv');
    header('Content-Disposition: attachment;filename="$filename"');
    $level = array_get($_REQUEST, 'level');
    $semester = array_get($_REQUEST, 'semester');
    $dept = array_get($_REQUEST, 'dept');
    $retrieve = $phpEasy::$db_connect->query("SELECT * FROM slots, allocation WHERE allocation.level = '{$level}' AND allocation.semester = '{$semester}' AND allocation.dept = '{$dept}' AND allocation.id = slots.allocation_id");
    $fh = fopen($filename, 'w');
    $csv_data = '<table border="1">';
    $csv_data .= '<tr><th>Testing</th></tr>';
    while ($output = $retrieve->fetch()) {
        fputcsv($fh, array_values($output));
    }
    $csv_data .= '</table>';
    fclose($fh);

    // echo json_encode(['status' => 'success', 'data' => $json_data,
}
