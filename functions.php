<?php
	include_once 'dbconfig.php';
	function whatIS(){
		global $isStudent,$isTeacher,$isStaff;
		if($isStudent == 1 && $isTeacher == 0){
			return "Student";
		}
		else if($isTeacher == 1 && $isStudent == 0){
			return "Profesor";
		}
		else if($isStaff == 1){
			return "Staff";
		}
	}
	
	


	function GetButtonCode($url,$name,$descDiv){
		return "<div class='col-md-3 col-sm-4 col-xs-6' >
                          <a href='".$url."' target='_blank'onmouseover='show(\"".$descDiv."\")'>
                        	  <button class='button btn-primary iaButton'>".$name."</button>
			  </a>
                         </div>";
	}

	function generateButtons(){
		global $items;
		$length = count($items);
		$tokens = array("urn:mace:uvt.ro:euvt:user",      //0
						"urn:mace:uvt.ro:euvt:student",   //1 student
						"urn:mace:uvt.ro:euvt:staff",     //2 staff
						"urn:mace:uvt.ro:euvt:teacher",   //3 teacher
						"urn:mace:uvt.ro:dreamspark:feaa",//4
						"urn:mace:uvt.ro:dreamspark:cs",  //5
						"urn:mace:roedu.net:anelis:user", //6
						"urn:mace:uvt.ro:euvt:external",  //7
						"urn:mace:uvt.ro:ums:student",    //8
						"urn:mace:uvt.ro:ums:admin",      //9
						"urn:mace:uvt.ro:depami:manager", //10
						"urn:mace:uvt.ro:euvt:ph-admin"); //11
						
		if (in_array($tokens[0], $items))
		{
			echo GetButtonCode('http://mail.e-uvt.ro',"E-Mail","divmail");
			echo GetButtonCode('http://dreamspark.e-uvt.ro/dreamspark/',"Dreamspark","divdreamspark");
			echo GetButtonCode('http://lists.e-uvt.ro/',"Liste e-mail","divlists");
			echo GetButtonCode('http://dict.uvt.ro/telefoane-interioare/interioare.php',"Contacte UVT","divinterioare");
			echo GetButtonCode('https://docs.google.com/a/e-uvt.ro/forms/d/1hKXX4-3vIvUqnxds2-9z4rOq8eKH4owu-2rpkTXRxrY/viewform',"Propuneri","divsugestii");
			
		}

		if (in_array($tokens[1], $items) or in_array($tokens[3],$items))
		{
			echo GetButtonCode('http://elearning.e-uvt.ro/',"E-Learning","divelearning");
		}

		if (in_array($tokens[6], $items))
		{
			echo GetButtonCode('https://portal.anelisplus.ro/',"ANELIS","divanelis");
		}
		if (in_array($tokens[1], $items))
		{
			echo GetButtonCode('https://www.studentweb.uvt.ro/ums/do/secure/inregistrare_user',"StudentWeb","divstudentweb");
		}
		if (in_array($tokens[11], $items))
		{
			//echo GetButtonCode('http://ph.uvt.ro/',"App poze","divph");
		}
		if (in_array($tokens[10], $items))
		{
			echo GetButtonCode('http://depami.uvt.ro/',"Depami App","divdreamspark");
		}
		
		
	}
	
	function generateText(){
		global $pieces,$an_studiu;
		if(whatIS() == 'Student'){
		echo "Nume: <b>".$_SESSION["nume"]." ".$_SESSION["prenume"]."</b><br>
			Email:<b>".$_SESSION["email"]."</b><br>".
			"Facultatea: <b>".$pieces[0]."</b><br>".
			"Tip studii: <b>".$pieces[1]."</b><br>".
			"Domeniu: <b>".$pieces[2]."</b><br>".
			"An curent: <b>".$pieces[5]."</b><br>".
			"Semestru: <b>".$pieces[6]."</b><br>".
			"An studiu: <b>".$an_studiu."</b><br><br>";
		}else{
			echo  "Nume: <b>".$_SESSION["nume"]." ".$_SESSION["prenume"]."</b><br>
				   Email:<b>".$_SESSION["email"]."</b><br>".
				   "Facultatea: <b>".$pieces[0]."</b><br>";
		}
	}

	function buttonFacultati(){
		$urls = array("http://www.arte.uvt.ro/",   //0
					   "http://www.cbg.uvt.ro/",    //1
					   "http://www.drept.uvt.ro/",  //2
					   "http://www.feaa.uvt.ro/",   //3
					   "http://www.sport.uvt.ro/",  //4
					   "http://www.physics.uvt.ro/",//5
					   "http://www.litere.uvt.ro/", //6
					   "http://www.math.uvt.ro/",   //7
					   "http://www.muzica.uvt.ro/", //8
					   "http://www.socio.uvt.ro/",  //9
					   "http://www.pfc.uvt.ro/");   //10
		
		$facultati = array("Facultatea de Arte și Design",                                              //0
						   "Facultatea de Chimie, Biologie, Geografie",                                 //1
						   "Facultatea de Drept",                                                       //2
						   "Facultatea de Economie și de Administrare a Afacerilor",                    //3
						   "Facultatea de Educaţie Fizică şi Sport",                                    //4
						   "Facultatea de Fizică",                                                      //5 
						   "Facultatea de Litere, Istorie şi Teologie",                                 //6
						   "Facultatea de Matematică şi Informatică",                                   //7
						   "Facultatea de Muzică si Teatru",                                            //8
						   "Facultatea de Sociologie şi Psihologie",                                    //9
						   "Facultatea de Ştiinţe Politice, Filosofie şi Ştiinţe ale Comunicării");     //10
						   
		$acronime = array("ARTE",   //0
						  "CBG",    //1
						  "DREPT",  //2
						  "FEAA",   //3
						  "SPORT",  //4
						  "PHYSICS",//5
						  "LITERE", //6
						  "MATH",   //7
						  "MUZICA", //8
						  "SOCIO",  //9
						  "PFC");   //10
		
		global $pieces;
		$key = array_search($pieces[0],$facultati);
		
		echo "
			  <div class='col-md-3 col-sm-4 col-xs-6' >
		      <a href='".$urls[$key]."'target='_blank'>
			  <button class='button btn-primary iaButton' style='vertical-align:left'>Site<br>".$acronime[$key]."</button></a> 
			  </div>";
	}
	

















?>
