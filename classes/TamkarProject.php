<?php
require_once 'Database.php';

class TamkarProject
{
    private $conn;
    private $table = 'projects';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }
        $this->ensureTableExists(); // Ensure the table exists
    }

    // Ensure the table exists
    private function ensureTableExists()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                orderer_name VARCHAR(255) NOT NULL,
                orderer_brand VARCHAR(255),
                project_manager VARCHAR(255),
                order_no VARCHAR(255),
                product_code VARCHAR(255),
                start_date DATE,
                completed_at DATE NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error ensuring table exists: " . $e->getMessage());
        }
    }

    // Get all projects
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ) ?: [];
    }

    // Get project by ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    // Create a new project
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " 
            (title, orderer_name, orderer_brand, project_manager, order_no, product_code, start_date, completed_at, description) 
            VALUES (:title, :orderer_name, :orderer_brand, :project_manager, :order_no, :product_code, :start_date, :completed_at, :description)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($data) ? $this->conn->lastInsertId() : false;
    }

    // Update an existing project
    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET 
            title = :title, 
            orderer_name = :orderer_name, 
            orderer_brand = :orderer_brand, 
            project_manager = :project_manager, 
            order_no = :order_no, 
            product_code = :product_code, 
            start_date = :start_date, 
            completed_at = :completed_at, 
            description = :description
            WHERE id = :id";
            
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete a project by ID
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // Dynamic search for projects
    public function search($keyword)
    {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE title LIKE :keyword OR orderer_name LIKE :keyword 
                  OR project_manager LIKE :keyword OR description LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_OBJ) ?: [];
    }

    // Utility function: Get an excerpt of a title or description
    public function getExcerpt($text, $len = 50)
    {
        return strlen($text) > $len ? substr($text, 0, $len) . '...' : $text;
    }
}
?>
