<?php
session_start();
session_destroy();
header("Location: conexion.php");
exit();
?>
