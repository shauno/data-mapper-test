<?php

namespace Acme\Invoices;

use Acme\Invoices\Dal\InvoiceGateway;
use Acme\Invoices\Dal\InvoiceMapper;

class InvoiceDomainManager
{
    protected $invoiceGateway;
    protected $invoiceMapper;

    public function __construct(InvoiceGateway $invoiceGateway, InvoiceMapper $invoiceMapper)
    {
        $this->invoiceGateway = $invoiceGateway;
        $this->invoiceMapper = $invoiceMapper;

    }

    public function find($id)
    {
        $invoice = $this->invoiceGateway->get($id);

        return $invoice;
    }

    public function pay($invoiceId, $amount)
    {
        if( ! $invoice = $this->invoiceGateway->get($invoiceId)) {
            return null; //TODO, how to return errors?
        }

        $invoice->addPayment(NULL, $amount, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));

        $this->invoiceMapper->persist($invoice);

        return $this->invoiceGateway->get($invoice->id);
    }
}