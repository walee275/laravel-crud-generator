<?php

namespace App\Providers;

use App\Console\Commands\GenerateCrud;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       // Use the generateLink() method to create a link for the sidebar
       $command = new GenerateCrud();

       $link = $command->generateLink($modelName);

       // Share the $link variable with the sidebar view
       View::composer('partials.sidebar', function ($view) use ($link) {
           $view->with('sidebarLink', $link);
       });
    }
}
