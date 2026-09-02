<?php

require_once __DIR__ . '/mock_laravel.php';

spl_autoload_register(function ($class) {
    // Autoloader para Src (si aún existe en algún lado) o clases en src sin prefijo
    if (str_starts_with($class, 'Src\\')) {
        $class = substr($class, 4);
    }
    
    $file_src = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file_src)) {
        require $file_src;
        return;
    }

    // Autoloader para Tests
    if (str_starts_with($class, 'Tests\\')) {
        require __DIR__ . '/tests/' . str_replace('\\', '/', substr($class, 6)) . '.php';
    }
});
