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
   
   // Query list of category
   $sql = "SELECT DISTINCT CATEGORY FROM QUESTION";
   
   $ret = $db->query($sql);
   echo "CATEGORY FILTER= ";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $category = $row['CATEGORY'];
      echo "<a href=\"http://localhost:8000/viewdb.php?arg=cat&filter=$category\"> $category</a> | ";
   }
   echo "<br><br>";
   
   //check argument
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
		else if($_GET["arg"]=="cat"){
			$filter = $_GET["filter"];
			// Query list of all question filtered by category
			$sql = "SELECT * from QUESTION WHERE CATEGORY = \"$filter\"";
		}
	}
	else{
		$sql = "SELECT * from QUESTION";
	}
      
   

   $ret = $db->query($sql);
   $id =0;
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $id++;
	  echo "$id . ";
      echo "QUESTION_ID = ". $row['ID'] . " |";
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
