<?php

require_once __DIR__ . '/../config/config.php';

class Database
{
    public function connect()
    {
        try {

            $dsn =
                "pgsql:host=" . DB_HOST .
                ";port=" . DB_PORT .
                ";dbname=" . DB_NAME;

            $conn = new PDO(
                $dsn,
                DB_USER,
                DB_PASS
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conn;

        } catch(PDOException $e) {

            die(
                "Database Error: "
                . $e->getMessage()
            );
        }
    }
}