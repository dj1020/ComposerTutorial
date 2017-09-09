<?php

require __DIR__ . '/vendor/autoload.php';

$id = '閃亮亮Cart';
$store = new \Cart\Storage\SessionStore();
$cart =  new \Cart\Cart($id, $store);

$cart->add(new \Cart\CartItem(['name'=> '冰與火之歌第1季', 'quantity' => 1, 'price' => 100]));
$cart->add(new \Cart\CartItem(['name'=> '冰與火之歌第2季', 'quantity' => 1, 'price' => 200]));
$cart->add(new \Cart\CartItem(['name'=> '冰與火之歌第3季', 'quantity' => 1, 'price' => 300]));

print_r($cart->toArray()['items']);
echo "---------------------------" . PHP_EOL;
print_r('一共 ' . $cart->total() . ' 元');
