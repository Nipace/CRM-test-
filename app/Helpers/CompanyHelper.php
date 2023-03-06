<?php

namespace App\Helpers;

use App\Models\Company;

class CompanyHelper
{
    protected $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function dropdown()
    {
        return $this->model->pluck('name','id');
    }

}