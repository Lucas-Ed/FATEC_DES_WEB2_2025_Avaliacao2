<?php 
/**
 * Classe responsável por gerenciar dados no MySQL via PDO.
 */
class DB {
    private $host = "localhost";
    private $dbname = "artesanato_db";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Erro ao conectar: " . $e->getMessage());
        }
    }

    public function __destruct() {
        $this->pdo = null; // Encerra a conexão
    }

    private function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    // função para retornar o objeto PDO
    public function getPDO() {
        return $this->pdo;
    }

    // Função específica de cadastro de usuários
    // public function registerUser($nome, $password) {
    //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    //     $this->execute("INSERT INTO usuarios (name, passwords) VALUES (?, ?)", [
    //         $nome, $password, $hashedPassword
    //     ]);
    // }
    
    //  CRUD 
    // CREATE
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // READ - All
    public function getAll($table, $where = '', $params = []) {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - By ID
    public function getById($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = :id";
        return $this->execute($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($table, $id, $data) {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql = "UPDATE $table SET " . implode(", ", $fields) . " WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // DELETE
    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }
}
?>