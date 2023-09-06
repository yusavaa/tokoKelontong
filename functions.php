<?php

$conn = mysqli_connect("localhost", "root", "", "toko_kelontong");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addToCart()
{
    session_start();

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        if (isset($_SESSION["cart"][$_GET["id"]])) {
            $_SESSION["cart"][$_GET["id"]]++;
        } else {
            $_SESSION["cart"][$_GET["id"]] = 1;
        }
        return $_SESSION["cart"];
    }
}

// function increment()
// {
//     session_start();

//     $_SESSION["cart"][$_GET["id"]]++;
// }

// function decrement()
// {
//     session_start();

//     $_SESSION["cart"][$_GET["id"]]--;
// }