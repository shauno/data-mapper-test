<?php

namespace Acme\Invoices\Entities;

class InvoicePaymentEntity
{
    public $id = null;

    public $amount;

    public $created_at;

    public $updated_at;

    public function __construct($id, $amount, $created_at = NULL, $updated_at = NULL)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->created_at = $created_at;
        $this->updated_at = $created_at;
    }
}