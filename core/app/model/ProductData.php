<?php
class ProductData {
	public static $tablename = "product";

	public function ProductData(){
		$this->name = "";
		$this->unit = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}

	public function getCategory(){ return CategoryData::getById($this->category_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,description,user_id,unit,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->description\",$this->user_id,\"$this->unit\",NOW())";
		return Executor::doit($sql);
	}
	public function add_with_image(){
		$sql = "insert into ".self::$tablename." (barcode,image,name,description,price_in,price_out,user_id,presentation,unit,category_id,inventary_min) ";
		$sql .= "value (\"$this->barcode\",\"$this->image\",\"$this->name\",\"$this->description\",\"$this->price_in\",\"$this->price_out\",$this->user_id,\"$this->presentation\",\"$this->unit\",$this->category_id,$this->inventary_min)";
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

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",unit=\"$this->unit\",description=\"$this->description\",is_active=\"$this->is_active\" where id=$this->id";
		Executor::doit($sql);
	}

	public function del_category(){
		$sql = "update ".self::$tablename." set category_id=NULL where id=$this->id";
		Executor::doit($sql);
	}


	public function update_image(){
		$sql = "update ".self::$tablename." set image=\"$this->image\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());

	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}



	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByCategoryId($category_id){
		$sql = "select * from ".self::$tablename." where category_id=$category_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}







}

?>