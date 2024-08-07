<?php
session_start();
session_unset();
session_destroy();

echo '<script language="javascript">';
echo 'alert("Has cerrado sesión");';
echo 'window.location="login.php";';
echo '</script>';
?>
