<?php

namespace App\Service\ImportInvoiceDetail;

use App\Repositories\ImportInvoiceDetail\ImportInvoiceDetailRepositoryInterface;
use App\Service\BaseService;

class ImportInvoiceDetailService extends BaseService implements ImportInvoiceDetailServiceInterface
{
    public $repository;

    public function __construct(ImportInvoiceDetailRepositoryInterface $importInvoiceDetailRepository)
    {
        $this->repository = $importInvoiceDetailRepository;
    }
}