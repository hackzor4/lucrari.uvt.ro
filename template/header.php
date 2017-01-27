<?php 

session_start();
    require_once("aai/lib/_autoload.php");
	require_once("functions.php");
   
      $as = new SimpleSAML_Auth_Simple('default-sp');
      $as->requireAuth();

	  $isStudent = 0;
	  $isTeacher = 0;
	  $isStaff = 0;
	  
	  $whatIS = 0;
	  $studentID;
	  $email;
	  
	  $items = array();
	
	  
      $attributes = $as->getAttributes();
	  $string;
	  
      if(isset($attributes["eduPersonEntitlement"])){
        foreach($attributes["eduPersonEntitlement"] as $right){
            if($right == "urn:mace:uvt.ro:euvt:student"){
				global $isStudent;
                $isStudent = 1;
			}
			else if($right == "urn:mace:uvt.ro:euvt:teacher"){
				global $isTeacher;
				$isTeacher = 1;
			}
			else if($right == "urn:mace:uvt.ro:euvt:staff"){
				global $isStaff;
				$isStaff = 1;
			}
		$items[] = $right;
      }
	 }
	 
    if(isset($attributes["eduPersonPrincipalName"])){
	$email = $attributes["eduPersonPrincipalName"][0];
	$_SESSION["nume"] = $attributes["givenName"][0];
        $_SESSION["prenume"] = $attributes["sn"][0];
        $string = $attributes["uvtCurrentEnrollmentInfo"][0];  //enrollment
		$an_studiu = $attributes["uvtCurrentStudyYear"][0];
     }
	 
	 if(isset($attributes["uvtStudentID"])){
		 $studentID = $attributes["uvtStudentID"][0];
	 }
  
    $_SESSION["approveAdmin"] = false;
    if(isset($attributes["eduPersonEntitlement"])){
        foreach($attributes["eduPersonEntitlement"] as $ent){
	   if($ent == "urn:mace:uvt.ro:euvt:ph-admin"){
            $_SESSION["approveAdmin"] = true;
	    break;
	   }
        }
    }
	$pieces = explode("|",$string);
$_SESSION["emailz"] = $email;
$_SESSION["an_facultate"] = $pieces[5];
$_SESSION["sectie_facultate"] = $pieces[3];

?>
<!DOCTYPE html>
<html>
<head>
<title>Teme de licență</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">


<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script type="text/javascript" src="/aai/resources/script.js"></script>
<link rel="stylesheet" href="/css/alex-style.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery-2.2.4.min.js"></script>
<style>

/* Modificari design tematica */
body {
  background-color: #F3F3F3 ; /* otehr #F0FBFB */
}


</style>

<!--<META HTTP-EQUIV="refresh" CONTENT="5">-->
</head>
<body>
	<!-- Meniu -->
	<div class="container">
	</div>
	<div class="container">
		<nav class="navbar navbar-default navbar-fixed-top">
 		<div class="container-fluid">
    	<div class="navbar-header">
    		<!-- Buton de mobil -->
    		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!--Logo UVT -->
		<div style="color:#777777;"><br>
      	<!--<a class="navbar-brand" href="#"><img class="img-responsive" style="max-width:150px; margin-top: -5px;" src="img/mini-logo.png"></a>-->
		&nbsp <span class="fa fa-graduation-cap fa-lg"><b><?php echo "&nbsp ".$_SESSION["nume"]." ".$_SESSION["prenume"]?></b></span><br>
		&nbsp <span class="fa fa-hand-o-right fa-lg"> &nbsp <b><?php echo "  ".whatIS();?></b></span><br>
		&nbsp <span class= "fa fa-university fa-lg"> &nbsp <b><?php echo "  ".$pieces[0];?></b></span></div><br>
    	</div>
    	<div id="navbarCollapse" class="collapse navbar-collapse">
    	<ul class="nav navbar-nav navbar-right">
      	<li><a href="index.php"><span class="fa fa-home fa-2x"><b>ACASĂ</b></span></a></li>
		<li><a href="#lucrari"><span class="fa fa-files-o fa-2x"><b>LUCRĂRI</b></span></a></li>
		<li><a href="#profil"><span class="fa fa-user fa-2x"><b>PROFIL</b></span></a></li>
      	<li><a href="#ajutor"><span class="fa fa-info-circle fa-2x"><b>AJUTOR</b></span></a></li>
		<li><a href="logout.php"><span class="fa fa-sign-out fa-2x"><b>IEȘIRE</span></b></a></li>
    	</ul></b>
    	<ul class="nav navbar-nav navbar-right">
      	<!--<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Language
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">English</a></li>
          <li><a href="#">Deutsch</a></li>
          <li><a href="#">Espanol</a></li> 
        </ul>
      </li>-->
    </ul>
</div>
</div>
</nav>
<!-- Below -->
<!--Avertisment -->
</div>
<div id="acasa" class="home">
  <div class="text-vcenter">
	<h1>Teme de licență</h1>
	<h3><span style="background-color:white;">Pentru o experiență mai plăcută, <br> recomandăm userilor care vizualizează site-ul de pe un dispozitiv cu ecranul <5" <br> să îl intoarcă pe orizontală. </span></h3>
	<a href="#lucrari" class="btn btn-default btn-lg">Continuă</a>
	</div>
</div>

