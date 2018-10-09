<?php

class DB
{
	//Property
	private static $conn;

	//Constructor
	public function __construct()
	{
		self::$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		self::$conn->set_charset('utf8');
	}

	//Destructor
	public function __destruct()
	{
		self::$conn->close();
	}

	//METHODS
	//Obj -> Array
	public function getArray($obj)
	{
		$arr = array();
		while($row = $obj->fetch_assoc())
		{
			$arr[] = $row;
		}
		return $arr;
	}

	//Return all items
	public function getAll()
	{
		$sql = "SELECT `ID`,`name`,`image`,`description`,`price`,`manufactures`.`manu_name`,`protypes`.`type_name` FROM `products` JOIN `manufactures` ON `products`.`manu_ID` = `manufactures`.`manu_ID` JOIN `protypes` ON `products`.`type_ID` = `protypes`.`type_ID` ORDER BY `ID` DESC";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}

	//Return all manufactures
	public function getManu()
	{
		$sql = "SELECT * FROM `manufactures` ";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}

	//Return all prototype
	public function getProto()
	{
		$sql = "SELECT * FROM `protypes` ";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}

	//Return found item(s)
	public function getFind($string)
	{
		$sql = "SELECT `ID`,`name`,`image`,`description`,`price`,`manufactures`.`manu_name`,`protypes`.`type_name` FROM `products` JOIN `manufactures` ON `products`.`manu_ID` = `manufactures`.`manu_ID` JOIN `protypes` ON `products`.`type_ID` = `protypes`.`type_ID` WHERE `name` LIKE '%".$string."%'";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}

	//Delete an item
	public function del($id)
	{
		$sql = "DELETE FROM `products` WHERE `ID` = $id";
		self::$conn->query($sql);
	}

	//Add an item
	public function add($name,$image,$description,$manu_ID,$type_ID,$price)
	{
		$sql = "INSERT INTO `products` (name,image,description,manu_ID,type_ID,price) VALUES ('$name','$image','$description','$manu_ID','$type_ID',$price)";
		self::$conn->query($sql);
	}

	public function user()
	{
		$sql = "SELECT * FROM `user` ";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}
}