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
      echo "Opened database successfully\n";
   }
   
   
//echo phpinfo();

// define variables and set to empty values
$question = $answer = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["question"])) {
    $question = "Question is required";
  } else {
    $question = $_POST["question"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$question)) {
      $question = "Only letters and white space allowed"; 
    }
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
  $duration = $_POST["time"];
  echo $duration;
  $sql = "INSERT INTO QUESTION (QUESTION,ANSWER,TIME)\nVALUES ( \"$question\" , \"$answer\" , \"$duration\" );";

   //echo $sql;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
   $db->close();
}
  
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Question: <input type="text" name="question" value="<?php echo $question;?>">
  <span class="error">* <?php echo $question;?></span>
  <br><br>
  Answer: <input type="text" name="answer" value="<?php echo $answer;?>">
  <span class="error">* <?php echo $answer;?></span>
  <br><br>
  <input type="hidden" id="jsduration" name="time" value="">
  <input type="submit" name="submit" value="Submit">  
</form>

<p id="demo"></p>

<iframe src="http://localhost:8000/viewdb.php"
        width="100%" height="500" frameborder="0"
        allowfullscreen sandbox>
</iframe>

<script>
var initime = new Date().getTime();
var fivemin = initime + 5000;
// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
	    
    // Find the distance between now an the count down date
    var distance = fivemin - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
	document.getElementById("jsduration").value = seconds;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>


</body>
</html>
