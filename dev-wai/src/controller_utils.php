<?php

function &get_cart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    return $_SESSION['cart'];
}

function &get_checked()
{
    if (!isset($_SESSION['checked'])) {
        $_SESSION['cecked'] = [];
    }

    return $_SESSION['checked'];
}
