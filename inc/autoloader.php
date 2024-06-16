<?php
spl_autoload_register(function ($class) {
    $classDir = str_replace('\\', '/', $class);
    if (file_exists($classDir) . '.php') {
        require $classDir . '.php';
    };
});