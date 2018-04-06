<?php
error_reporting(E_ALL);
class DataBase {
	private $pdo;
	private $numRows;
	private $array;
	
	public function __construct($hostname, $dbname, $user, $pass) {
		try {
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$hostname, $user, $pass);
		} catch (PDOException $e) {
			echo "Falhou";
			die();
		}
	}

	public function query($sql) {
		$query = $this->pdo->query($sql);
		$this->numRows = $query->rowCount();
		$this->array = $query->fetchAll(PDO::FETCH_ASSOC);
	}

	// Subquery retorna um array com as chave e valores
	public function subQuery($sql) {
		$query = $this->pdo->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function resultado() {
		return $this->array;
	}

	public function insert($table, $data) {
		if (!empty($table) &&  (is_array($data) && count($data) > 0)) {
			try {
				$sql = "INSERT INTO $table";
				$chaves = array();
				$dados = array();
				foreach ($data as $chave => $dado) {
					$chaves[] = $chave;
					$dados[] = "'".addslashes($dado)."'";
				}
				$sql .= "(id, nivel, ".implode(", ", $chaves).") VALUES ";
				$sql .= "(default, 1, ".implode(", ", $dados).");";
				$this->pdo->query($sql);
			} catch (PDOException $e) {
				echo "Erro: ".$e->getMessage()." ".$sql;
			}
		}
	}

	public function update($table, $data, $where = array(), $whereCond = "AND") {
		if (!empty($table) && (is_array($data) && count($data) > 0) && is_array($where)) {
			$sql = "UPDATE $table SET ";
			$dados = array();
			foreach ($data as $chave => $valor) {
				$dados[] = $chave." = '".addslashes($valor)."'";
			}
			$sql .= implode(", ", $dados);
			if (count($where) > 0) {
				$dados = array();
				foreach ($where as $chave => $valor) {
					$dados[] = $chave." = '".addslashes($valor)."'";
				}
				$sql .= " WHERE ".implode(" ".$whereCond." ", $dados);
			}
			$this->pdo->query($sql);
		}
	}

	public function delete($tabela, $where, $whereCond = "AND") {
		if (!empty($tabela) && (is_array($where) && count($where) > 0)) {
			$sql = "DELETE FROM ".$tabela;
			if (count($where) > 0) {
				$dados = array();
				foreach($where as $chave => $valor) {
					$dados[] = $chave." = '".addslashes($valor)."'";
				}
				$sql = $sql." WHERE ".implode(" ".$whereCond." ", $dados);
			}
			echo $sql;
		}
	}

	public function getNumRows() {
		return $this->numRows;
	}
}
?>