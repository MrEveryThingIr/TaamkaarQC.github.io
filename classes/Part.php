<?php
require_once 'Database.php';

class Part
{
    private $conn;
    private $table = 'parts';
    private $parent;

    public function __construct($parent = null)
    {
        $database = new Database();
        $this->conn = $database->getConnected();

        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }

        $this->parent = $parent; // Assign parent if provided
        $this->ensureTableExists(); // Ensure table exists on initialization
    }

    // Ensure the table exists
    private function ensureTableExists()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                material VARCHAR(255),
                dwg_id INT,  -- Foreign key to the 'drawings' table
                location VARCHAR(255),
                type VARCHAR(255),
                samples_count INT,  -- Adjusted column name to 'samples_count'
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (dwg_id) REFERENCES drawings(id) ON DELETE CASCADE,  -- Foreign key for drawing
                
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error ensuring table exists: " . $e->getMessage());
        }
    }

    // 🔹 Fetch the parent project of a part
    public function getParentProject($partId)
    {
        $query = "SELECT p.* FROM projects p 
                  INNER JOIN {$this->table} pr ON p.id = pr.project_id 
                  WHERE pr.id = :part_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':part_id', $partId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ) ?: null; // Return project details or null if not found
    }

    // 🔹 Get a part by ID
    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    // 🔹 Get all parts for a project
    public function getByProjectId($projectId)
    {
        $query = "SELECT * FROM {$this->table} WHERE project_id = :project_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // 🔹 Create a new part
    public function create($data)
    {
        $query = "INSERT INTO {$this->table} 
            (name, material, project_id, location, type, dwg_id, samples_count, description) 
            VALUES (:name, :material, :project_id, :location, :type, :dwg_id, :samples_count, :description)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($data) ? $this->conn->lastInsertId() : false;
    }

    // 🔹 Update a part by ID
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

    // 🔹 Delete a part by ID
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>
