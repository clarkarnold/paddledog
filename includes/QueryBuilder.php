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
		$stmt = $this->pdo->prepare("SELECT * FROM {$table}");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectStmt($user_id, $table)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE user_id = {$user_id}");
		if($stmt->execute()){
			return $stmt;
		}
		
	}

	public function selectPaddlesByUser($user_id)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM paddles WHERE paddle_user = {$user_id}");
		$stmt->execute();
		return $stmt;
	}


}



