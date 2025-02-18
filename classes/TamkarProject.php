<?php

class TamkarProject
{
    private $conn;
    private $table = 'projects';

    protected $searchables = [
        'title',            // Project title
        'orderer_name',     // Orderer name
        'project_manager',  // Project manager
        'description',      // Project description
        'start_date',       // Start date
        'completed_at',     // Completed status
        'name',             // Part name
        'type',             // Part type
        'material',         // Part material
        'dwg_code',         // Drawing code
        'location',         // Part location
        'part_description', // Part description
    ];

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        if ($this->conn === null) {
            // Handle the error here if needed, as no connection was returned.
            echo 'Database connection has some problem';
        }
    }

    // Get all projects
    public function get_all()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        // Return an empty array if no results are found
        return $result ?: [];
    }

    // Get project by ID
    public function get_by_id($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result : "There is not any project with id={$id}";
    }

    // Create a new project
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " 
            (title, orderer_name, orderer_brand, project_manager, order_no, product_code,start_date,completed_at,description) 
            VALUES (:title, :orderer_name, :orderer_brand, :project_manager, :order_no, :product_code, :start_date , :completed_at , :description)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':orderer_name', $data['orderer_name']);
        $stmt->bindParam(':orderer_brand', $data['orderer_brand']);
        $stmt->bindParam(':project_manager', $data['project_manager']);
        $stmt->bindParam(':order_no', $data['order_no']);
        $stmt->bindParam(':product_code', $data['product_code']);
		$stmt->bindParam(':start_date', $data['start_date']);
		 $stmt->bindParam(':completed_at', $data['completed_at']);
		$stmt->bindParam(':description', $data['description']);

        // Execute and check success
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

    // Update an existing project by ID
    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET 
            title = :title, 
            orderer_name = :orderer_name, 
            orderer_brand = :orderer_brand, 
            project_manager = :project_manager, 
            order_no = :order_no, 
            product_code = :product_code, 
            updated_at = CURRENT_TIMESTAMP 
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':orderer_name', $data['orderer_name']);
        $stmt->bindParam(':orderer_brand', $data['orderer_brand']);
        $stmt->bindParam(':project_manager', $data['project_manager'], PDO::PARAM_INT);
        $stmt->bindParam(':order_no', $data['order_no']);
        $stmt->bindParam(':product_code', $data['product_code']);

        // Execute and check success
        if ($stmt->execute()) {
            return "Project updated successfully!";
        } else {
            return "Failed to update project.";
        }
    }

    // Delete a project by ID
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute and check success
        if ($stmt->execute()) {
            return "Project deleted successfully!";
        } else {
            return "Failed to delete project.";
        }
    }

    // Search logic
	// public function search($searched){
	// 	$query="SELECT*FROM projects where "
	// }

    // Utility function: Get an excerpt of a title or description
    public function getExcerpt($text, $len = 50)
    {
        return strlen($text) > $len ? substr($text, 0, $len) . '...' : $text;
    }
}
