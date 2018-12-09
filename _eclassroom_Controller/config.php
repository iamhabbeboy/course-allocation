<?php

/*
	   *  configure your database and server information here
	   *   configuration file
	   * carefully change the DEFINED variable with appropriate values
	   *
*/

// NOTE THAT CHANGING OTHER INFORMATION MAY CAUSE CONNECTION ERROR

//----- change the "HOST" variable to your host name
//----- Note that 127.0.0.1 or localhost is the default host name for local server
define("_HOST_", "127.0.0.1");

//----- change the "USER" variable to your user name
//----- Note that "root" is the
define("_USER_", "root");

//------ change the "DB_NAME" variable to your database name
define("_DB_NAME_", "virtualclass");

//----- change the "PWD" variable to your server password
define("_PWD_", "root");

//---- the main class lib
include "phpeasy/phpEasy.php";

//----

$phpEasy = new phpEasy(_HOST_, _USER_, _DB_NAME_, _PWD_);

// $phpEasy->selectData(array('matric_no','pwd'),array('12/69/0191','123'));

?>
