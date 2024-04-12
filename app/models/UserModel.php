<?php

class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function authenticateUser($username, $password)
    {
        $query = "SELECT id, username, role FROM Users WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function registerUser($username, $password, $email, $role)
    {
        // Check if the username or email already exists
        $queryCheck = "SELECT COUNT(*) as count FROM Users WHERE username = :username OR email = :email";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(":username", $username);
        $stmtCheck->bindParam(":email", $email);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Username or email already exists, return false
            return false;
        }

        // Insert the new user
        $queryInsert = "INSERT INTO Users (username, password, email, role) VALUES (:username, :password, :email, :role)";
        $stmtInsert = $this->conn->prepare($queryInsert);
        $stmtInsert->bindParam(":username", $username);
        $stmtInsert->bindParam(":password", $password);
        $stmtInsert->bindParam(":email", $email);
        $stmtInsert->bindParam(":role", $role);
        return $stmtInsert->execute();
    }



    public function isAuthorized($userRole, $allowedRoles)
    {
        return in_array($userRole, $allowedRoles);
    }
    public function isUsernameTaken($username)
    {
        $query = "SELECT COUNT(*) FROM Users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function isEmailTaken($email)
    {
        $query = "SELECT COUNT(*) FROM Users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

}
