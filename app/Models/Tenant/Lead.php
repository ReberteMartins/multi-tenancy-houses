<?php

namespace App\Models\Tenant;

use App\Models\Trait\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    use HasFactory, TenantOwner;
}
