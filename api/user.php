<?php

header('Content-Type: application/json');

require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/validation.php';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        jsonResponse(
            false,
            'Unauthorized'
        );
    }

    $db = new Database();

    $conn = $db->connect();

    $sql =
        "SELECT
            id,
            forenames,
            surname,
            title,
            dob,
            mobile_phone,
            other_phone,
            email
         FROM users
         WHERE id = :id";

    $stmt =
        $conn->prepare($sql);

    $stmt->execute([
        ':id' => $_SESSION['user_id']
    ]);

    $user =
        $stmt->fetch(PDO::FETCH_ASSOC);

    jsonResponse(
        true,
        'User Details',
        $user
    );
}

if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        jsonResponse(
            false,
            'Unauthorized'
        );
    }

    $data =
        json_decode(
            file_get_contents("php://input"),
            true
        );

    $forenames =
        cleanInput(
            $data['forenames'] ?? ''
        );

    $surname =
        cleanInput(
            $data['surname'] ?? ''
        );

    $mobile_phone =
        cleanInput(
            $data['mobile_phone'] ?? ''
        );

    $other_phone =
        cleanInput(
            $data['other_phone'] ?? ''
        );

    $db = new Database();

    $conn = $db->connect();

    $sql =
        "UPDATE users
         SET
            forenames = :forenames,
            surname = :surname,
            mobile_phone = :mobile_phone,
            other_phone = :other_phone
         WHERE id = :id";

    $stmt =
        $conn->prepare($sql);

    $stmt->execute([
        ':forenames' => $forenames,
        ':surname' => $surname,
        ':mobile_phone' => $mobile_phone,
        ':other_phone' => $other_phone,
        ':id' => $_SESSION['user_id']
    ]);

    jsonResponse(
        true,
        'Profile Updated'
    );
}

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    jsonResponse(
        false,
        'Only POST method allowed'
    );
}

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$forenames = cleanInput(
    $data['forenames'] ?? ''
);

$surname = cleanInput(
    $data['surname'] ?? ''
);

$title = cleanInput(
    $data['title'] ?? ''
);

$dob = cleanInput(
    $data['dob'] ?? ''
);

$mobile_phone = cleanInput(
    $data['mobile_phone'] ?? ''
);

$other_phone = cleanInput(
    $data['other_phone'] ?? ''
);

$email = cleanInput(
    $data['email'] ?? ''
);

$password = $data['password'] ?? '';

if(
    isEmpty($forenames) ||
    isEmpty($surname) ||
    isEmpty($email) ||
    isEmpty($password)
)
{
    jsonResponse(
        false,
        'Required fields missing'
    );
}

if(!isValidEmail($email))
{
    jsonResponse(
        false,
        'Invalid email format'
    );
}

if(strlen($password) < 6)
{
    jsonResponse(
        false,
        'Password must be at least 6 characters'
    );
}

try
{
    $db = new Database();

    $conn = $db->connect();

    $checkSql =
        "SELECT id
         FROM users
         WHERE email = :email";

    $checkStmt =
        $conn->prepare($checkSql);

    $checkStmt->bindParam(
        ':email',
        $email
    );

    $checkStmt->execute();

    if($checkStmt->rowCount() > 0)
    {
        jsonResponse(
            false,
            'Email already exists'
        );
    }

    $passwordHash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );

    $sql =
        "INSERT INTO users
        (
            forenames,
            surname,
            title,
            dob,
            mobile_phone,
            other_phone,
            email,
            password
        )
        VALUES
        (
            :forenames,
            :surname,
            :title,
            :dob,
            :mobile_phone,
            :other_phone,
            :email,
            :password
        )";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':forenames' => $forenames,
        ':surname' => $surname,
        ':title' => $title,
        ':dob' => $dob,
        ':mobile_phone' => $mobile_phone,
        ':other_phone' => $other_phone,
        ':email' => $email,
        ':password' => $passwordHash
    ]);

    jsonResponse(
        true,
        'User registered successfully'
    );

}
catch(Exception $e)
{
    jsonResponse(
        false,
        $e->getMessage()
    );
}