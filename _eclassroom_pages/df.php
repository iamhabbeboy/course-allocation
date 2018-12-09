<?php

include '../_eclassroom_Controller/config.php';


  if(isset($_GET['cID'])){

    //print $_GET['cID'];
    $ID = addslashes($_GET['cID']);


     $query = phpEasy::$db_connect->prepare("SELECT * FROM lectures WHERE id=?");
     $query->execute(array($ID));

      while($f = $query->fetch())
      {
      	 $name = $f['course'];
      	 $material = $f['handout'];

      	  header('content-type:application/pdf');
      	  header('content-disposition;attachment='.$name);
      	   
      	 //$d = file_get_contents($material);


      }
  }
?>