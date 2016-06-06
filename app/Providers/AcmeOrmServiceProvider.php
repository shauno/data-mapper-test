<?php

namespace App\Providers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Illuminate\Support\ServiceProvider;

class AcmeOrmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('\Doctrine\ORM\EntityManager', function($app) {
            $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../Acme/Invoices/Entities'], env('APP_DEBUG'));

            $conn = [
                'driver'   => 'pdo_mysql',
                'host'     => env('DB_HOST'),
                'user'     => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'dbname'   => env('DB_DATABASE'),
            ];

            return EntityManager::create($conn, $config);
        });
    }
}
