<?php

namespace Acme\Invoices;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends Controller
{
    public function view($id, InvoiceDomainManager $invoiceDomainManager)
    {
        $invoice = $invoiceDomainManager->find($id);

        dd($invoice);
    }

    public function pay($id, Request $request, InvoiceDomainManager $invoiceDomainManager)
    {
        $invoice = $invoiceDomainManager->pay($id, $request->get('amount'));

        dd($invoice);
    }
}