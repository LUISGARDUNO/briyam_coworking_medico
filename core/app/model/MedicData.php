<?php
class MedicData {
	public static $tablename = "medic";
	public function __construct(){
		$this->title = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getCategory(){ return CategoryData::getById($this->category_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (time1_data,time2_data,time3_data,time4_data,time5_data,time6_data,time7_data,no,image,category_id,name,lastname,address,phone,email,is_active,password,created_at) ";
		 $sql .= "value (\"$this->time1_data\",\"$this->time2_data\",\"$this->time3_data\",\"$this->time4_data\",\"$this->time5_data\",\"$this->time6_data\",\"$this->time7_data\",\"$this->no\",\"$this->image\",$this->category_id,\"$this->name\",\"$this->lastname\",\"$this->address\",\"$this->phone\",\"$this->email\",$this->is_active,\"$this->password\",$this->created_at)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto MedicData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set time1_data=\"$this->time1_data\",time2_data=\"$this->time2_data\",time3_data=\"$this->time3_data\",time4_data=\"$this->time4_data\",time5_data=\"$this->time5_data\",time6_data=\"$this->time6_data\",time7_data=\"$this->time7_data\",no=\"$this->no\",image=\"$this->image\",name=\"$this->name\",lastname=\"$this->lastname\",address=\"$this->address\",phone=\"$this->phone\",email=\"$this->email\",is_active=\"$this->is_active\",password=\"$this->password\",category_id=$this->category_id where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MedicData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}

	public static function getAllByCategoryId($id){
		$sql = "select * from ".self::$tablename." where category_id=$id order by lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}

	public static function getAllActive(){
		$sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}

	public static function getAllUnActive(){
		$sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}


	public function getUnreads(){ return MessageData::getUnreadsByClientId($this->id); }


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or email like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}


}

?>