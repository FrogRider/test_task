<?php

require "rb/rb.php";
	R::setup('mysql:host=localhost;dbname=test_loginpage','root', '3782');

	if( !R::testConnection() )
	{
		echo '<b><div style = "color: red;">Database connection error</div></b>';;
		exit();
	}

	session_start();
	
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
    $ip = get_ip();

