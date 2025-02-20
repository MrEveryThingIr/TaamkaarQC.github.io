<?php
require_once 'Database.php'; // Assuming you have a Database class for DB connection

class DailyReport
{
    private $conn;
    private $table = 'daily_reports'; // Table name

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
                date VARCHAR(255),
                hall VARCHAR(255),
                device INT,
                operator INT,
                project INT,
                part INT,
                dwg VARCHAR(255),
                sample INT,
                dimension INT,
                self_control ENUM('دارد', 'ندارد'),
                technology ENUM('دارد', 'ندارد'),
                status ENUM('ACCEPT', 'NCR'),
                attachment_note TEXT,
                description_voice VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                -- Foreign Keys
                FOREIGN KEY (device) REFERENCES Device(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (operator) REFERENCES Operator(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (project) REFERENCES TamkarProject(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (part) REFERENCES Part(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (sample) REFERENCES Sample(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (dimension) REFERENCES Dimension(id) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error ensuring table exists: " . $e->getMessage());
        }
    }

    // Create (Insert)
    public function create($data)
    {
        try {
            $sql = "INSERT INTO {$this->table} 
                    (date, hall, device, operator, project, part, dwg, sample, dimension, self_control, technology, status, attachment_note, description_voice) 
                    VALUES (:date, :hall, :device, :operator, :project, :part, :dwg, :sample, :dimension, :self_control, :technology, :status, :attachment_note, :description_voice)";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':date', $data['date']);
            $stmt->bindParam(':hall', $data['hall']);
            $stmt->bindParam(':device', $data['device'], PDO::PARAM_INT);
            $stmt->bindParam(':operator', $data['operator'], PDO::PARAM_INT);
            $stmt->bindParam(':project', $data['project'], PDO::PARAM_INT);
            $stmt->bindParam(':part', $data['part'], PDO::PARAM_INT);
            $stmt->bindParam(':dwg', $data['dwg']);
            $stmt->bindParam(':sample', $data['sample'], PDO::PARAM_INT);
            $stmt->bindParam(':dimension', $data['dimension'], PDO::PARAM_INT);
            $stmt->bindParam(':self_control', $data['self_control']);
            $stmt->bindParam(':technology', $data['technology']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':attachment_note', $data['attachment_note']);
            $stmt->bindParam(':description_voice', $data['description_voice']);

            // Execute and return success status
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error creating report: " . $e->getMessage());
        }
    }

    // Read (Fetch all reports)
    public function readAll()
    {
        try {
            $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching reports: " . $e->getMessage());
        }
    }

    // Read (Fetch single report by ID)
    public function readOne($id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching report: " . $e->getMessage());
        }
    }

    // Update (Modify an existing report)
    public function update($id, $data)
    {
        try {
            $sql = "UPDATE {$this->table} SET 
                    date = :date, hall = :hall, device = :device, operator = :operator, 
                    project = :project, part = :part, dwg = :dwg, sample = :sample, 
                    dimension = :dimension, self_control = :self_control, 
                    technology = :technology, status = :status, 
                    attachment_note = :attachment_note, description_voice = :description_voice
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $data['id'] = $id; // Add ID to the data array

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':date', $data['date']);
            $stmt->bindParam(':hall', $data['hall']);
            $stmt->bindParam(':device', $data['device'], PDO::PARAM_INT);
            $stmt->bindParam(':operator', $data['operator'], PDO::PARAM_INT);
            $stmt->bindParam(':project', $data['project'], PDO::PARAM_INT);
            $stmt->bindParam(':part', $data['part'], PDO::PARAM_INT);
            $stmt->bindParam(':dwg', $data['dwg']);
            $stmt->bindParam(':sample', $data['sample'], PDO::PARAM_INT);
            $stmt->bindParam(':dimension', $data['dimension'], PDO::PARAM_INT);
            $stmt->bindParam(':self_control', $data['self_control']);
            $stmt->bindParam(':technology', $data['technology']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':attachment_note', $data['attachment_note']);
            $stmt->bindParam(':description_voice', $data['description_voice']);

            // Execute and return success status
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error updating report: " . $e->getMessage());
        }
    }

    // Delete (Remove a report)
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error deleting report: " . $e->getMessage());
        }
    }
}
?>