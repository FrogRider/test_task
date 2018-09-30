<?php   
    include "connection.php";
    $data = $_POST;

    $_SESSION['ban'] = 0;
    if( isset($data['do_login']))
    {

        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if( $user )
        {
            
            if( password_verify($data['password'], $user->password)){

                $_SESSION['logged_user'] = $user;
                echo '<div style = "color: green;">Now you are logged in. Go to <br><a href ="index.php">main</a> page</div><hr>';
            }
            else
            {
                if ($_SESSION['ban'] >= 3)
                {
                    echo "you are banned";
                    exit();
                }
                    
                $errors[] = 'Password incorrect';
                $_SESSION['ban'] += 1;
            }
        } else
        {
            $errors[] = 'This login does not exist';
        }

        if( !empty($errors))
        {
            echo '<div style = "color: red;">'.array_shift($errors).'</div><hr>';
        }
    }

?>

<form action="login.php" method="POST">

    <p>
        <p><strong>Login</strong></p>
        <input type="text" name = "login" value = "<?php echo @$data['login']; ?>">
    </p>

    <p>
        <p><strong>Email</strong></p>
        <input type="password" name = "password" value = "<?php echo @$data['password']; ?>">
    </p>

    <p>
        <button type = "submit" name = "do_login">Log in</button>
    </p>

</form>