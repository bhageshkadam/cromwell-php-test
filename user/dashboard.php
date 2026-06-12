<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

$db = new Database();
$conn = $db->connect();

$sql = "
    SELECT forenames
    FROM users
    WHERE id = :id
";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ':id' => $_SESSION['user_id']
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            Dashboard
        </div>

        <div class="card-body">

            <h3>
                Welcome
                   <?php
    echo $user['forenames'];
    ?>
            </h3>

            <br>
<a href="edit.php" class="btn btn-warning">
    Edit Profile
</a>

<a href="logout.php" class="btn btn-danger">
    Logout
</a>
           

        </div>

    </div>

</div>

</body>
</html>