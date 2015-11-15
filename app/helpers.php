<?php

function isLoggedIn()
{
    return !empty($_SESSION['facebook_access_token']);
}

function getUserId()
{
    return $_SESSION['facebook_access_token'];
}

function getUserName()
{
    return $_SESSION['user_name'];
}

function getUserCountryCode()
{
    return $_SESSION['generate_country_code'];
}

function dd($data)
{
    dump($data);
    die();
}