<?php

namespace MyCart;

class Cart
{

    /**
     * Cart constructor.
     * @param string $id
     * @param \MyCart\Storage\SessionStore $store
     */
    public function __construct($id, $store)
    {
    }

    public function add($param)
    {

    }

    public function toArray()
    {
        return [
            'items' => []
        ];
    }

    public function total()
    {
        return 0;
    }
}