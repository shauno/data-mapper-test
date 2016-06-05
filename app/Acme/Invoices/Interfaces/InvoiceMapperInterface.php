<?php

namespace Acme\Invoices\Interfaces;

use Acme\Invoices\Entities\InvoiceEntity;

interface InvoiceMapperInterface
{
    public function persist(InvoiceEntity $invoice);
}
