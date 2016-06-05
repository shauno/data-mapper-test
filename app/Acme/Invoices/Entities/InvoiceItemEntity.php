<?php

namespace Acme\Invoices\Entities;

class InvoiceItemEntity
{
    public $id = null;

    public $description;

    public $price;

    public $quantity;

    public $created_at;

    public $updated_at;

    public function __construct($id, $description, $price, $quantity, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}