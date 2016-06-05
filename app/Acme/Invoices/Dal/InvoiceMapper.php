<?php

namespace Acme\Invoices\Dal;

use Acme\Invoices\Entities\InvoiceEntity;
use Acme\Invoices\Interfaces\InvoiceMapperInterface;
use Illuminate\Database\Connection;

class InvoiceMapper implements InvoiceMapperInterface
{
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function persist(InvoiceEntity $invoice)
    {
        //TODO wrap in a transaction

        $this->db->insert('
            INSERT INTO invoices
            (id, first_name, last_name, created_at, updated_at)
            VALUES
            (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            first_name = ?,
            last_name = ?,
            updated_at = ?
        ', [
            $invoice->id,
            $invoice->first_name,
            $invoice->last_name,
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s'),
            $invoice->first_name,
            $invoice->last_name,
            date('Y-m-d H:i:s'),
        ]);

        $invoiceId = $invoice->id ?: $this->db->getPdo()->lastInsertId();

        foreach ($invoice->items as $item) {
            $this->db->insert('
            INSERT INTO invoice_items
            (id, invoice_id, description, price, quantity, created_at, updated_at)
            VALUES
            (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            description = ?,
            price = ?,
            quantity = ?,
            updated_at = ?
        ', [
                $item->id,
                $invoiceId,
                $item->description,
                $item->price,
                $item->quantity,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                $item->description,
                $item->price,
                $item->quantity,
                date('Y-m-d H:i:s'),
            ]);
        }

        foreach ($invoice->payments as $payment) {
            $id = $this->db->insert('
            INSERT INTO invoice_payments
            (id, invoice_id, amount, created_at, updated_at)
            VALUES
            (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            amount = ?,
            updated_at = ?
        ', [
                $payment->id,
                $invoiceId,
                $payment->amount,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                $payment->amount,
                date('Y-m-d H:i:s'),
            ]);
        }


    }
}