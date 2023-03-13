<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
session_unset();
session_destroy();
echo '<script>window.location.href="/WebProgramiranje/index.php";</script>';

?>