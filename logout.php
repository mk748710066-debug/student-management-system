<?php

session_start();

// Saare session data remove karo
$_SESSION = [];

// Session destroy karo
session_destroy();

// Login page par redirect
header("Location: index.php");
exit();

?>