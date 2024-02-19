<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/config/bootstrap.php')) {
    require dirname(__DIR__) . '/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
}

// clean environment each time
(new \Symfony\Component\Filesystem\Filesystem())->remove(__DIR__ . '/../var/cache/test');

// Clean database
$env = 'test';
// passthru(sprintf(
//     'php bin/console cache:clear',
//     $env
// ));

// Définir une variable d’environnement        putenv('DATABASE_URL=mysql://testuser:testpass@localhost/testdb');
// dump($parameter->get('event.listener.enabled'));

// Initialiser la base de données de test
shell_exec('php bin/console d:d:d --force --env=test');
shell_exec('php bin/console d:d:c --env=test');
shell_exec('php bin/console doctrine:database:create --env=test');
shell_exec('php bin/console doctrine:schema:update --complete --force --env=test');
shell_exec('php bin/console doctrine:fixtures:load -n --env=test');
