<?php

namespace Acme\Invoices;

use Acme\Invoices\Dal\InvoiceMapper;
use Acme\Invoices\Dal\InvoiceRepository;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Factory as Validator;

class InvoiceDomainManager
{
    protected $invoiceMapper;
    protected $invoiceRepository;

    protected $validator;
    protected $errors;

    public function __construct(InvoiceMapper $invoiceMapper, InvoiceRepository $invoiceRepository, Validator $validator)
    {
        $this->invoiceMapper = $invoiceMapper;
        $this->invoiceRepository = $invoiceRepository;
        $this->validator = $validator;
    }

    protected function setErrors(MessageBag $messages)
    {
        $this->errors = $messages;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function create($firstName, $lastName)
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

        $valid = $this->validator->make([
            'first_name' => $firstName,
            'last_name'  => $lastName,
        ], [
            'first_name' => ['required'],
            'last_name'  => ['required'],
        ]);

        if($valid->fails()) {
            $this->setErrors($valid->messages());
            return false;
        }

        $invoice = $this->invoiceMapper->create($firstName, $lastName, $invoiceItems);

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