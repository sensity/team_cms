<?php

session_start();
//unset($_SESSION['username']); // will delete just the name data
//unset($_SESSION['loginn']); // will delete just the name data
session_destroy();
header("location:index.php");

?>