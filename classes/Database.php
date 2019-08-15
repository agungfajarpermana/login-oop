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

    // single pattern (menguji database agar tidak double koneksi)
    public function getInstace()
    {
        // check variable instance
        if( !isset(self::$instance) )
            self::$instance = new Database();

        return self::$instance;
    }
}