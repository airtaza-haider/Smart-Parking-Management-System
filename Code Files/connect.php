<?php

$servername= "localhost";
$user= "root";
$password= "";
$database= "parking_mgmt";

$conn= mysqli_connect($servername, $user, $password, $database);

if ($conn) {
	echo "Database Connected";
}
else{
	echo "Could not connect";
}

?>