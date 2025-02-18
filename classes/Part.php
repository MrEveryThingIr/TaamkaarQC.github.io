<?php
class Part
{
    private $conn;
    private $table = 'parts';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
    }

    public function get_by_id($id){
        $query='SELECT*FROM '.$this->table." where id=:id limit 1";
        $stmt= $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $result=$stmt->execute();
        if($result){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }
    // Get all parts for a project
    public function getByProjectId($projectId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE project_id = :project_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Create a new part
	public function create($data)
	{
		$query = "INSERT INTO " . $this->table . " 
			(name, material, project_id, location, type, dwg_code, dwg_file, samples_number, description) 
			VALUES (:name, :material, :project_id, :location, :type, :dwg_code, :dwg_file, :samples_number, :description)";
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':name', $data['name']);
		$stmt->bindParam(':material', $data['material']);
		$stmt->bindParam(':project_id', $data['project_id'], PDO::PARAM_INT);
		$stmt->bindParam(':location', $data['location']);
		$stmt->bindParam(':type', $data['type']);
		$stmt->bindParam(':dwg_code', $data['dwg_code']);
		$stmt->bindParam(':dwg_file', $data['dwg_file']);
		$stmt->bindParam(':samples_number', $data['samples_number'], PDO::PARAM_INT);
		$stmt->bindParam(':description', $data['description']);
		
		return $stmt->execute()?$this->conn->lastInsertId():"partCreationFailed!";
	}




    // Update a part by ID
    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET 
            name = :name, material = :material, location = :location, 
            type = :type, dwg_code = :dwg_code, dwg_file = :dwg_file,samples_number=:samples_number , description=:description
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':material', $data['material']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':dwg_code', $data['dwg_code']);
		$stmt->bindParam(':samples_number', $data['samples_number']);
		$stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':dwg_file', $data['dwg_file']);

		if ($stmt->execute()) 
		{ return $this->conn->lastInsertId(); } else { return "Failed to create part."; }
    }

    // Delete a part by ID
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute() ? "Part deleted successfully!" : "Failed to delete part.";
    }
}
?>
