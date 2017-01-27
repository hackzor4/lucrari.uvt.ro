<?php

include_once 'dbconfig.php';

$q = $_REQUEST["q"];

$sql = "DELETE FROM files WHERE id='$q'";
//$conn->query($sql);
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();





?>