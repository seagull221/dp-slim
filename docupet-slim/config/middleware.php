<?php

use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

return function (App $app) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();    
};
