<?php

namespace Acme\Invoices\Dal;

use Doctrine\ORM\EntityRepository;

class InvoiceRepository extends EntityRepository
{
    public function get($id)
    {
        return $this->getEntityManager()->find('\Acme\Invoices\Entities\Invoice', $id);
    }
}