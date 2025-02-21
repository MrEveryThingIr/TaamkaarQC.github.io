<?php
require_once 'Database.php'; // Assuming you have a Database class for DB connection

class Drawing
{
    private $conn;
    private $table = 'drawings';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }
        $this->ensureTableExists();
    }

    // Ensure the table exists
    private function ensureTableExists()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                project_id INT NOT NULL,
                drawing_number VARCHAR(50) NOT NULL UNIQUE,
                drawing_file VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error creating table: " . $e->getMessage());
        }
    }

    // 🔹 Create a new record
    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (project_id, drawing_number, drawing_file) 
                  VALUES (:project_id, :drawing_number, :drawing_file)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // 🔹 Read all records
    public function readAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Read a single record by ID
    public function readOne($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Update a record
    public function update($id, $data)
    {
        $query = "UPDATE {$this->table} SET 
                  drawing_number = :drawing_number, drawing_file = :drawing_file 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // 🔹 Delete a record
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // 🔹 Get Parent Project of a Drawing
    public function getParentProject($drawingId)
    {
        $query = "SELECT p.* FROM projects p 
                  INNER JOIN {$this->table} d ON p.id = d.project_id 
                  WHERE d.id = :drawing_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':drawing_id', $drawingId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }
}
?>