<?php

declare(strict_types=1);

use App\Middleware\CorsMiddleWare;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

$builder = new ContainerBuilder();

$container = $builder->addDefinitions(APP_ROOT . '/config/definitions.php')->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

// Include CORS Middleware
$app->add(new CorsMiddleWare());

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});


$app->group('/api', function(RouteCollectorProxy $group) {
    $group->get('/posts', [App\Controllers\Posts::class, 'index']);
    
    $group->post('/posts/create', [App\Controllers\Posts::class, 'create']);
    
    $group->post('/users/create', [App\Controllers\Users::class, 'create']);
    
    $group->delete('/posts/delete/{id}', [App\Controllers\Posts::class, 'delete']);

});

$app->run();