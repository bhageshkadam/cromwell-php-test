<?php

session_start();

header('Content-Type: application/json');

require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/validation.php';

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

$email = cleanInput(
    $data['email'] ?? ''
);

$password =
    $data['password'] ?? '';

if(
    empty($email) ||
    empty($password)
)
{
    jsonResponse(
        false,
        'Email and Password required'
    );
}

try
{
    $db = new Database();

    $conn = $db->connect();

    $sql =
        "SELECT *
         FROM users
         WHERE email = :email";

    $stmt =
        $conn->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    $user =
        $stmt->fetch(
            PDO::FETCH_ASSOC
        );

    if(!$user)
    {
        jsonResponse(
            false,
            'User not found'
        );
    }

    if(
        !password_verify(
            $password,
            $user['password']
        )
    )
    {
        jsonResponse(
            false,
            'Invalid password'
        );
    }

    /* Session Create */

    $_SESSION['user_id'] =
        $user['id'];

    $_SESSION['user_name'] =
        $user['forenames'];

    jsonResponse(
        true,
        'Login successful',
        [
            'user_id' =>
                $user['id']
        ]
    );

}
catch(Exception $e)
{
    jsonResponse(
        false,
        $e->getMessage()
    );
}