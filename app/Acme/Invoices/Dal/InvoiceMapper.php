<?php

namespace Acme\Invoices\Dal;

use Acme\Invoices\Entities\Invoice;
use Acme\Invoices\Entities\InvoiceItem;
use Acme\Invoices\Entities\InvoicePayment;
use Doctrine\ORM\EntityManager;

class InvoiceMapper {
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($firstName, $lastName, $items)
    {
        $invoice = new Invoice();
        $invoice->setFirstName($firstName);
        $invoice->setLastName($lastName);
        $invoice->setCreatedAt(new \DateTime());
        $invoice->setUpdatedAt(new \DateTime());

        foreach ($items as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->setDescription($item['description']);
            $invoiceItem->setPrice($item['price']);
            $invoiceItem->setQuantity($item['quantity']);
            $invoiceItem->setCreatedAt(new \DateTime());
            $invoiceItem->setUpdatedAt(new \DateTime());

            $invoiceItem->addToInvoice($invoice);

            $this->entityManager->persist($invoiceItem);
        }

        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        return $invoice;
    }

    public function pay($invoice, $amount)
    {
        $payment = new InvoicePayment();
        $payment->setAmount($amount);
        $payment->setCreatedAt(new \DateTime());
        $payment->setUpdatedAt(new \DateTime());

        $payment->addToInvoice($invoice);

        $this->entityManager->persist($payment);
        $this->entityManager->flush();

        $this->entityManager->persist($invoice);

        return $invoice;
    }
}