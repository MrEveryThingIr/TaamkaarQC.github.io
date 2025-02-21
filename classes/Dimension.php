<?php
require_once 'Database.php'; // Assuming you have a Database class for DB connection

class Dimension
{
    private $conn;
    private $table = 'dimensions';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }
        $this->ensureTableExists(); // Ensure table exists on initialization
    }

    // Ensure the table exists
    private function ensureTableExists()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                drawing_id INT NOT NULL,
                part_id INT NOT NULL,
                tag VARCHAR(10) NOT NULL,
                station_code VARCHAR(50),
                nominal_size DECIMAL(10,3) NOT NULL,
                upper_tolerance DECIMAL(10,3),
                lower_tolerance DECIMAL(10,3),
                status ENUM('ACCEPT', 'NCR') NOT NULL DEFAULT 'ACCEPT',
                description_voice VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (part_id) REFERENCES parts(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error ensuring table exists: " . $e->getMessage());
        }
    }

    // 🔹 Create a new record
    public function create($data)
    {
        $query = "INSERT INTO {$this->table} 
            (drawing_id, part_id, tag, station_code, nominal_size, upper_tolerance, lower_tolerance, status, description_voice) 
            VALUES (:drawing_id, :part_id, :tag, :station_code, :nominal_size, :upper_tolerance, :lower_tolerance, :status, :description_voice)";

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
            drawing_id = :drawing_id,
            part_id = :part_id,
            tag = :tag, 
            station_code = :station_code, 
            nominal_size = :nominal_size, 
            upper_tolerance = :upper_tolerance, 
            lower_tolerance = :lower_tolerance, 
            status = :status, 
            description_voice = :description_voice 
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

    // 🔹 Get Parent Part of a Dimension
    public function getParentPart($dimensionId)
    {
        $query = "SELECT p.* FROM parts p 
                  INNER JOIN {$this->table} d ON p.id = d.part_id 
                  WHERE d.id = :dimension_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dimension_id', $dimensionId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    // 🔹 Get Parent Drawing of a Dimension
    public function getParentDrawing($dimensionId)
    {
        $query = "SELECT d.* FROM drawings d 
                  INNER JOIN {$this->table} dm ON d.id = dm.drawing_id 
                  WHERE dm.id = :dimension_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dimension_id', $dimensionId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }
}
?>