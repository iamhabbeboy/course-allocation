<?php require_once 'helpers.php';
require '_eclassroom_Controller/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $level = array_get($_REQUEST, 'level');
    $semester = array_get($_REQUEST, 'semester');
    $dept = array_get($_REQUEST, 'dept');
    $lecturer = array_get($_REQUEST, 'lecturer');
    $slot = array_get($_REQUEST, 'slot');

    $query = $phpEasy::$db_connect->prepare("SELECT * FROM slots,allocation WHERE slots.slot_id=? AND slots.lecturer=? AND allocation.dept=? AND allocation.semester=? AND allocation.semester=?");
    $query->execute([$slot, $lecturer]);
    if ($query->rowCount() > 0) {
        echo 'error';
    } else {
        $store_allocation = $phpEasy::$db_connect->prepare("INSERT INTO allocation(dept, level, semester, created_at)
			VALUES(?, ?, ?, ?)");
        $store_allocation->execute([$dept, $level, $semester, date('d-m-Y h:ia')]);
        $allocation_id = $phpEasy::$db_connect->lastInsertId();

        $query = $phpEasy::$db_connect->prepare("INSERT INTO slots(allocation_id, slot_id, lecturer, created_at) VALUES(?, ?, ?, ?)");
        $query->execute([$allocation_id, $slot, $lecturer, date('d-m-Y h:ia')]);
    }
}
