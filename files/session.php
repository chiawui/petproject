
<!DOCTYPE html>
<html>
<body>
<?php

if (isset($_GET["arg"])) {
	if ($_GET) {
		$arg = $_GET['arg'];
	} else {
		$arg = $argv[1];
	}
}

?>

<p>Input your name to start answering question</p>

<form method="post" action="<?php echo "question.php?arg=1";?>">  
  Name: <input type="text" name="usrname" value="">
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<p id="demo"></p><br>

<p> <a href=main.php>Mainpage</a> </p>

<script>

</script>


</body>
</html>