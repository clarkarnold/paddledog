<?php

class User
{
	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function register($uname,$uemail,$upass)
	{
		try {
			$new_password = password_hash($upass, PASSWORD_DEFAULT);

			$stmt = $this->db->prepare("INSERT INTO users (user_name, user_email, user_password)
				VALUES (:uname, :uemail, :upass)");
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":uemail", $uemail);
			$stmt->bindparam(":upass", $upass);
			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage();
		}
	}


}