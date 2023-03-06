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
    
    /**
     * Returns a array for using in dropdowns
     *
     * @return void
     */
    public function dropdown()
    {
        return $this->model->pluck('name','id');
    }

}