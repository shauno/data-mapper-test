<?php

namespace Acme\Invoices\Entities;

use Acme\Invoices\Entities\InvoiceItemEntity;

class InvoiceEntity
{
    public $id = null;

    public $first_name;

    public $last_name;

    public $created_at;

    public $updated_at;

    public $items = [];

    public $payments = [];

    public function __construct($id, $first_name, $last_name, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function addItem($id, $description, $price, $quantity, $created_at = null, $updated_at = null)
    {
        $this->items[] = new InvoiceItemEntity(
            $id,
            $description,
            $price,
            $quantity,
            $created_at,
            $updated_at
        );
    }

    public function addPayment($id, $amount, $created_at = null, $updated_at = null)
    {
        $this->payments[] = new InvoicePaymentEntity(
            $id,
            $amount,
            $created_at,
            $updated_at
        );
    }
}