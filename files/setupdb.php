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
      echo "Opened database successfully<br>";
   }
   
   
   $sql =<<<EOF
      CREATE TABLE QUESTION
	  (ID INTEGER PRIMARY KEY AUTOINCREMENT,
	  QUESTION TEXT NOT NULL,
	  ANSWER TEXT NOT NULL,
	  CATEGORY TEXT NOT NULL);  
	  
	  CREATE TABLE STUDENT
	  (ID INTEGER PRIMARY KEY AUTOINCREMENT,
	  QUESTION_ID INT NOT NULL,
	  ANSWER TEXT NOT NULL,
	  TIME INT NOT NULL);
EOF;
    $ret = $db->exec($sql);
	if(!$ret){
	   echo $db->lastErrorMsg();
	} else {
	   echo "Table created successfully\n";
	}
	$db->close();
  
?>


<script>

</script>


</body>
</html>
