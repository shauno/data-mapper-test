<?php

namespace Acme\Invoices;

use Acme\Invoices\Entities\Invoice;
use Acme\Invoices\Entities\InvoiceItem;
use Acme\Invoices\Entities\InvoicePayment;
use Doctrine\ORM\EntityManager;

class InvoiceDomainManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    //TODO pass in data
    public function create()
    {
        $faker = \Faker\Factory::create();

        $invoice = new Invoice();
        $invoice->setFirstName($faker->firstName);
        $invoice->setLastName($faker->lastName);
        $invoice->setCreatedAt(new \DateTime());
        $invoice->setUpdatedAt(new \DateTime());

        for($items=0; $items<rand(1,4); $items++) {
            $item = new InvoiceItem();
            $item->setDescription($faker->sentence(4));
            $item->setPrice(round(rand(10, 1000), 2));
            $item->setQuantity(round(rand(1, 5)));
            $item->setCreatedAt(new \DateTime());
            $item->setUpdatedAt(new \DateTime());

            $item->addToInvoice($invoice);

            $this->entityManager->persist($item);
        }

        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        dd($invoice);
    }

    public function find($id)
    {
        $invoice = $this->entityManager->find('\Acme\Invoices\Entities\Invoice', $id);

        return $invoice;
    }

    public function pay($invoiceId, $amount)
    {
        if( ! $invoice = $this->entityManager->find('\Acme\Invoices\Entities\Invoice', $invoiceId)) {
            return null;
        }

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