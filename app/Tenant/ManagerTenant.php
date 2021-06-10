<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function getTenantIdentify()
    {
        // return $this->getTenant()->id;
        $dataTenant = ['user_id' => auth()->user()->id, 'tenant_id' => auth()->user()->tenant_id];
        return $dataTenant;
    }

    public function getTenant(): Tenant
    {
        return auth()->user()->tenant;
    }
}
