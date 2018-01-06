<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php

	class MyDB extends SQLite3 {
      function __construct() {
         $this->open('test.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Debug: Opened database successfully<br>";
   }
   
   $usrname = $_SESSION["usrname"];
   $sql = "DROP TABLE $usrname";
   
	$ret = $db->exec($sql);
	if(!$ret){
	   echo $db->lastErrorMsg();
	} else {
	   echo "Table deleted successfully\n";
	}

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

?>

<p>Logout successful</p><br>

<p> <a href=main.php>Mainpage</a> </p>

<p> <a href=session.php>Login</a> </p>

<script>

</script>


</body>
</html>