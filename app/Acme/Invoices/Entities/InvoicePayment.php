<?php

namespace Acme\Invoices\Entities;

/**
 * @Entity @Table(name="invoice_payments")
 **/
class InvoicePayment
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="decimal") **/
    protected $amount;

    /** @Column(type="datetime") **/
    protected $created_at;

    /** @Column(type="datetime") **/
    protected $updated_at;

    /**
     * @ManyToOne(targetEntity="Invoice", inversedBy="payments")
     * @JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    protected $invoice;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function addToInvoice($invoice)
    {
        $this->invoice = $invoice;
    }


}