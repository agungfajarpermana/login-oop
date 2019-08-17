<?php

class Database {
    // property
    private static $instance = null;
    private $mysqli,
            $host = "localhost",
            $user = "root",
            $pass = "",
            $db_name = "test";

    // constructor
    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
        if(mysqli_connect_error()){
            die("gagal konek ke database!");
        }
    }

    // single pattern (menguji database agar tidak double koneksinya)
    public function getInstance()
    {
        // check variable instance
        if( !isset(self::$instance) )
            self::$instance = new Database();

        return self::$instance;
    }

    public function insert($table, $fields = [])
    {
        // get key to column
        $column = implode(",", array_keys($fields));

        // get value to values
        $valueArrays = [];

        foreach($fields as $key => $value){
            // check value integer
            if(is_int($value)){
                $valueArrays[$key] = $this->escape($value);
            }
            $valueArrays[$key] = "'". $this->escape($value) ."'";
        }

        $values = implode(",", $valueArrays);
        $query = "INSERT INTO $table ($column) VALUES ($values)";

        // call func execute_query()
        return $this->execute_query($query, "Ada masalah saat memasukan data");
    }

    public function execute_query($query, $error)
    {
        if($this->mysqli->query($query)) return true;
        else die($error);
    }

    public function escape($query)
    {
        return $this->mysqli->real_escape_string($query);
    }
}