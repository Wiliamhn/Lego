<?php

namespace App\Service\ImportInvoice;

use App\Repositories\ImportInvoice\ImportInvoiceRepositoryInterface;
use App\Service\BaseService;

class ImportInvoiceService extends BaseService implements ImportInvoiceServiceInterface
{
    public $repository;

    public function __construct(ImportInvoiceRepositoryInterface $importInvoiceRepository)
    {
        $this->repository = $importInvoiceRepository;
    }
    public function query()
    {
        return $this->repository->query();
    }
}