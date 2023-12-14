<?php

session_start();


unset($_SESSION['IdChat']);


header("location: " . $_SERVER['HTTP_REFERER']);
exit();

?>