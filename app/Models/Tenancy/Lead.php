<?php

namespace App\Models;

use App\Models\Trait\TenantOwner;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    use TenantOwner;
}
