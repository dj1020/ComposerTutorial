<?php

namespace MyCart;

class GameOfThronesCart extends Cart
{

    /**
     * GameOfThronesCart constructor.
     * @param string $id
     * @param \MyCart\Storage\SessionStore $store
     */
    public function __construct($id, $store)
    {
        echo '-----------------------------' . PHP_EOL;
        echo 'Here is Game of Thrones Cart' . PHP_EOL;
        echo '-----------------------------' . PHP_EOL;

        parent::__construct($id, $store);
    }
}