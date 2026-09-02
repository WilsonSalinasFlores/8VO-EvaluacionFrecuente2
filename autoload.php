<?php

spl_autoload_register(function ($class) {
    // Autoloader para Src
    if (str_starts_with($class, 'Src\\')) {
        require __DIR__ . '/src/' . str_replace('\\', '/', substr($class, 4)) . '.php';
    }
    // Autoloader para Tests
    if (str_starts_with($class, 'Tests\\')) {
        require __DIR__ . '/tests/' . str_replace('\\', '/', substr($class, 6)) . '.php';
    }
});
