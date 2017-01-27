<?php 

include ("qrlib.php");
include ("config.php");

$servername = "localhost";
$username = "mihaela";
$password = "Nbr6tVGOHMtCyV3";
$dbname = "mihaela";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM qr";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	echo "<style> 
	
	table {
    border-collapse: collapse;
	}
	
	
	table, th, td {
    border: 1px solid black;
	}
	
	}</style>";
	$j = 0;
	echo "<center><table>";
    while($row = $result->fetch_assoc()) {
					
					$id = $row["id"];
					$locatie = $row["locatie"];
					$nr_sala = $row["nr_sala"];
					
					
					$email1 = 'sesizari.tehnic@e-uvt.ro';
					$email2 = 'sesizari.administrativ@e-uvt.ro';
					$email3 = 'sesizari.camine@e-uvt.ro';
					
					$subject1 = 'Tehnic '.$locatie.' '.$nr_sala;
					$subject2 = 'Administrativ '.$locatie.' '.$nr_sala;
					
					$body; 
					
					$text1 = "<td>
								<p>
								Pentru sesizarea unei probleme tehnice in aceasta locatie,va rugam
								sa scanati QR code-ul alaturat si sa trimiteti un mesaj la adresa
								<u>sesizari.tehnic@e-uvt.ro</u>,cu subiectul: <b>Tehnic.</b></p><br>
								Probleme tehnice: nefunctionare echipamente IT(calculatoare,videoproiectoare,imprimante,multifunctionale,camere video,
								echipamente de videoconferinta),retea wifi, retea internet, etc.<br><br>
								
								<b>Vor fi luate in considerare doar mesajele transmise de pe adresa de e-mail institutionala.</b><br><br>";
					$text2 = "<td>
								<p>
								Pentru sesizarea unei probleme tehnice in aceasta locatie,va rugam
								sa scanati QR code-ul alaturat si sa trimiteti un mesaj la adresa
								<u>sesizari.administrativ@e-uvt.ro</u>,cu subiectul: <b>Administrativ.</b></p><br>
								Probleme administrative ex.: banca rupta, scaun rupt, etc.<br><br>
								
								<b>Vor fi luate in considerare doar mesajele transmise de pe adresa de e-mail institutionala.</b><br><br>";
					$text3 = "<td>
								<p>
								Pentru sesizarea unei probleme tehnice in aceasta locatie,va rugam
								sa scanati QR code-ul alaturat si sa trimiteti un mesaj la adresa
								<u>sesizari.camine@e-uvt.ro</u>,cu subiectul: <b>Administrativ.</b></p><br>
								Probleme administrative ex.: bec ars,chiuveta defecta, etc. <br><br>
								
								<b>Vor fi luate in considerare doar mesajele transmise de pe adresa de e-mail institutionala.</b><br><br>";
					
					$i = $locatie.' '.$nr_sala.' '.$email1;
					$i2 = $locatie.' '.$nr_sala.' '.$email2;
					
					echo "<head>
							<title>QR GENERATOR BY ALEX</title>
							<style>
							td {
							height:218px;	
							}
							</style>
						  </head>";
					echo "<tr><td>";
					
					$length = $result->num_rows;
					$tempDir = EXAMPLE_TMP_SERVERPATH; 
					
					
					//build mail
					
					$codeContents = 'mailto:'.$email1.'?subject='.urlencode($subject1).'&body='.urlencode($body);
					$codeContents2 = 'mailto:'.$email2.'?subject='.urlencode($subject2).'&body='.urlencode($body);
					
					// generating
					//QRcode::png($cv, $tempDir.$i.'.png', QR_ECLEVEL_L, 6);
					
					QRcode::png($codeContents, $tempDir.$i.'.png', QR_ECLEVEL_L, 5);
					QRcode::png($codeContents2, $tempDir.$i2.'.png',QR_ECLEVEL_L, 5);
   
					// displaying
					echo '<img src="'.EXAMPLE_TMP_URLRELPATH .$i.'.png" />';
					
					
					
					echo "<br></td>";
					echo $text1;
					echo "<!--<b>ID:</b>".$id."<br>-->".
						 "<b>Locatie:</b> ".$locatie."<br>".
						 "<b>Sala:</b> ".$nr_sala."<br>".
						 "</td></tr>";
					
					echo "<tr><td>";
					echo '<img src="'.EXAMPLE_TMP_URLRELPATH .$i2.'.png" />';
					echo "<br></td>";
					echo $text2;
					echo "<!--<b>ID:</b>".$id."<br>-->".
						 "<b>Locatie:</b> ".$locatie."<br>".
						 "<b>Sala:</b> ".$nr_sala."<br>".
						 "</td></tr>";
    }
	echo "</table></center>";
	
	$result->free();
} else {
    echo "0 results";
}
$conn->close();
?>
