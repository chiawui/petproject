<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php

if ($_GET) {
    $arg = $_GET['arg'];
} else {
    $arg = $argv[1];
}

//Set session username
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST["usrname"])) {
	// Set session variables
	$_SESSION["usrname"] = $_POST["usrname"];
  }
  
}

//Redirect to login page if session not started
	if(count($_SESSION)==0){
		header("Location: /session.php?arg=$arg");
	}
	else if($_SESSION["usrname"]=="")
	{
		echo "Session not started";
	}else{
	$usrname = $_SESSION["usrname"];
	echo "Session has started $usrname <br>";
	}


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
      SELECT QUESTION from QUESTION WHERE ID= $arg;
EOF;
   $ret = $db->query($sql);
   $row = $ret->fetchArray(SQLITE3_ASSOC);
   $question = $row['QUESTION'];
   
   $answer = "";


?>
<iframe src="<?php echo $question; ?>"
        width="100%" height="500" frameborder="0"
        allowfullscreen sandbox>
</iframe>

<form method="post" action="answer.php">  
  Answer: <input type="text" name="answer" value="<?php echo $answer;?>">
  <span class="error">* <?php echo $answer;?></span>
  <br><br>
  <input type="hidden" id="questionid" name="questionid" value="<?php echo $arg; ?>">
  <input type="hidden" id="duration" name="duration" value="">
  <input type="submit" name="submit" value="Submit">  
</form>

<p id="demo"></p><br>

<p><a href=session_end.php>Logout</a> </p>

<p> <a href=main.php>Mainpage</a> </p>

<script>
var initime = new Date().getTime();
var fivesec = initime + 5000;
// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
	    
    // Find the distance between now an the count down date
    var distance = fivesec - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
	document.getElementById("duration").value = seconds;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "TIME UP";
    }
}, 1000);
</script>


</body>
</html>