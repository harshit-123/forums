<?php
session_start();
echo 'Login you are...Please Wait';
session_destroy();
header("Location:/forums");


?>