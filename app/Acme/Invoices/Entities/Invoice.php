<?php

namespace Acme\Invoices\Entities;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="\Acme\Invoices\Dal\InvoiceRepository")
 * @Table(name="invoices")
 **/
class Invoice
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $first_name;

    /** @Column(type="string") **/
    protected $last_name;

    /** @Column(type="datetime") **/
    protected $created_at;

    /** @Column(type="datetime") **/
    protected $updated_at;

    /**
     * @OneToMany(targetEntity="InvoiceItem", mappedBy="invoice")
     */
    protected $items;

    /**
     * @OneToMany(targetEntity="InvoicePayment", mappedBy="invoice")
     */
    protected $payments;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getPayments()
    {
        return $this->payments;
    }

}