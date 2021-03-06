<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-invoice', '\Acme\Invoices\InvoiceController@create');

Route::get('/invoice/{id}', '\Acme\Invoices\InvoiceController@view');

Route::get('/invoice/{id}/pay', '\Acme\Invoices\InvoiceController@pay');
