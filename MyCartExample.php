<?php

require __DIR__ . '/vendor/autoload.php';

$id = 'MyCart Example';
$store = new \MyCart\Storage\SessionStore();
$cart =  new \MyCart\Cart($id, $store);

$cart->add(new \MyCart\CartItem(['name'=> '冰與火之歌第1季', 'quantity' => 1, 'price' => 100]));
$cart->add(new \MyCart\CartItem(['name'=> '冰與火之歌第2季', 'quantity' => 1, 'price' => 200]));
$cart->add(new \MyCart\CartItem(['name'=> '冰與火之歌第3季', 'quantity' => 1, 'price' => 300]));

print_r(itemList($cart));
echo "---------------------------" . PHP_EOL;
print_r('一共 ' . $cart->total() . ' 元');

function itemList($cart) {
    if (! $cart instanceof \MyCart\Cart) {
        throw new Exception("Not a cart object");
    }

    if (! isset($cart->toArray()['items'])) {
        throw new Exception("Something wrong");
    }

    return $cart->toArray()['items'];
}