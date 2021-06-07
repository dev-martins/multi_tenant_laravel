<?php

namespace App\Tenant;


class ManagerTenant
{
    public function getTenantIdentify()
    {
        $dataTenant = ['user_id' => auth()->user()->id,'tenant_id' => auth()->user()->tenant_id];
        return $dataTenant;
    }
}
