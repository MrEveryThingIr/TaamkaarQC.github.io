<?php
class User {
private $conn;
private $table='users';

public function __construct(){
    $database=new Database();

    $this->conn = $database->getConnected();
  
}
public function register($username, $password, $email, $phone, $firstname = "", $lastname = "") {
    try {
        // Define SQL query with placeholders
        $query = "INSERT INTO " . $this->table . " (first_name, last_name, phone, username, email, password) 
                  VALUES (:firstname, :lastname, :phone, :username, :email, :password)";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Hash the password securely
        $hashedPass = password_hash($password, PASSWORD_BCRYPT);
        
        // Bind parameters to placeholders in the SQL query
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":password", $hashedPass);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);

        // Execute statement and return success status
        return $stmt->execute();
    } catch (PDOException $e) {
        // Log error (in a real application, don't display this directly to the user)
        error_log("Registration failed: " . $e->getMessage());
        return false;
    }
}

public function login($usernameOrEmail, $password) {
    try {
        // Check if the input is an email
        $isEmail = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL);

        // Prepare SQL based on the input type
        $query = $isEmail 
            ? "SELECT password FROM " . $this->table . " WHERE email = :identifier"
            : "SELECT password FROM " . $this->table . " WHERE username = :identifier";

        // Prepare and bind the statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":identifier", $usernameOrEmail);

        // Execute the query
        $stmt->execute();

        // Fetch the result (hashed password)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return false; // No user found
        }

        // Verify the password
        $hashedPass = $result['password'];
        return password_verify($password, $hashedPass);  // Returns true if password is correct
    } catch (PDOException $e) {
        echo "Login Error: " . $e->getMessage();
        return false;
    }
}


}