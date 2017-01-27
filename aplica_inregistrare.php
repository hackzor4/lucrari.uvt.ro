<?php
session_start();
include_once 'dbconfig.php';
require 'phpmailer/PHPMailerAutoload.php';


$id_lucrare = $_GET["q"];
$nume_student = $_SESSION["nume"];
$prenume_student = $_SESSION["prenume"];
$email = $_SESSION["emailz"];


$sql = "INSERT INTO requests(id_lucrare, nume_student, prenume_student, email_student) VALUES('$id_lucrare','$nume_student','$prenume_student','$email')";
$result = $conn->query($sql);
//$conn->query($sql);
 

if ($result->num_rows > 0) {
			 // output data of each row
			 echo "works";
		} else {
			 echo "<button type='button' class='btn btn-info'onClick='aplica_inregistrare(".$row["id"].")'>Aplica</button>";
		}
		
$sql2 = "SELECT * FROM files WHERE id='$id_lucrare'";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$email_profesor = $row2["email"];
$titlu_lucrare = $row2["titlu"];


$conn->close();


$mail = new PHPMailer;
$mail->setLanguage('ro', 'phpmailer/language/phpmailer.lang-ro.php');

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'noreply@e-uvt.ro';                 // SMTP username
$mail->Password = 'mdaixylvfnrfitnl';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('noreply@e-uvt.ro', 'Lucrari.uvt.ro');

$mail->addAddress($email_profesor);               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $nume_student." ".$prenume_student." a aplicat la o lucrare de licenta.";
$mail->Body    = "
<img src='http://lucrari.uvt.ro/img/mailheader.PNG'/><br><br><h3>
".$nume_student." ".$prenume_student." a aplicat la lucrarea de licență cu titlul: ".$titlu_lucrare.".<h3><br>
<h4>Pentru a aproba cererea dați click pe următorul link <a href='http://lucrari.uvt.ro/#profil'target='_blank'>http://lucrari.uvt.ro/#profil</a> </h4>";
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>