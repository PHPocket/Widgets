<?php

namespace PHPocket\Widgets\Tests;

// Registering own tests autoloader
spl_autoload_register(
    function($className)
    {
        if (substr($className, 0, strlen(__NAMESPACE__)) !== __NAMESPACE__) {
            return;
        }
        include __DIR__
            . '/test/unit/'
            . substr(
                str_replace('\\', '/', $className),
                strlen(__NAMESPACE__) + 1
            )
            . '.php';
    }
);

// Loading abstract class
include_once __DIR__ . '/test/AbstractWidgetTest.php';