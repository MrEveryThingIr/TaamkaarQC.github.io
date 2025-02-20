<?php
require_once 'Database.php';

class Device
{
    private $conn;
    private $table = 'devices';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }
        $this->ensureTableExists();
    }

    // 🔹 Ensure table exists
    private function ensureTableExists()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                hall ENUM('sabok', 'sangin1', 'sangin2', '7000metri', '4000metri', 'sookhtpash1', 'sookhtpash2', 'khatte_ajor') NOT NULL,
                device_name VARCHAR(100) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error creating table: " . $e->getMessage());
        }
    }

    // 🔹 CRUD Methods
    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (hall, device_name) VALUES (:hall, :device_name)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data) ? $this->conn->lastInsertId() : false;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function update($id, $data)
    {
        $query = "UPDATE {$this->table} SET hall = :hall, device_name = :device_name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>
