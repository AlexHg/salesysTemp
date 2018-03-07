<?php
class PriceData {
	public static $tablename = "product_price";

	public function PriceData(){
		$this->product_id = NULL;
		$this->price = "";
		$this->quantity = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (product_id, price, quantity) ";
		$sql .= "value ($this->product_id,\"$this->price\",\"$this->quantity\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set price=\"$this->price\",quantity=\"$this->quantity\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PriceData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PriceData());
	}

}

?>