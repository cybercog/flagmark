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

function renderCountryFlags()
{
    $iu = new \Flagmark\Services\ImageUpload();
    $countryFlags = $iu->getCountryImageIds();
    $output = '';
    foreach ($countryFlags as $countryCode => $flagData) {
        $output .= "<div class='flag-wrap pull-left'>
                        <a href='?country_code={$countryCode}'><span class='country-flag'><img src='" . getSmallFlag($countryCode) . "'></span><span class='country-name'>{$flagData['name']}</span></a>
                    </div>";
    }

    return $output;
}

function getSmallFlag($countryCode)
{
    if ($countryCode == 'un') {
        return '/assets/images/flags/un-v1-small.png';
    }

    return "https://raw.githubusercontent.com/hjnilsson/country-flags/master/png250px/{$countryCode}.png";
}

function dd($data)
{
    dump($data);
    die();
}