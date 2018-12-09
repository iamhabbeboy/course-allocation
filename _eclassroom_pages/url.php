<?php session_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/18/14
 * Time: 8:45 AM
 */
require '../_eclassroom_Controller/config.php';

/**this is for login url*/
if (isset($_GET['url']) && $_GET['url'] == 'view_lecture') {

    $id = addslashes($_POST['id']);

    $query = phpEasy::$db_connect -> prepare("SELECT * FROM lectures WHERE id=?");
    $query -> execute(array($id));

    if ($query -> rowCount() > 0) {
        $fetch = $query -> fetch();
        print "<p>" . $fetch['description'] . "</p>";
    } else {
        print "<font style='color:red'>error occured !</font>";
    }
} else if (isset($_GET['url']) && $_GET['url'] == 'sQtn') {
    //print "hello world !";
    $qtn = addslashes($_POST['quest']);
    $matric = addslashes($_POST['matric']);
    $id = addslashes($_POST['id']);
    $dat = date('d-m-y h:i a');

    $query = phpEasy::$db_connect -> prepare("INSERT INTO student_question(matric_no, question, lectID, datetime) VALUES(?, ?, ?, ?)");
    $query -> execute(array($matric, $qtn, $id, $dat));

    $qq = phpEasy::$db_connect -> prepare("SELECT * FROM student_question WHERE lectID=?");
    $qq -> execute(array($id));

    print '&nbsp;<b>(' . $qq -> rowCount() . ')</b>';

} else if (isset($_GET['url']) && $_GET['url'] == 'assignment') {
    $assignID = $_POST['assignID'];
    $matric_no = $_POST['matric'];
    $ans = $_POST['quest'];
    $d = date('d-m-y h:i a');

    $query = phpEasy::$db_connect -> prepare("SELECT * FROM assignment_answer WHERE matric_no=? AND answer=?");
    $query -> execute(array($matric_no, $ans));

    if ($query -> rowCount() > 0) {
        return false;
    } else {
        $qtn = phpEasy::$db_connect -> prepare("INSERT INTO assignment_answer(matric_no, assignID, answer, datetime) VALUES(?, ?, ?, ?)");
        $qtn -> execute(array($matric_no, $assignID, $ans, $d));

        print 'all is well !';
    }
} else if (isset($_GET['url']) && $_GET['url'] == 'rep_qty') {

    $text = $_POST['reply'];
    $q_id = $_POST['q_id'];
    $lect_id = $_POST['lect_id'];

    $sql = phpEasy::$db_connect -> prepare('SELECT * FROM student_reply WHERE ans = ? AND lectID = ? AND qID = ?');
     $sql ->execute(array($text, $lect_id, $q_id));
     
      if($sql -> rowCount() > 0 ) {
          print 'exist';
      } else {
          
          $query = phpEasy::$db_connect -> prepare('INSERT INTO student_reply(ans, lectID, qID, datetime) VALUES(?, ?, ?, ?)');
          $query ->execute(array($text, $lect_id, $q_id, date('d-m-y h:ia')));
          print 'saved';
      }
    //print $text.', '.$q_id.', '.$lect_id;

}
