<?php

include "Connection.php";
$conn = Connection::getConnection();
echo $conn->host_info . "\n";

$conn->close();

?>
