<?php

use Slim\App;
use Nicm\AuthSkeleton\middleware\SessionMiddleware;
use Nicm\AuthSkeleton\middleware\AuthenticationMiddleware;

return function (App $app) {
    $app->add(SessionMiddleware::class);
};