<?php
require_once 'Database.php';

class Sample
{
    private $conn;
    private $table = 'part_samples';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();

        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }

        $this->ensureTableExists(); // Ensure table exists on initialization
    }

    // 🔹 Ensure the table exists
    private function ensureTableExists()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                part_id INT NOT NULL,
                sample_code VARCHAR(50) NOT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (part_id) REFERENCES parts(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error ensuring table exists: " . $e->getMessage());
        }
    }

    // 🔹 Get Parent Part of a Sample
    public function getParentPart($sampleId)
    {
        $query = "SELECT p.* FROM parts p 
                  INNER JOIN {$this->table} s ON p.id = s.part_id 
                  WHERE s.id = :sample_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sample_id', $sampleId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    // 🔹 Create a new sample
    public function create($data)
    {
        $query = "INSERT INTO {$this->table} 
            (part_id, sample_code, description) 
            VALUES (:part_id, :sample_code, :description)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($data) ? $this->conn->lastInsertId() : false;
    }

    // 🔹 Get a sample by ID
    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    // 🔹 Get all samples for a part
    public function getByPartId($partId)
    {
        $query = "SELECT * FROM {$this->table} WHERE part_id = :part_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':part_id', $partId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // 🔹 Update a sample by ID
    public function update($id, $data)
    {
        $query = "UPDATE {$this->table} SET 
            sample_code = :sample_code, 
            description = :description
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;

        return $stmt->execute($data);
    }

    // 🔹 Delete a sample by ID
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>
