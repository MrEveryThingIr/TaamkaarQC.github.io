<?php
class Report
{
    private $conn;
    private $table = 'reports'; // Replace with your table name

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
    }

    // Insert a new report
    public function insert($data)
    {
        // Extract data from the array
        $date = $data['date'];
        $hall = $data['hall'];
        $device = $data['device'];
        $operator = $data['operator'];
        $project = $data['project'];
        $part_name = $data['part_name'];
        $part_number = $data['part_number'];
        $dwg_number = $data['dwg_number'];
        $technology = $data['technology'];
        $self_control = $data['self_control'];
        $description = $data['description'];

        // SQL query
        $query = "INSERT INTO $this->table 
                  (date, hall, device, operator, project, part_name, part_number, dwg_number, technology, self_control, description) 
                  VALUES 
                  (:date, :hall, :device, :operator, :project, :part_name, :part_number, :dwg_number, :technology, :self_control, :description)";

        // Prepare and execute the statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':hall', $hall);
        $stmt->bindParam(':device', $device);
        $stmt->bindParam(':operator', $operator);
        $stmt->bindParam(':project', $project);
        $stmt->bindParam(':part_name', $part_name);
        $stmt->bindParam(':part_number', $part_number);
        $stmt->bindParam(':dwg_number', $dwg_number);
        $stmt->bindParam(':technology', $technology);
        $stmt->bindParam(':self_control', $self_control);
        $stmt->bindParam(':description', $description);

        // Execute and return success/failure
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a report by ID
    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update a report by ID
    public function update($id, $data)
    {
        $query = "UPDATE $this->table SET 
                  date = :date, 
                  hall = :hall, 
                  device = :device, 
                  operator = :operator, 
                  project = :project, 
                  part_name = :part_name, 
                  part_number = :part_number, 
                  dwg_number = :dwg_number, 
                  technology = :technology, 
                  self_control = :self_control, 
                  description = :description 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':hall', $data['hall']);
        $stmt->bindParam(':device', $data['device']);
        $stmt->bindParam(':operator', $data['operator']);
        $stmt->bindParam(':project', $data['project']);
        $stmt->bindParam(':part_name', $data['part_name']);
        $stmt->bindParam(':part_number', $data['part_number']);
        $stmt->bindParam(':dwg_number', $data['dwg_number']);
        $stmt->bindParam(':technology', $data['technology']);
        $stmt->bindParam(':self_control', $data['self_control']);
        $stmt->bindParam(':description', $data['description']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Fetch all reports
    public function fetchAll()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single report by ID
    public function fetchOne($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch reports with a limit
    public function fetchLimited($limit)
    {
        $query = "SELECT * FROM $this->table LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>