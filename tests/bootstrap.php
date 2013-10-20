<?php

namespace PHPocket\Widgets\Tests;

// Registering own tests autoloader
spl_autoload_register(function($className){
    if (substr($className, 0, strlen(__NAMESPACE__)) !== __NAMESPACE__) {
        return;
    }

    include __DIR__ . '/src/' . substr(str_replace('\\', '/', $className), strlen(__NAMESPACE__) + 1) . '.php';
});

// Loading widgets autoloader
require __DIR__ . '/../autoload.php';
