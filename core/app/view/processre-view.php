<?php
if(isset($_SESSION["reabastecer"])){
	$cart = $_SESSION["reabastecer"];
	if(count($cart)>0){

$process = true;









//////////////////////////////////
		if($process==true){
			$sell = new SellData();
			$sell->user_id = $_SESSION["user_id"];
			$sell->local_id = $_SESSION["local_id"];
			 if(isset($_POST["client_id"]) && $_POST["client_id"]!=""){
			 	$sell->person_id=$_POST["client_id"];
 				$s = $sell->add_re_with_client();
			 }else{
 				$s = $sell->add_re();
			 }


		foreach($cart as  $c){


			$op = new OperationData();
			 $op->product_id = $c["product_id"] ;
			 $op->operation_type_id=1; // 1 - entrada
			 $op->sell_id=$s[1];
			 $op->q= $c["q"];
			 $op->local_id = $c["localid"];

			if(isset($_POST["is_oficial"])){
				$op->is_oficial = 1;
			}

			$add = $op->add();			 		

		}
			unset($_SESSION["reabastecer"]);
			setcookie("selled","selled");
////////////////////
print "<script>window.location='index.php?view=onere&id=$s[1]';</script>";
		}
	}
}



?>
