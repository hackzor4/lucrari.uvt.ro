<?php
session_start();
include_once 'dbconfig.php';


$id_r = $_GET["q"];



$sql = "UPDATE requests SET status = 1 WHERE id_r='$id_r'";
$result = $conn->query($sql);
//$conn->query($sql);


if ($result->num_rows > 0) {
			 // output data of each row
			 echo "works";
		} else {
			 echo "fail";
		}


$conn->close();
?>