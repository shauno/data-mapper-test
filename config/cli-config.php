<?php

/**
 * @Todo:
 * PLEASE NOTE: This is a temporary solution to get doctrine's console tool working.
 * This needs to be updated to boot Laravel and use the AcmeOrmServiceProvider to be better
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../app/Acme/Invoices/Entities'], true);

$conn = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'entity_doctrine',
];

$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($entityManager);