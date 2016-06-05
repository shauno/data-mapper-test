<?php

namespace Acme\Invoices\Dal;

use Acme\Invoices\Entities\InvoiceEntity;
use Acme\Invoices\Interfaces\InvoiceGatewayInterface;
use Illuminate\Database\Connection;

class InvoiceGateway implements InvoiceGatewayInterface
{
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function get($id)
    {
        if(!$invoice = $this->db->selectOne('SELECT * FROM invoices WHERE id = ?', [$id])) {
            return null;
        }

        $invoiceEntity =  new InvoiceEntity(
            $invoice->id,
            $invoice->first_name,
            $invoice->last_name,
            $invoice->created_at,
            $invoice->updated_at
        );

        $items = $this->db->select('SELECT * FROM invoice_items where invoice_id = ?', [$invoice->id]);
        foreach($items as $item) {
            $invoiceEntity->addItem(
                $item->id,
                $item->description,
                $item->price,
                $item->quantity,
                $item->created_at,
                $item->updated_at
            );
        }

        $payments = $this->db->select('SELECT * FROM invoice_payments where invoice_id = ?', [$invoice->id]);
        foreach ($payments as $payment) {
            $invoiceEntity->addPayment(
                $payment->id,
                $payment->amount,
                $payment->created_at,
                $payment->updated_at
            );
        }

        return $invoiceEntity;
    }
}