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
		$sql = "SELECT * FROM `protypes`";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}

	// Return row(s) numbers
	public function getRow($obj)
	{
		return $obj->num_rows;
	}

	//Return found item(s)
	public function getFindArray($string, $page, $per_page)
	{
		$first_link = ($page - 1) * $per_page; 
		$sql = "SELECT `ID`,`name`,`image`,`description`,`price`,`manufactures`.`manu_name`,`protypes`.`type_name` FROM `products` JOIN `manufactures` ON `products`.`manu_ID` = `manufactures`.`manu_ID` JOIN `protypes` ON `products`.`type_ID` = `protypes`.`type_ID` WHERE `name` LIKE '%".$string."%' ORDER BY `ID` DESC LIMIT $first_link, $per_page";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}
	public function getFindObj($string)
	{
		$sql = "SELECT `ID`,`name`,`image`,`description`,`price`,`manufactures`.`manu_name`,`protypes`.`type_name` FROM `products` JOIN `manufactures` ON `products`.`manu_ID` = `manufactures`.`manu_ID` JOIN `protypes` ON `products`.`type_ID` = `protypes`.`type_ID` WHERE `name` LIKE '%".$string."%'";
		$result = self::$conn->query($sql);
		return $result;
	}
	//Delete an item
	public function del($id)
	{
		$sql = "DELETE FROM `products` WHERE `ID` = $id";
		self::$conn->query($sql);
	}

	//Add an item
	public function check($name,$image,$description,$price)
	{
		if(is_string($name) && is_numeric($price) && is_string($description))
		{
			return true;
		}else
		{		
			return false;
		}
	}
	public function add($name,$image,$description,$manu_ID,$type_ID,$price)
	{
		$sql = "INSERT INTO `products` (name,image,description,manu_ID,type_ID,price) VALUES ('$name','$image','$description','$manu_ID',	'$type_ID',$price)";
		self::$conn->query($sql);
	}
	//Add a protype
	public function addProtype($type_name,$type_img)
	{
		$sql = "INSERT INTO `protypes` (type_name,type_img) VALUES ($type_name,$type_img)";
		self::$conn->query($sql);
	}


	public function user()
	{
		$sql = "SELECT * FROM `user` ";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}

	//Get All Products
	public function getAllProducts($page, $per_page)
	{

		$first_link = ($page - 1) * $per_page; 

		$sql = "SELECT `ID`,`name`,`image`,`description`,`price`,`manufactures`.`manu_name`,`protypes`.`type_name` FROM `products` JOIN `manufactures` ON `products`.`manu_ID` = `manufactures`.`manu_ID` JOIN `protypes` ON `products`.`type_ID` = `protypes`.`type_ID` ORDER BY `ID` DESC LIMIT $first_link, $per_page"; 

		$result = self::$conn->query ($sql);        

		return $this->getArray($result);     
	} 

	//Return number of Item(s)
	public function length()
	{
		$sql = "SELECT * FROM `products` ";
		$result = self::$conn->query($sql);
		$arr = $this->getArray($result);
		$count = 0;
		foreach($arr as $value)
		{
			$count++;
		}
		return $count;
	} 

	//Paginate file
	public function paginate($url, $total, $page, $per_page, $offset)
	{
		$from = $page - $offset; 
		$to = $page + $offset;
		$link = "";

		if($total <= 0) 
		{
			return "";
		}

		$total_links = ceil($total/$per_page);

		if($total_links <= 1) 
		{
			return "";
		}

		$first_link = ""; 
		$prev_link =""; 
		$last_link=""; 
		$next_link=""; 

		if ($page > 1) 
		{ 
			$first_link = "<a href='$url'>  << </a>"; 
			$prev = $page - 1; 
			$prev_link = "<a href='$url?page=$prev'> < </a>"; 
		} 
		if($from <= 0) 
		{ 
			$from = 1; 
			$to = $offset * 2; 
		} 
		if($to > $total_links) 
		{ 
			$to = $total_links; 
		} 
		for ($j = $from; $j <= $to; $j++) 
		{ 
			$link = $link."<a href = '$url?page=$j'> $j </a>"; 
		} 
		if($page < $total_links) 
		{ 
			$last_link = "<a href='$url?page=$total_links'>  >> </a>"; 
			$next = $page + 1;
			$next_link = "<a href ='$url?page=$next'> > </a>";
		}

		return $first_link.$prev_link.$link.$next_link.$last_link;
	}
	public function paginateResult($url, $total, $page, $per_page, $offset)
	{
		$from = $page - $offset; 
		$to = $page + $offset;
		$link = "";

		if($total <= 0) 
		{
			return "";
		}

		$total_links = ceil($total/$per_page);

		if($total_links <= 1) 
		{
			return "";
		}

		$first_link = ""; 
		$prev_link =""; 
		$last_link=""; 
		$next_link=""; 

		if ($page > 1) 
		{ 
			$first_link = "<a href='$url'>  << </a>"; 
			$prev = $page - 1; 
			$prev_link = "<a href='$url&page=$prev'> < </a>"; 
		} 
		if($from <= 0) 
		{ 
			$from = 1; 
			$to = $offset * 2; 
		} 
		if($to > $total_links) 
		{ 
			$to = $total_links; 
		} 
		for ($j = $from; $j <= $to; $j++) 
		{ 
			$link = $link."<a href = '$url&page=$j'> $j </a>"; 
		} 
		if($page < $total_links) 
		{ 
			$last_link = "<a href='$url&page=$total_links'>  >> </a>"; 
			$next = $page + 1;
			$next_link = "<a href ='$url&page=$next'> > </a>";
		}

		return $first_link.$prev_link.$link.$next_link.$last_link;
	} 

	//Check username and password
	public function checkUser($user, $pass)
	{
		$sql = "SELECT * FROM `users`";
		$result = self::$conn->query($sql);
		$User = $this->getArray($result);
		foreach ($User as $key => $value) 
		{
			if($value["user_name"] == $user && $pass == $value["user_password"])
			{
				return true;
			}
		}
		return false;
	}
	public function checkAdmin($user, $pass)
	{
		$sql = "SELECT * FROM `users` WHERE `user_name` LIKE 'admin'";
		$result = self::$conn->query($sql);
		$User = $this->getArray($result);
		foreach ($User as $key => $value) 
		{
			if($value["user_name"] == $user && $pass == $value["user_password"])
			{
				return true;
			}
		}
		return false;
	}
	public function checkUserSignUp($user)
	{
		$sql = "SELECT * FROM `users`";
		$result = self::$conn->query($sql);
		$User = $this->getArray($result);
		foreach ($User as $key => $value) 
		{
			if($value["user_name"] == $user)
			{
				return true;
			}
		}
		return false;
	}

	//return 1 product
	public function getProduct($ID)
	{
		$sql = "SELECT `ID`,`name`,`image`,`description`,`price`,`manufactures`.`manu_name`,`protypes`.`type_name` FROM `products` JOIN `manufactures` ON `products`.`manu_ID` = `manufactures`.`manu_ID` JOIN `protypes` ON `products`.`type_ID` = `protypes`.`type_ID` WHERE `ID` = $ID";
		$result = self::$conn->query($sql);
		return $this->getArray($result);
	}
	//Update product
	public function update($ID, $name,$image,$description,$manu_ID,$type_ID,$price)
	{
		$sql = "UPDATE `products` SET name = '$name', image = '$image', description = '$description', manu_ID = $manu_ID, type_ID = $type_ID, price = $price  WHERE ID = $ID";
		// var_dump($sql);
		self::$conn->query($sql);
	}
	public function updateNoImg($ID, $name,$description,$manu_ID,$type_ID,$price)
	{
		$sql = "UPDATE `products` SET name = '$name', description = '$description', manu_ID = $manu_ID, type_ID = $type_ID, price = $price  WHERE ID = $ID";
		// var_dump($sql);
		self::$conn->query($sql);
	}

	public function checkPassword($userpassword, $userpasswordcheck)
	{
		if($userpassword != $userpasswordcheck)
		{
			return false;
		}
		return true;
	}
	public function signUp($username, $userpassword)
	{

		$sql = "INSERT INTO `users` (user_name, user_password) VALUES ('$username','$userpassword')";
		self::$conn->query($sql);
	}

	public function delAcc($name)
	{
		$sql = "DELETE FROM `users` WHERE `user_name` LIKE '$name'";
		self::$conn->query($sql);
	}
}
