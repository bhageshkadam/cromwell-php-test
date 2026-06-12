<?php

function cleanInput($data)
{
    return trim(htmlspecialchars($data));
}

function isValidEmail($email)
{
    return filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
}

function isEmpty($value)
{
    return empty(trim($value));
}