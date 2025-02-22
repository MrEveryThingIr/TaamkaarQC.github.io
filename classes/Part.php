<?php
require_once 'Database.php';

class Part
{
    private $conn;
    private $table = 'parts';

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
                name VARCHAR(255) NOT NULL,
                material VARCHAR(255),
                project_id INT,
                location VARCHAR(255),
                type VARCHAR(255),
                dwg_id INT,
                samples_count INT,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
                FOREIGN KEY (dwg_id) REFERENCES drawings(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error creating table: " . $e->getMessage());
        }
    }

    // 🔹 Create a new part
    public function create($data)
    {
        $query = "INSERT INTO {$this->table} 
                  (name, material, project_id, location, type, dwg_id, samples_count, description) 
                  VALUES (:name, :material, :project_id, :location, :type, :dwg_id, :samples_count, :description)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // 🔹 Read all parts
    public function readAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Read a single part by ID
    public function readOne($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Update a part
    public function update($id, $data)
    {
        $query = "UPDATE {$this->table} SET 
                  name = :name, material = :material, location = :location, 
                  type = :type, dwg_id = :dwg_id, samples_count = :samples_count, 
                  description = :description 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // 🔹 Delete a part
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // 🔹 Get Parent Project of a Part
    public function getParentProject($partId)
    {
        $query = "SELECT p.* FROM projects p 
                  INNER JOIN {$this->table} pr ON p.id = pr.project_id 
                  WHERE pr.id = :part_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':part_id', $partId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // 🔹 Get all parts for a project
    public function getByProjectId($projectId)
    {
        $query = "SELECT * FROM {$this->table} WHERE project_id = :project_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPartsByDrawingId($drawing_id)
{
    try {
        $sql = "SELECT * FROM {$this->table} WHERE dwg_id = :drawing_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':drawing_id', $drawing_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Error fetching parts: " . $e->getMessage());
    }
}

}
