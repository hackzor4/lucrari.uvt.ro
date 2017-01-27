<?php
session_start();
include_once 'dbconfig.php';
require_once('tcpdf/examples/tcpdf_include.php');
//require_once('fpdf/fpdf.php');




$id_r = $_GET["q"];



$sql = "SELECT * FROM requests,files WHERE id_lucrare = '$id_r' AND requests.id_lucrare = files.id";
$result = $conn->query($sql);
//$conn->query($sql);


 if ($result->num_rows > 0) {
			 // output data of each row
			 $row = $result->fetch_assoc();
			 
			 $nume_coordonator = $row["nume"];
			 $prenume_coordonator = $row["prenume"];
			 $nume_student = $row["nume_student"];
			 $prenume_student = $row["prenume_student"];
			 $titlu_lucrare = $row["titlu"];
			 
										 //echo $titlu_lucrare."<br>".$nume_coordonator." ".$prenume_coordonator." <br><br>".$nume_student." ".$prenume_student;
		
			 
			 
		} else {
			 echo "fail";
		} 


$conn->close();


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'ANSI', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alexandru Ianas');
$pdf->SetTitle('Cerere');
$pdf->SetSubject('Cerere Licenta');
$pdf->SetKeywords('Cerere UVT Licenta');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/ron.php')) {
    require_once(dirname(__FILE__).'/lang/ron.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', 'BI', 13);

// add a page
$pdf->AddPage();

// set some text to print
$txt = "
<br><br><br>
<p align='right'>Acordul conducerii facultății:</p><br>
						  ..............................<br><br><br><br>
Către Facultatea de Matematică și Informatică,<br><br>
<p>Subsemnatul ".$_SESSION["nume"]." ".$_SESSION["prenume"]." student in anul ".$_SESSION["an_facultate"]." secția ".$_SESSION["sectie_facultate"]."
vă rog să-mi aprobați elaborarea lucrării de licență / disertație cu titlul: ".$titlu_lucrare."
sub conducerea prof. coordonator ".$nume_coordonator." ".$prenume_coordonator."

<br><br><br>

<span>Data: ....................   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Semnătura:.................</span><br><br><br>
Acordul cadrului didactic coordonator<br>
............................................................. (semnătura)









";

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML($txt, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+





?>