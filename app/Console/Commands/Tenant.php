<?php

namespace App\Console\Commands;

use App\Actions\TenantConnection;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Tenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant {instruction} {--tenant=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        foreach (
            User::query()
                ->when($tenant = $this->option('tenant'), function ($query) use ($tenant) {
                    return $query->where('id','=', $tenant);
                })
                ->cursor()
                ->all() as $user){
            $this->components->info("Looping to: #{$user->id}");

            app(TenantConnection::class, ['user' => $user,])->execute();

            Artisan::call($this->argument('instruction'), [], $this->output);

        }

        return self::SUCCESS;
    }

}
