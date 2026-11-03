<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/', 'GET');
try {
    $response = $kernel->handle($request);
    echo $response->getStatusCode() . PHP_EOL;
    echo $response->getContent() . PHP_EOL;
} catch (Throwable $e) {
    echo get_class($e) . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
$kernel->terminate($request, $response ?? null);
