<?php 
$field_names = [
    'date' => 'as_varchar',
    'hall' => 'varchar',
    'device' => 'int',
    'operator' => 'int',
    'project' => 'int',
    'part' => 'int',
    'dwg' => 'upload_file',
    'sample' => 'int',
    'dimension' => 'int',
    'self_control' => 'bool:دارد ندارد',
    'technology' => 'bool:دارد ندارد',
    'status' => 'bool:ACCEPT&NCR',
    'attachment_note' => 'TEXT',
    'description_voice' => 'varchar_address_to_the_recorded_voices'
];

require_once 'Database.php'; // Assuming you have a Database class for DB connection

class DailyReport
{
    private $conn;
    private $table = 'daily_reports'; // Table name

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        $this->ensureTableExists(); // Ensure table exists on initialization
    }

    // Ensure the table exists
    private function ensureTableExists()
    {
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
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->conn->exec($sql);
    }

    // Create (Insert)
    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                (date, hall, device, operator, project, part, dwg, sample, dimension, self_control, technology, status, attachment_note, description_voice) 
                VALUES (:date, :hall, :device, :operator, :project, :part, :dwg, :sample, :dimension, :self_control, :technology, :status, :attachment_note, :description_voice)";
    
        $stmt = $this->conn->prepare($sql);
    
        // Ensure all expected keys exist in the data array
        $defaultValues = [
            'date' => null,
            'hall' => null,
            'device' => null,
            'operator' => null,
            'project' => null,
            'part' => null,
            'dwg' => null,
            'sample' => null,
            'dimension' => null,
            'self_control' => null,
            'technology' => null,
            'status' => null,
            'attachment_note' => null,
            'description_voice' => null
        ];
    
        // Merge defaults with actual data (avoids missing parameters)
        $finalData = array_merge($defaultValues, $data);
    
        return $stmt->execute($finalData);
    }
    

    // Read (Fetch all reports)
    public function readAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read (Fetch single report by ID)
    public function readOne($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update (Modify an existing report)
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET 
                date = :date, hall = :hall, device = :device, operator = :operator, 
                project = :project, part = :part, dwg = :dwg, sample = :sample, 
                dimension = :dimension, self_control = :self_control, 
                technology = :technology, status = :status, 
                attachment_note = :attachment_note, description_voice = :description_voice
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id; // Add ID to the data array
        return $stmt->execute($data);
    }

    // Delete (Remove a report)
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
