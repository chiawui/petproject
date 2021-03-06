<!DOCTYPE html>
<html>
<body>
<?php

// define variables and set to empty values
$question = $category = $answer = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["question"])) {
    $question = "Question is required";
  } else {
	$page = $_POST["question"];
    $question = "http://localhost:8000/$page";
  }
  if (empty($_POST["answer"])) {
    $answer = "answer is required";
  } else {
    $answer = $_POST["answer"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$answer)) {
      $answer = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["category"])) {
    $category = "category is required";
  } else {
    $category = $_POST["category"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$category)) {
      $category = "Only letters and white space allowed"; 
    }
  }
  
  $sql = "INSERT INTO QUESTION (QUESTION,ANSWER,CATEGORY)\nVALUES ( \"$question\" , \"$answer\" , \"$category\" );";

  //connect to db
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
  
   //echo $sql;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records added successfully\n";
   }
   $db->close();
}
  
?>

<p> Input relative question page. eg. question1.php. </p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Question: <input type="text" name="question" value="">
  <span class="error">* <?php echo $question;?></span>
  <br><br>
  Answer: <input type="text" name="answer" value="">
  <span class="error">* <?php echo $answer;?></span>
  <br><br>
  Category: <input type="text" name="category" value="">
  <span class="error">* <?php echo $category;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<p> <a href=main.php>Mainpage</a> </p>

<script>

</script>


</body>
</html>