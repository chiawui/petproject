<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

?>

<p>Logout successful</p><br>

<p> <a href=main.php>Mainpage</a> </p>

<p> <a href=session.php>Login</a> </p>

<script>

</script>


</body>
</html>