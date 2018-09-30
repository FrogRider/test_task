<?php include "connection.php"; 
$user = $_SESSION['logged_user'];
if($user)
{
	echo "Site content\n";
	echo $user;

	?>
	<a href="logout.php">Logout</a> 
	<?php
}else {
?>
<a href="login.php">Login</a><br>
<a href="signup.php">Signup</a><br>
<?php } ?>
