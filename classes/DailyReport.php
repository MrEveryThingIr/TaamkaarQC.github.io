<?php
require_once 'Database.php'; // Assuming you have a Database class for DB connection

class DailyReport
{
    private $conn;
    private $table = 'daily_reports';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnected();
        if ($this->conn === null) {
            throw new Exception('Database connection failed');
        }
        $this->ensureTableExists();
    }

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
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new Exception("Error ensuring table exists: " . $e->getMessage());
        }
    }

    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (date, hall, device, operator, project, part, dwg, sample, dimension, self_control, technology, status, attachment_note, description_voice) VALUES (:date, :hall, :device, :operator, :project, :part, :dwg, :sample, :dimension, :self_control, :technology, :status, :attachment_note, :description_voice)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function readAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = "UPDATE {$this->table} SET date = :date, hall = :hall, device = :device, operator = :operator, project = :project, part = :part, dwg = :dwg, sample = :sample, dimension = :dimension, self_control = :self_control, technology = :technology, status = :status, attachment_note = :attachment_note, description_voice = :description_voice WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
?>