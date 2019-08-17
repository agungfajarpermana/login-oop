<?php

class User {
    // property
    private $_db,
            $_success = false;

    public function __construct()
    {
        // call connection database on class Database.php
        $this->_db = Database::getInstance();
    }

    public function register_user($fields = [])
    {
        // call methods insert on class Database.php
        if($this->_db->insert("users", $fields)) return true;
        else return false;
    }
}