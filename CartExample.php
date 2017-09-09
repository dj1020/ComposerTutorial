<?php

require __DIR__ . '/vendor/autoload.php';

$id = '閃亮亮Cart';
$store = new \Cart\Storage\SessionStore();
$cart =  new \Cart\Cart($id, $store);

var_dump($cart->toArray());
