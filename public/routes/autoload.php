<?php

$dir = scandir(__DIR__);
foreach ($dir as $route) {
    if (in_array($route, ['.', '..', 'autoload.php'])) continue;
    require_once __DIR__ . '/' . $route;
}
