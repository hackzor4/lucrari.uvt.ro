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
	
	
	tr.one {
		border-top: 5px solid #EBEDEA;
	    border-bottom: 5px dashed #25AAE2;
	}
	
	tr.two {
		border-bottom: 10px solid #25AAE2;
	}
	
	div{
	
		background-color:#25AAE2;
		width:1438px;
	}
	
	.invi {
		background-color:white;
		border:none;
	}
	
	}</style>";
	$j = 0;
	$increment_power = 0;
	
    while($row = $result->fetch_assoc()) {
					
					$id = $row["id"];
					$locatie = $row["locatie"];
					$nr_sala = $row["nr_sala"];
					
					
					$email1 = 'sesizari.tehnic@e-uvt.ro';
					$email2 = 'sesizari.administrativ@e-uvt.ro';
					$email3 = 'sesizari.camine@e-uvt.ro';
					
					$subject1 = 'Tehnic '.$locatie.' Sala: '.$nr_sala;
					$subject2 = 'Administrativ '.$locatie.' Sala: '.$nr_sala;
					
					$body; 
					
					
					$text1 = "<td><br><br><br>
								<p>
								Pentru sesizarea unei probleme tehnice in aceasta locatie,va rugam
								sa trimiteti un mesaj la adresa
								<u>sesizari.tehnic@e-uvt.ro</u>,cu subiectul: <b>Tehnic.</b><br>Pentru operativitate, puteti scana QR-codul alaturat.</p><br>
								Probleme tehnice: nefunctionare echipamente IT(calculatoare,videoproiectoare,imprimante,multifunctionale,camere video,
								echipamente de videoconferinta),retea wifi, retea internet, etc.
								
								<b>Vor fi luate in considerare doar mesajele transmise de pe adresa de e-mail institutionala.</b><br><br>";
					$text2 = "<td><br><br><br>
								<p>
								Pentru sesizarea unei probleme administrative in aceasta locatie,va rugam
								sa trimiteti un mesaj la adresa <u>sesizari.administrativ@e-uvt.ro</u>,cu subiectul: <b>Administrativ.</b>
								<br>Pentru operativitate, puteti scana QR-codul alaturat.</p><br>
								Probleme administrative ex.: banca rupta, scaun rupt, etc.
								
								<b>Vor fi luate in considerare doar mesajele transmise de pe adresa de e-mail institutionala.</b><br><br>";
					$text3 = "<td>
								<p>
								Pentru sesizarea unei probleme tehnice in aceasta locatie,va rugam
								sa scanati QR code-ul alaturat si sa trimiteti un mesaj la adresa
								<u>sesizari.camine@e-uvt.ro</u>,cu subiectul: <b>Administrativ.</b></p><br>
								Probleme administrative ex.: bec ars,chiuveta defecta, etc. <br><br>
								
								<b>Vor fi luate in considerare doar mesajele transmise de pe adresa de e-mail institutionala.</b><br><br>";
					$img1 = "<img src='img/Fluturasi QR - final-08.jpg'style='width:200px;height:100px;display:inline;float:right;'/>";
					$img2 = "<img src='img/Fluturasi QR - final-09.jpg'style='width:200px;height:100px;display:inline;float:right;'/>";
					
					$i = $locatie.' '.$nr_sala.' '.$email1;
					$i2 = $locatie.' '.$nr_sala.' '.$email2;
					
				
					
					$length = $result->num_rows;
					$tempDir = EXAMPLE_TMP_SERVERPATH; 
					
					
					//build mail
					
					$codeContents = 'mailto:'.$email1.'?subject='.urlencode($subject1).'&body='.urlencode($body);
					$codeContents2 = 'mailto:'.$email2.'?subject='.urlencode($subject2).'&body='.urlencode($body);
					
					// generating
					//QRcode::png($cv, $tempDir.$i.'.png', QR_ECLEVEL_L, 6);
					
					QRcode::png($codeContents, $tempDir.$i.'.png', QR_ECLEVEL_L, 5);
					QRcode::png($codeContents2, $tempDir.$i2.'.png',QR_ECLEVEL_L, 4.5);
   
					// displaying
					//echo "<div class='invi' style='height:30px;width:10px;'></div>";
					echo "<center><table>";
					//echo "<div style='height:10px;'></div>";
					echo "<div>";
					echo "<b>LOCATIE: "."<p style='color:white;display:inline;'>".$locatie."&nbsp&nbsp  "."</p>SALA: "."<p style='color:white;display:inline;'>".$nr_sala."</b></p>"."&nbsp&nbsp";
					echo "<div>";
					echo "<tr class='one'><td>";
					echo '<img src="'.EXAMPLE_TMP_URLRELPATH .$i.'.png" />';
					
					
					
					echo "<br></td>";
					echo $text1;
					echo $img1;
					/*echo "<!--<b>ID:</b>".$id."<br>-->".
						 "<b>Locatie:</b> ".$locatie."<br>".
						 "<b>Sala:</b> ".$nr_sala."<br>".*/
					echo "</td></tr>";
					
					echo "<tr class='two'><td>";
					echo '<img src="'.EXAMPLE_TMP_URLRELPATH .$i2.'.png" />';
					echo "<br></td>";
					echo $text2;
					echo $img2;
					echo "</td></tr>";
					echo "</table></center>";
					$increment_power = $increment_power + 1;
					if(($increment_power % 2) != 0){
					echo "<div class='invi'style='height:250px;width:20px;'></div>";
					}
					else{
						echo "<div class='invi' style='height:120px;width:10px;'></div>";
					}
					
    }
	
	
	$result->free();
} else {
    echo "0 results";
}
$conn->close();
?>

