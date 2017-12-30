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
      echo "Debug: Opened database successfully<br><br>";
   }
   
   $sql =<<<EOF
      SELECT * from QUESTION;
EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      echo "". $row['ID'] . ".\n";
      //echo "QUESTION = ". $row['QUESTION'] ."\n";
      echo "ANSWER = ". $row['ANSWER'] ." | ";
      echo "CATEGORY = ".$row['CATEGORY'] ." | ";
	  $questionid = $row['ID'];
	  echo "<a href=\"http://localhost:8000/question.php?arg=$questionid\"> Link to question $questionid</a><br>";
   }
   //echo "Operation done successfully\n";
   $db->close();
  
?>


<script>

</script>


</body>
</html>
