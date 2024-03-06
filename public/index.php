<?php

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    // var_dump('ca marche ' . $context['APP_ENV'] . ' ---- ' . $context['APP_DEBUG']);
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
