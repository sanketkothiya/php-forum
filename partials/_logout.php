<?php
session_start();
echo "logout success";
session_destroy();
header("Location:/forum");
?>
 