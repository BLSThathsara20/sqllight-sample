<?php
class Database {
    private $db;
    
    public function __construct() {
        try {
            $this->db = new SQLite3('db/database.sqlite');
            $this->createTable();
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    private function createTable() {
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->exec($query);
    }
    
    public function getConnection() {
        return $this->db;
    }
}