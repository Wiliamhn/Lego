<?php

namespace App\Repositories\ImportInvoice;

use App\Models\ImportInvoice;
use App\Repositories\BaseRepositories;

class ImportInvoiceRepository extends BaseRepositories implements ImportInvoiceRepositoryInterface
{
    public function getModel()
    {
        return ImportInvoice::class;
    }
    public function query()
    {
        return ImportInvoice::query();
    }
}