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
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../Acme/Invoices/Entities'], env('APP_DEBUG'));

        $conn = [
            'driver'   => 'pdo_mysql',
            'host'     => env('DB_HOST'),
            'user'     => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'dbname'   => env('DB_DATABASE'),
        ];

        $entityManager = EntityManager::create($conn, $config);

        $this->app->singleton('\Doctrine\ORM\EntityManager', function($app) use ($entityManager) {
            return $entityManager;
        });

        $this->app->singleton('\Acme\Invoices\Dal\InvoiceRepository', function($app) use ($entityManager) {
            return $entityManager->getRepository('\Acme\Invoices\Entities\Invoice');
        });
    }
}
