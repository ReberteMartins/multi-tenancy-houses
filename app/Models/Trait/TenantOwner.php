<?php

namespace App\Models\Trait;


trait TenantOwner
{
    //
    public function getConnectionName()
    {
        return 'tenant';
    }
}
