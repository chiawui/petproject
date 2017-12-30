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
  echo $duration;
  $sql = "INSERT INTO QUESTION (QUESTION,ANSWER,TIME)\nVALUES ( \"$questionid\" , \"$answer\" , \"$duration\" );";

   echo $sql;
   $db->close();
}

?>




</body>
</html>