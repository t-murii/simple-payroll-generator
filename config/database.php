<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'company');

//creat sql connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//check connection
if ($conn->connect_error) {
    die('No connection' . $conn->connect_error);
}
echo 'Database connected successfully';
