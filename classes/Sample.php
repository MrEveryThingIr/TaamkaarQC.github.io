<?php
class Sample
{
    private $conn;
    private $table = 'part_samples';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnected();
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (part_id, sampleCode, description) 
                  VALUES (:part_id, :sampleCode, :description)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':part_id', $data['part_id'], PDO::PARAM_INT);
        $stmt->bindParam(':sampleCode', $data['sampleCode']);
        $stmt->bindParam(':description', $data['description']);
        
        $result = $stmt->execute();
        
        if ($result) {
            echo "<p class='text-success'>Sample created successfully with part_id {$data['part_id']}</p>";
            return "created sample";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "<p class='text-danger'>Sample creation failed: {$errorInfo[2]}</p>";
            return "sample creation failed";
        }
    }
}
?>
