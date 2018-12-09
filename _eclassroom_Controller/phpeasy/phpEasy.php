<?php
    
     /* this is created to simplify beginners in coding styles
     *
     *	phpEasy was originally developed to simplify data driven and communication from database  
     */
     
     class phpEasy
     {
		 
		  static $db_connect;
		   var $isconnected = false;
		   var $error_message = array();
		   var $data_error = array();
		// the main method constructor for phpEasy .... 
		 public function __construct($HOST,$USER,$DB_NAME,$PWD)
		 {
		    try
		    {
				self::$db_connect = new PDO("mysql:host=".$HOST.";dbname=".$DB_NAME,$USER,$PWD);
				  $this->isconnected = true;
				    $this->error_message = "Server Connected Successfully !!";
				    // print $this->error_message;
				 		    
		    }catch(PDOException $e)
		    {
		        $this->isconnected = false;
		         $this->error_message = "Unable to Connect ! ".$e->getMessage();
		         
		           print $this->error_message;
		    }
		 }
		 
		 //--make sure you declare the data supplied in an array 
		 public function convertData($data, $count)
		 {
		 	// $d = array();
		 	 //print count($count);
		     for($x=0;$x<count($count);$x++)
		     {
		     	$d[] = $data;
		     }
		      return implode(',',$d);
		 	 
		  }	     				

         /** this method insert data into database  */
			public function insertData($table, $tb_vals, $data)
			{
				 
				 $table_vals = implode(',',$tb_vals);
				 $da = array_merge(array(),$data);
			      $table = self::security($table);
				try{
				$query = self::$db_connect->prepare("INSERT INTO ".$table."(".$table_vals.") VALUES(".self::convertData
                        ('?',
                        $data).")");
				$query->execute($da); 
				 // print "Data inserted successfully !";
				}
				catch(PDOException $e)
				{
				  print $e->getMessage().' error occured !';	
				}
			}

            public function selectData($table, $values, $replace)
            {
                  $query = self::$db_connect->prepare("SELECT * FROM ".$table." WHERE ".$values[0]."=? AND ".$values[1]."=?");
                  $query->execute(array($replace[0], $replace[1]));

                  if($query->rowCount() > 0){

                      print "found";

                  }else{

                      print "invalid";
                  }
            }
            
           
           public function assignment($ID) {
               
               $query = self::$db_connect->prepare("SELECT * FROM assignment_answer WHERE assignID = ?");
             $query->execute(array($ID));
             return $query -> rowCount();
           } 

            /** this method secured the data  */
           public function security($data)
           {
               $data = trim(htmlspecialchars($data));
               $data = mysql_real_escape_string($data);
                return $data;
           }


         public function register($data)
         {
              $surname = $_POST[$data[0]];
              $other = $_POST[$data[1]];
              $matric = $_POST[$data[2]];
              $pwd = $_POST[$data[3]];
              $photo = $_FILES[$data[4]]['name'];
              $tmp = $_FILES[$data[4]]['tmp_name'];
              $dir = "student_photos/";
              $location = (!file_exists( $dir )) ? mkdir($dir) : ""; 
              move_uploaded_file($tmp, $destination); 
                
             $query = self::$db_connect->prepare("SELECT * FROM student WHERE surname=? AND othername=? AND matric_no=?");
             $query->execute(array($surname, $other, $matric));

              if($query->rowCount() > 0)
              {
                  print "<font color='red'>User Already Exists</font>";
              }
             else
             {
                 try{
               $quty = self::$db_connect->prepare("INSERT INTO student(surname, othername, matric_no,pwd, photo) VALUES(?,?,?, ?, ?)");
               $quty->execute(array($surname, $other, $matric, $pwd, $l));

                  $_SESSION['student'] = $matric;
                    // print "cool";
                 header('location:_eclassroom_pages/student_logged.php');
                 }catch (Exception $e)
                 {
                     print $e;
                 }
             }

         }


         public function change($data)
         {
             $quty = self::$db_connect->prepare("SELECT * FROM lecturer WHERE username=?");
             $quty->execute(array($data));

              if($quty->rowCount() > 0)
              {
                  $d = $quty->fetchAll();
                 return $d;
              }
         }


         public function getrows($type, $data)
         {
             $query = self::$db_connect->prepare("SELECT * FROM ".$type." WHERE lecturer=?");
             $query->execute(array($data));

                  print $query->rowCount();

         }

         public function getrows1($db)
         {
             $query = self::$db_connect->query("SELECT * FROM ".$db);
             //$query->execute(array($data));

             print $query->rowCount();
         }


         public function qtn($id)
         {
             $query = self::$db_connect->prepare("SELECT * FROM student_question WHERE lectID=?");
             $query->execute(array($id));

              return $query->rowCount();
         }

         public function getName($matric)
         {
             $query = self::$db_connect->prepare("SELECT * FROM student WHERE matric_no=?");
             $query->execute(array($matric));

               $fetc = $query->fetch();
               return $fetc['othername'];
         }
         
         
         
         public function get_name() {
             $arg = func_get_args();
            $name = $arg[0];
            
            $sql = self::$db_connect -> prepare("SELECT * FROM lecturer WHERE username = ?");
            $sql ->execute(array($name));
             $ft = $sql ->fetch();
             return $ft['title'].'. '.$ft['full_name']; 
         }
         
     public function query() {

        $args = func_get_args();
        // convert param given to array ;
        $table = $args[0];
        // rep. first param @ initialization;

        //check if array or parameter length greater 1

        if (count($args) == 3) {

            $field = $args[1];
            $value = $args[2];

            $query = self::$db_connect -> prepare(" SELECT * FROM " . $table . " WHERE " . $field . " = ?");
            $query -> execute([$value]);
            return $query;

        } else if (count($args) == 1) {

             $query = self::$db_connect -> query(" SELECT * FROM " . $table);
            return $query;

        } else if (count($args) == 5) {

             $field1 = $args[1];
            $value1 = $args[2];
            $field2 = $args[3];
            $value2 = $args[4];

            if (preg_match('/&/', $field2)) {

                $query = self::$db_connect -> prepare(" SELECT * FROM " . $table . " WHERE " . $field1 . " = ? AND ". $field2 . " = ?");
                $query -> execute([$value1, $value2]);
                return $query;
                
            } else {
                
                print 'not found';
                
            }
        }
    }

   
     
     
     }
    