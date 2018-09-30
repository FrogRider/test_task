<?php 
	include "connection.php";

	$data = $_POST;

	if( isset($data['do_signup']) )
	{
		$errors = array();
		if( trim($data['login']) == '')
		{
			$errors[] = "Enter login";
		}

		if( trim($data['email']) == '')
		{
			$errors[] = "Enter email";
		}

		if( $data['password'] == '')
		{
			$errors[] = "Enter password";
		}

		if( $data['password'] != $data['password_2'])
		{
			$errors[] = "Passwords doesn't match";
		}

		if(R::count('users', "login = ?", array($data['login'])) > 0
)		{
			$errors[] = "Login has already taken";
		}

		if(R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = "Email has already taken";
		}

		if( empty($errors))
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			echo '<div style = "color: green;">Done!</div><hr>';
		}else
		{
			echo '<div style = "color: red;">'.array_shift($errors).'</div><hr>';
		}

	}
?>

<form action="signup.php" method="POST">
	
	<p>
		<p><strong>Login</strong></p>
		<input type="text" name = "login" value = "<?php echo @$data['login']; ?>">
	</p>

	<p>
		<p><strong>Email</strong></p>
		<input type="email" name = "email" value = "<?php echo @$data['email']; ?>">
	</p>

	<p>
		<p><strong>Password</strong></p>
		<input type="password" name = "password">
	</p>

	<p>
		<p><strong>Confirm password</strong></p>
		<input type="password" name = "password_2">
	</p>

	<p>
		<button type = "submit" name = "do_signup">Submit</button>
	</p>


</form>