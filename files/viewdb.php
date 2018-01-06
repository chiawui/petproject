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
   $stmt = $db->prepare("SELECT DISTINCT CATEGORY FROM QUESTION");
   $ret = $stmt->execute();
   // List out category if available
   echo "CATEGORY FILTER= ";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $category = $row['CATEGORY'];
      echo "<a href=\"http://localhost:8000/viewdb.php?catfilter=$category\"> $category</a> | ";
   }
   echo "<br><br>";
      
   //check argument
   if (isset($_GET["catfilter"])) {
		$filter = $_GET["catfilter"];
		// Query list of all question filtered by category'
		$stmt = $db->prepare("SELECT * from QUESTION WHERE CATEGORY = (:category)");
		$stmt->bindParam(':category', $filter);
		$sql = "SELECT * from QUESTION WHERE CATEGORY = \"$filter\"";
	}
	else if(isset($_GET["deleteid"])){
		$id = $_GET["deleteid"];
		// Delete entry of deleteid from database
		$stmt = $db->prepare("DELETE FROM QUESTION WHERE ID = (:id)");
		$stmt->bindParam(':id', $id);
		   
		$ret = $stmt->execute();
		if(!$ret){
		   echo $db->lastErrorMsg();
		} else {
		   echo "Deleted successfully\n";
		}
	}
	else{
		//Query list of all questions
		$stmt = $db->prepare("SELECT * from QUESTION");
	}
      
   $ret = $ret = $stmt->execute();
   //Print out list of all questions
   $id =0;
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $id++;
	  echo "$id . ";
      echo "QUESTION_ID = ". $row['ID'] . " |";
      echo "ANSWER = ". $row['ANSWER'] ." | ";
      echo "CATEGORY = ".$row['CATEGORY'] ." | ";
	  $questionid = $row['ID'];
	  echo "<a href=\"http://localhost:8000/question.php?arg=$questionid\"> Link to question $questionid</a> | ";
	  echo "<a href=\"http://localhost:8000/viewdb.php?deleteid=$questionid\"> Delete $questionid</a><br>";
   }
   //echo "Operation done successfully\n";
   $db->close();
  
?>

<p> <a href=main.php>Mainpage</a> </p>

<script>

</script>


</body>
</html>
