<?php

use Illuminate\Support\Str;

if (!function_exists('toUpperCase')) {
    function toUpperCase($str) 
    {
        return Str::upper($str);
    }
}

if (!function_exists('priceFormat')) {
    function priceFormat($amount)
    {
        return number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('priceDiscount')) {
    function priceDiscount($priceOrigin, $discount)
    {
        $price =  $priceOrigin - $priceOrigin * $discount / 100;
        return (int)round($price);
    }
}

if (!function_exists('renderSize')) {
    function renderSize($keySize) 
    {
        return config('variant.size')[$keySize];
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date) 
    {
        return $date->format('d/m/Y');
    }
}