<!-- <html><meta http-equiv="refresh" content="300;url=logout.php"/></html> -->
<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(!isset($_SESSION["sess_user"])){	
	// NO SESSION
	header('Location:index.php');
}
else{
	// WITH SESSION
	$user = $_SESSION['sess_user'];
	$getUserInfo = $dbConn->query("SELECT * FROM tbl_user WHERE INFO_USERNAME='$user'");
	$rowUserInfo = mysqli_fetch_assoc($getUserInfo);
	// $agency = $rowUserInfo['INFO_AGENCY'];
	$userid = $rowUserInfo['USERID'];
	// $office = $rowUserInfo['INFO_OFFICE'];
	$accesslvl = $rowUserInfo['INFO_ACCESSLEVEL'];
	date_default_timezone_set('Asia/Hong_Kong');
    $datestat = date('m/d/y h:i:s A');
}
?>

<!-- content="300;url=logout.php"  -->