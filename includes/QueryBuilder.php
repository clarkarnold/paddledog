<?php

class QueryBuilder
{
	protected $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function selectAll($table)
	{
		$statement = $this->pdo->prepare("SELECT * FROM {$table}");
		$statement->execute();

		return $statement->fetchAll();

	}

	public function selectUserByEmail($email)
	{
		$statement = $this->pdo->prepare("SELECT * FROM users WHERE user_email = :email");
		$statement->bindparam(":email", $email);
		$statement->execute();
		return $statement;
	}
}