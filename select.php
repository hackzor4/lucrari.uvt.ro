<?php
include_once 'dbconfig.php';

$q = $_REQUEST["q"];

$sql = "SELECT * FROM files WHERE id='$q'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<center><form action='update.php' method='post'>
				<input type='hidden'name='id'value='".$q."'/>
				 <h3>Titlul lucrari:</h3><input type='text'name='titlu'size='37'value='".$row['titlu']."'/><br>
				 <h3>Descriere:</h3><textarea rows='4' cols='39'name='descriere'>".$row['descriere']."</textarea><br><br>
				 <center><button class='btn btn-default'type='submit' name='btn-upload'>UPDATE</button></center>
				 </form></center>";
    }
} else {
    echo "0 results";
}
$conn->close();



?>