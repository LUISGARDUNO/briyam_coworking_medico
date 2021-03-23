<?php
class MedicCategoryData {
	public static $tablename = "medic_category";


	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (category_id, medic_id) ";
		$sql .= "value (\"$this->category_id\",$this->medic_id)";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where medic_id=$this->medic_id and  category_id=$this->category_id ";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto MedicCategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MedicCategoryData());
	}


	public static function getByMC($m,$c){
		$sql = "select * from ".self::$tablename." where medic_id=$m and category_id=$c";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MedicCategoryData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicCategoryData());

	}

	public static function getAllByMedic($id){
		$sql = "select * from ".self::$tablename." where medic_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicCategoryData());

	}

	public static function getAllByCategory($id){
		$sql = "select * from ".self::$tablename." where category_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicCategoryData());

	}

	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicCategoryData());
	}


}

?>