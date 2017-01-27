<br><br>
<div class="row">
<center><span class="fa fa-newspaper-o fa-3x">  Ultimele lucrări de licență adăugate</span></center>
</div>
<div id="lucrari" class="pad-section">
<div class="container">
	<!-- <div class="well"> WELL BEGIN -->
		<div class="row">
			<div class="col-xs-12"><br><br>
			<table class="table table-bordered table-responsive">
			<thead>
			<tr>
			<th>Titlu lucrare</th>
			<th>Descriere</th>
			<th>Prof.Coordonator</th>
			<th>Status</th>
			</tr>
			</thead>
			
			<tbody>
			<?php 
			$sql = "SELECT id, titlu, descriere,path,nume,prenume,data FROM files ORDER BY data DESC";
			
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
				 echo "<tr><td><a href='".$row["path"]."'target='_blank'>".$row["titlu"]. "</a></td><td>".$row["descriere"]."</td><td>".$row['nume']." ".$row['prenume']."</td></td><td>";
				 //echo "<div id='buton_tabel'><button onload='afisare_butoane_tabel(".$row["id"].")'>Test</button></div>";
				 
				$q = $row["id"];
				$q2 = $_SESSION["emailz"];
				
				$sql2 = "SELECT * FROM requests WHERE id_lucrare='$q' AND email_student= '$q2'";
				$result2 = $conn->query($sql2);
				//$conn->query($sql);
				
				if ($result2->num_rows > 0) {
				     // output data of each row
					$row2 = $result2->fetch_assoc();
					switch ($row2["status"]) {
					case 0:
					echo "<button type='button' class='btn btn-warning'>În așteptare</button>";
					break;
					case 1:
					echo "<a href='generare_pdf.php?q=".$row["id"]."'target='_blank'><button type='button' class='btn btn-success'>Aprobat</button>";
					break;
					case 2:
					echo "<button type='button' class='btn btn-danger'>Refuzat</button>";
					break;
					}
				} else {
						echo "<button type='button' class='btn btn-info'onClick='aplica_inregistrare(".$row["id"].")'>Aplică</button>";
				}
				 echo "</td></tr>";
			 }
		} else {
			 echo "<tr><td>0 results</tr></td>";
		}

		//$conn->close();
?>  
			
			</tbody>
			</table>
		<!--<button type="button" class="btn btn-default">Incarca mai multe...</button><br>-->
			<!--<center>
			<ul class="pagination">
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
		    </ul>
			</center>-->
			
			</div><br>
		</div>
	<!--</div> WELL END-->
	<br><br><br><br><br><br><br><br><br>
</div>

<?php 


/*if(whatIS() == "Profesor"){*/
include('profile.php');
/*}*/

?>
<div class="pad-section"id="ajutor">
<div class="container">
<div class="row">
<div class="well">
<center><span class="fa fa-info-circle fa-3x">  AJUTOR</span></center>
<br><br><br><br><br><b>
<p>1.) Pentru a aplica la o lucrare de licență, dați click pe butonul LUCRĂRI din bara de meniu.</p>
<img class="img-responsive img-thumbnail"src="/img/bara_meniu.PNG"/><br><br>
<p>2.) Selectați o tema de licență din tabel, și apăsați butonul Aplică. </p><br>
<img class="img-responsive img-thumbnail"src="/img/buton_aplica.PNG"/><br><br>
<p>3.) În acest moment sunteți pus in așteptare, un email de notificare a fost trimis către profesorul coordonator.</p><br>
<img class="img-responsive img-thumbnail"src="/img/in_asteptare.PNG"/><br><br>
<p>4.) Dacă ați fost acceptat, butonul se va face verde si veți putea descărca cererea pentru tema de licență care este generată, in mod automat.</p>
<img class="img-responsive img-thumbnail"src="/img/descarca_cerere.PNG"/><br>
</b></div>
</div>
</div>

</div>