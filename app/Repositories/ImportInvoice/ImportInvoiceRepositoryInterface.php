<?php

namespace App\Repositories\ImportInvoice;

use App\Repositories\RepositoriesInterface;

interface ImportInvoiceRepositoryInterface extends RepositoriesInterface
{
    public function query(); // Định nghĩa phương thức query()
}