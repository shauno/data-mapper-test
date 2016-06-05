<?php

namespace Acme\Invoices\Interfaces;

use Acme\Invoices\Entities\InvoiceEntity;

interface InvoiceGatewayInterface
{
    /**
     * @param int $id
     * @return InvoiceEntity | NULL
     */
    public function get($id);
}