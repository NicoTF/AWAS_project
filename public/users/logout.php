<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
session_start();
$_SESSION = [];
session_destroy();
header('Location: ../login.php');
exit();
?>