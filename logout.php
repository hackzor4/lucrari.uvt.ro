<?php 
session_start();
 require_once("aai/lib/_autoload.php");
 require_once("aai/config/authsources.php");
 
 $auth = new SimpleSAML_Auth_Simple('default-sp');
 $auth->logout('https://login.e-uvt.ro/aai/module.php/core/loginuserpassorg.php?AuthState=_4b5f7e868834f600492670b4787d38b2483ad20f47%3Ahttps%3A%2F%2Flogin.e-uvt.ro%2Faai%2Fsaml2%2Fidp%2FSSOService.php%3Fspentityid%3Dhttps%253A%252F%252Fwww.intranet.uvt.ro%252Faai%252Fmodule.php%252Fsaml%252Fsp%252Fmetadata.php%252Fdefault-sp%26cookieTime%3D1456392573%26RelayState%3Dhttps%253A%252F%252Fwww.intranet.uvt.ro%252F');

?>
