<?php

if(!isset($_SESSION["reabastecer"])){


	$product = array("product_id"=>$_POST["product_id"],"q"=>$_POST["q"],"localid"=>$_POST['local_id']);

	$_SESSION["reabastecer"] = array($product);


	$cart = $_SESSION["reabastecer"];

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

$process=true;


}else {

$found = false;
$cart = $_SESSION["reabastecer"];
$index=0;

$q = OperationData::getQYesF($_POST["product_id"]);





$can = true;

?>

<?php
if($can==true){
foreach($cart as $c){
	if($c["product_id"]==$_POST["product_id"] && $c["localid"] == $_POST['local_id']){
		echo "found";
		$found=true;
		break;
	}
	$index++;
//	print_r($c);
//	print "<br>";
}

if($found==true){
	$q1 = $cart[$index]["q"];
	$q2 = $_POST["q"];
	$cart[$index]["q"]=$q1+$q2;
	$_SESSION["reabastecer"] = $cart;
}

if($found==false){
    $nc = count($cart);
	$product = array("product_id"=>$_POST["product_id"],"q"=>$_POST["q"],"localid"=>$_POST['local_id']);
	$cart[$nc] = $product;
//	print_r($cart);
	$_SESSION["reabastecer"] = $cart;
}

}
}
print "<script>window.location='index.php?view=re';</script>";
// unset($_SESSION["reabastecer"]);

?>