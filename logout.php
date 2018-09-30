<?php 
include "connection.php";
unset($_SESSION['logged_user']);
unset($_SESSION['ban']);
header('Location: index.php');

