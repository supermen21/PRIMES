<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$dbConn = new mysqli("localhost:3308:", "root", "", "primesdb");
if ($dbConn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

