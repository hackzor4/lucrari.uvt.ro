<?php
session_start();
include_once 'dbconfig.php';
if(isset($_POST['btn-upload']))
{    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 
 $nume = $_SESSION["nume"];
 $prenume = $_SESSION["prenume"];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 $titlu = $_POST['titlu'];
 $descriere = $_POST['descriere'];
 
 
 
 // noua dimensiune a fisierului in KB
 $new_size = $file_size/1024;  
 // new file size in KB
 
 // face numele fisierului lowercase
 $new_file_name = strtolower($file);
 // make file name in lower case
 
 $final_file=str_replace(' ','-',$new_file_name);
 $path = "/".$folder.$final_file;
 $_SESSION["path"] = $path;
 $email = $_SESSION['emailz'];
 $data =  date('Y-m-d H:i:s');
 
 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
  $sql="INSERT INTO files(nume,prenume,file,type,size,path,titlu,descriere,email,data) VALUES('$nume','$prenume','$final_file','$file_type','$new_size','$path','$titlu','$descriere','$email','$data')";
  $conn->query($sql);
  ?>
  <script>
  alert('Fisierul uploadat cu succes');
        window.location.href='index.php#profil';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('Eroare la uploadarea fisierului');
        window.location.href='index.php#profil';
        </script>
  <?php
 }
}
?>