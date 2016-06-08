<?php

namespace Acme\Invoices;

use Acme\Invoices\Dal\InvoiceMapper;
use Acme\Invoices\Dal\InvoiceRepository;
use Doctrine\ORM\EntityManager;

class InvoiceDomainManager
{
    protected $invoiceMapper;
    protected $invoiceRepository;

    public function __construct(InvoiceMapper $invoiceMapper, InvoiceRepository $invoiceRepository)
    {
        $this->invoiceMapper = $invoiceMapper;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function create()
    {

        $faker = \Faker\Factory::create();

        $invoiceItems = [];
        for($i=0; $i<4; $i++) {
            $invoiceItems[] = [
                'description' => $faker->sentence(4),
                'price'       => round(rand(10, 1000), 2),
                'quantity'    => round(rand(1, 5)),
            ];
        }

        $invoice = $this->invoiceMapper->create($faker->firstName, $faker->lastName, $invoiceItems);

        return $invoice;
    }

    public function find($id)
    {
        $invoice = $this->invoiceRepository->get($id);

        return $invoice;
    }

    public function pay($invoiceId, $amount)
    {
        if( ! $invoice = $this->invoiceRepository->get($invoiceId)) {
            return null;
        }

        $invoice = $this->invoiceMapper->pay($invoice, $amount);

        return $invoice;

    }
}