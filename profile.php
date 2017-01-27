<br><br>
<div id="profil"class="row pad-selection"style="background-color:#306d9f;">
<center><h1><span class="fa fa-terminal fa-2x">PROFIL</span></h1></center>

<div class="container"style="background-color:#306d9f;">
<div class="well">
<div class="row">
<div class="col-sm-6"style="border-right:2px solid #306d9f;">
<center><h2>Încărcare lucrare de licență</h2></center>
<br><br>
<div id="body">
 <center><form action="upload.php" method="post" enctype="multipart/form-data">
 <h3>Titlul lucrării:</h3><input type="text"name="titlu"size="37"/><br>
 <h3>Descriere:</h3><textarea rows="4" cols="39"name="descriere">
O mica descriere a lucrării de licență.</textarea><br><br>
 <input class="btn btn-primary"type="file" name="file" /><br>
 <center><button class="btn btn-default"type="submit" name="btn-upload">ÎNCĂRCARE</button></center>
 </form></center>
    <br /><br />
    <?php
 if(isset($_GET['success']))
 {
  ?>
        <center><label>Fișierul încărcat cu succes pe server <a href="<?php echo $_SESSION["path"]?>"target="_blank">click aici pentru a vizualiza.</a></label></center>
        <?php
 }
 else if(isset($_GET['fail']))
 {
  ?>
        <center><label>Problemă la incărcarea fișierului</label></center>
        <?php
 }
 else
 {
  ?>
        <?php
 }
 ?>
 <div class="update">
 <center><form action="upload.php" method="post" enctype="multipart/form-data">
 <h3>Titlul lucrări:</h3><input type="text"name="titlu"size="37"/><br>
 <h3>Descriere:</h3><textarea rows="4" cols="39"name="descriere">
O mica descriere a lucrării de licență.</textarea><br><br>
 <center><button class="btn btn-default"type="submit" name="btn-upload">ÎNCĂRCARE</button></center>
 </form></center>
 </div>
</div>
</div>
<div class="col-sm-6">
<center><h2>Lucrări de licență încărcate </h2></center><br>
<div class="tabel">
<table class="table table-hover">
		<!--<thead>
		<tr>
		<th>ID</th>
		<th>Denumire lucrare</th>
		<th>Editează</th>
		<th>Șterge</th>
		</tr>
		</thead>-->
	<tbody>
	<?php 
			$ids = array();
			$titlu_lucrare = array();
			
			$sql = "SELECT id, titlu, descriere,path FROM files WHERE email = '$email'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
				 $ids[] = $row["id"];
				 $titlu_lucrare = $row["titlu"];
				 
				 echo "<tr><td>" . $row["id"]. "</td><td><a href='".$row["path"]."'target='_blank'>" . $row["titlu"]. "</a></td><td><button type='button' class='btn btn-info'onClick='select_inregistrare(".$row["id"].")'>Editează</button></td>". "<td><button type='button' class='btn btn-danger'id='sterge".$row["id"]."'onClick='sterge_inregistrare(".$row["id"].")'>Șterge</button></td></tr>";
			 }
		} else {
			 echo "<tr><td><b>Aveți 0 lucrări încărcate.</b></tr></td>";
		}

		
?>  
	</tbody>
</table>
</div>
<div id="demo"></div>
</div>
</div>
</div>
<div class="well">
<div class="row">
<div class="col-sm-12"">
<center><h2>Studenți care au aplicat</h2></center>
<br><br><br>
<table class="table table-hover">
<tbody>
<?php

/* Start Studenti care au aplicat */


$ids = join(', ', $ids);
$sql2 = "SELECT * FROM requests,files WHERE id_lucrare IN ($ids) AND requests.id_lucrare = files.id";
$result2 = $conn->query($sql2);


		if ($result2->num_rows > 0) {
			 // output data of each row
			 while($row2 = $result2->fetch_assoc()) {
				 switch($row2['status']){
					 case 1:
					 echo "<tr><td>" . $row2["id_lucrare"]. "</td><td><a href='".$row2["path"]."'target='_blank'>" .$row2["titlu"]. "</a></td><td>".$row2["nume_student"]." ".$row2["prenume_student"]."</td><td><b style='color:green;'>Aprobat</b></td>". "<td></td></tr>";
					 break;
					 case 2:
					 echo "<tr><td>" . $row2["id_lucrare"]. "</td><td><a href='".$row2["path"]."'target='_blank'>" .$row2["titlu"]. "</a></td><td>".$row2["nume_student"]." ".$row2["prenume_student"]."</td><td><b style='color:red;'>Refuzat</b></td>". "<td></td></tr>";
					 break;
					 default:
					 echo "<tr><td>" . $row2["id_lucrare"]. "</td><td><a href='".$row2["path"]."'target='_blank'>" .$row2["titlu"]. "</a></td><td>".$row2["nume_student"]." ".$row2["prenume_student"]."</td><td><button type='button' class='btn btn-success'onClick='aproba_inregistrare(".$row2["id_r"].")'>Aprobă</button></td>". "<td><button type='button' class='btn btn-danger'id='sterge".$row2["id_r"]."'onClick='refuza_inregistrare(".$row2["id_r"].")'>Refuză</button></td></tr>";
					 break;
				 }
				 
			 }
		} else {
			 echo "<tr><td><b>Aveți 0 aplicări.</b></tr></td>";
		}

		$conn->close();




/* end of studenti care au aplicat */

?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>



