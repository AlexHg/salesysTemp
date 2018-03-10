<div class="row">
	<div class="col-md-12">
		<h1><i class='glyphicon glyphicon-shopping-cart'></i> Lista de Ventas</h1>
		<div class="clearfix"></div>


<?php

if($_SESSION['local_id'] != 0)
	$products = SellData::getSellsByLocalId($_SESSION['local_id']);
else
	$products = SellData::getSells();

if(count($products)>0){

	?>
<br>
<table class="table table-bordered table-hover	">
	<thead>
		<th></th>
		<th>Producto</th>
		<th>Total</th>
		<th>Fecha</th>
		<?php if($_SESSION['local_id'] == 0): ?>
			<th>local</th>
		<?php endif; ?>
		<th></th>
	</thead>
	<?php foreach($products as $sell):?>

	<tr>
		<td style="width:30px;">
		<a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>

		<td>

<?php
$operations = OperationData::getAllProductsBySellId($sell->id);
echo count($operations);
?>
		<td>

<?php
$total= $sell->total-$sell->discount;
	/*foreach($operations as $operation){
		$product  = $operation->getProduct();
		$total += $operation->q*$product->price_out;
	}*/
		echo "<b>$ ".number_format($total)."</b>";

?>			

		</td>
		<td><?php echo $sell->created_at; ?></td>
		<?php if($_SESSION['local_id'] == 0): ?>
			<td><?php echo LocalData::getById($sell->local_id)->name; ?></td>
		<?php endif; ?>
		<td style="width:30px;"><a href="index.php?view=delsell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td>
	</tr>

<?php endforeach; ?>

</table>

<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay ventas</h2>
		<p>No se ha realizado ninguna venta.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>