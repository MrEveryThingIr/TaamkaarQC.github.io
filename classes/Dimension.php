<?php
class Dimension
{
    // PendingProject
    private $conn;
    private $table = 'dimensions';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
    }

    // Get dimensions by part ID
    public function getByPartId($partId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE part_id = :part_id ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':part_id', $partId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Create a new dimension
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " 
            (part_id, tag,station_code, nominal_size, tolerance_upper, tolerance_lower, description, accepted) 
            VALUES (:part_id, :tag,:station_code, :nominal_size, :tolerance_upper, :tolerance_lower, :description, :accepted)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':part_id', $data['part_id'], PDO::PARAM_INT);
        $stmt->bindParam(':tag', $data['tag']);
		$stmt->bindParam(':station_code', $data['station_code']);
        $stmt->bindParam(':nominal_size', $data['nominal_size']);
        $stmt->bindParam(':tolerance_upper', $data['tolerance_upper']);
        $stmt->bindParam(':tolerance_lower', $data['tolerance_lower']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':accepted', $data['accepted'], PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    // Other methods (update, delete) can be added similarly
}
