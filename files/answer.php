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
   
   
   $duration = $answer = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["answer"])) {
    $answer = "answer is required";
  } else {
    $answer = $_POST["answer"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$answer)) {
      $answer = "Only letters and white space allowed"; 
    }
  }
  $duration = $_POST["duration"];
  $questionid = $_POST["questionid"];
  //echo $duration;
  $sql = "INSERT INTO STUDENT (QUESTION_ID,ANSWER,TIME)\nVALUES ( \"$questionid\" , \"$answer\" , \"$duration\" );";

  $ret = $db->exec($sql);
	if(!$ret){
	   echo $db->lastErrorMsg();
	} else {
	   echo "Answer inserted successfully\n<br>";
	}
	
}

//Query all inserted answer
   $sql =<<<EOF
      SELECT * from STUDENT;
EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      echo "". $row['ID'] . ".\n";
      echo "QUESTION_ID = ". $row['QUESTION_ID'] ."\n";
      echo "ANSWER = ". $row['ANSWER'] ." | ";
      echo "TIME = ".$row['TIME'] ." <br> ";
   }
   //echo "Operation done successfully\n";
   $db->close();

?>

<p> <a href=main.php>Mainpage</a> </p>


</body>
</html>