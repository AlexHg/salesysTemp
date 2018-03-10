<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if(!isset($_SESSION["user_id"])) {
$user = $_POST['username'];
$pass = sha1(md5($_POST['password']));

$base = new Database();
$con = $base->connect();
 $sql = "select * from user where (email= \"".$user."\" or username= \"".$user."\") and password= \"".$pass."\" and is_active=1";
 
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
$localid=null;
$localname="";
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
	$localid = $r['local_id'];
}

$sql2 = "select * from local where id=".$localid;
echo $sql2;
$query2 = $con->query($sql2);
$r2 = $query2->fetch_array();

$localname =$r2["name"];

if($found==true) {
//	session_start();
//	print $userid;
	$_SESSION['user_id']=$userid ;
	$_SESSION['local_id']=$localid ;
	$_SESSION['local_name']=$localname;
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];

	print "Cargando ... $user";
	print "<script>window.location='index.php?view=home';</script>";
}else {
	print "<script>window.location='index.php?view=login';</script>";
}

}else{
	print "<script>window.location='index.php?view=home';</script>";
	
}
?>