<?php

function flash($key, $message)
{
    session()->flash($key, $message);
}

function getSorting()
{
    $sorting = request("sort");

    if ($sorting == 1) {
        $order = "price";
        $way = "asc";
    } else if ($sorting == 2) {
        $order = "price";
        $way = "desc";
    } else if ($sorting == 3) {
        $order = "name";
        $way = "asc";
    } else if ($sorting == 4) {
        $order = "name";
        $way = "desc";
    } else {
        $order = "price";
        $way = "asc";
    }

    return ["order" => $order, "way" => $way];
}

function getPrice()
{
    $price = request("price");

    if ($price == 1) {
        $borderMin = 0;
        $borderMax = 99;
    } else if ($price == 2) {
        $borderMin = 100;
        $borderMax = 499;
    } else if ($price == 3) {
        $borderMin = 500;
        $borderMax = 999;
    } else if ($price == 4) {
        $borderMin = 1000;
        $borderMax = 9999;
    } else {
        $borderMin = 0;
        $borderMax = 999999;
    }

    return [$borderMin, $borderMax];
}

function formatPrice($value)
{
    return number_format($value, 0);
}

function convertBoolToNumber($bool)
{
    if ($bool === "no") {
        return 0;
    } else {
        return 1;
    }
}

function makeAjaxResults($products)
{
    foreach ($products as $product) {
        $product->imagePath = $product->getPhotoPath();
        $product->commentsCount = $product->comments()->approved()->count();
    }
    return response()->json($products);
}

