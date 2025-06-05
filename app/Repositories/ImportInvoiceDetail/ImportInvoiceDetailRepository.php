<?php

namespace App\Repositories\ImportInvoiceDetail;

use App\Models\ImportInvoiceDetail;
use App\Repositories\BaseRepositories;

class ImportInvoiceDetailRepository extends BaseRepositories implements ImportInvoiceDetailRepositoryInterface
{
    public function getModel()
    {
        return ImportInvoiceDetail::class;
    }
}