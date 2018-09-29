<?php 
	require "rb/rb.php";
	R::setup('mysql:host=localhost;dbname=test_loginpage',
        'root', '3782');

	if( !R::testConnection() )
	{
		echo '<b><div style = "color: red;">Database error</div></b>';;
		exit();
	}

	function get_ip()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
	    {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

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

		if( empty($errors))
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = $data['password'];
			R::store($user);
			echo '<div style = "color: green;">Done!</div><hr>';
			echo get_ip();
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