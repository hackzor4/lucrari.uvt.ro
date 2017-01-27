<?php
include_once 'dbconfig.php';


$id = $_POST['id'];
$titlu = $_POST['titlu'];
$descriere = $_POST['descriere'];

$sql = "UPDATE files SET titlu='$titlu',descriere='$descriere' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Inregistrare updatata.');</script>";
} else {
    echo "<script>alert('Eroare.');</script>" . $conn->error;
}

$conn->close();
header('Location: index.php#profil ');
?>