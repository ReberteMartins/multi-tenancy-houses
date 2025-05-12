<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB ;

class TenantConnection{

    public function __construct(protected User $user)
    {
        //
    }

    public function execute(): void
    {
        DB::purge('tenant');

        config()->set('database.connections.tenant.database', $this->user->database());

        DB::reconnect('tenant');
    }
}
