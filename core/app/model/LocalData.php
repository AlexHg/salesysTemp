<?php
class LocalData {
	public static $tablename = "local";

	public function LocalData(){
		$this->name = "";
		$this->address = "";
		$this->phone1 = "";
		$this->phone2 = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name, address, phone1, phone2) ";
		$sql .= "value (\"$this->name\",\"$this->address\",\"$this->phone1\",\"$this->phone2\")";
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
		$sql = "update ".self::$tablename." set name=\"$this->name\",address=\"$this->address\",phone1=\"$this->phone1\",phone2=\"$this->phone2\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new LocalData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where id <> 0";
		$query = Executor::doit($sql);
		return Model::many($query[0],new LocalData());
	}



	public static function getCount(){
		$sql = "select count(*) as i from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new LocalData());
	}

}

?>