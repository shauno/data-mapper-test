<?php

namespace Acme\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create(InvoiceDomainManager $invoiceDomainManager, Request $request)
    {
        $invoice = $invoiceDomainManager->create($request->get('first_name'), $request->get('last_name'));

        if($invoice === false) { //oh noes, there was an issue
            dd($invoiceDomainManager->getErrors()->toArray());
        }

        dd($invoice);
    }

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