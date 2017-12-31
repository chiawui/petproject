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
   
   if (isset($_GET["arg"])) {
	if($_GET["arg"]=="del"){
	   $id = $_GET["id"];
	   $sql ="DELETE FROM QUESTION WHERE ID = $id";
	   
	   $ret = $db->exec($sql);
		if(!$ret){
		   echo $db->lastErrorMsg();
		} else {
		   echo "Deleted successfully\n";
		}
	}
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
	  echo "<a href=\"http://localhost:8000/question.php?arg=$questionid\"> Link to question $questionid</a> | ";
	  echo "<a href=\"http://localhost:8000/viewdb.php?arg=del&id=$questionid\"> Delete $questionid</a><br>";
   }
   //echo "Operation done successfully\n";
   $db->close();
  
?>

<p> <a href=main.php>Mainpage</a> </p>

<script>

</script>


</body>
</html>
