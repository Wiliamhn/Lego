<?php

namespace App\Service\ImportInvoice;

use App\Service\ServiceInterface;

interface ImportInvoiceServiceInterface extends ServiceInterface
{
    public function query();
}