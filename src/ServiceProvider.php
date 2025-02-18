<?php

namespace Edalzell\Forma;

use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    public function register()
    {
        $this->app->singleton(Forma::class, fn () => new Forma);
    }

    public function boot()
    {
        parent::boot();

        Statamic::booted(function () {
            $this->bootPermissions();
            Forma::all()->each->boot();
        });
    }

    private function bootPermissions()
    {
        Permission::register('manage addon settings')
            ->label('Manage Addon Settings');
    }
}
