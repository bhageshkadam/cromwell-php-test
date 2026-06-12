<?php

require_once 'includes/db.php';

$db = new Database();

$conn = $db->connect();

if($conn)
{
    echo "Database Connected Successfully";
}