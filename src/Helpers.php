<?php

function itemList($cart) {
    if (! $cart instanceof \MyCart\Cart) {
        throw new Exception("Not a cart object");
    }

    if (! isset($cart->toArray()['items'])) {
        throw new Exception("Something wrong");
    }

    return $cart->toArray()['items'];
}