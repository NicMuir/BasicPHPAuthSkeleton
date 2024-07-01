<?php

use Nicm\AuthSkeleton\middleware\LogoutMiddleware;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Nicm\AuthSkeleton\middleware\LoginMiddleware;
use Nicm\AuthSkeleton\middleware\AuthenticationMiddleware;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello, world!");
        return $response;
    });

    $app->map(['GET', 'POST'], '/login', function (Request $request, Response $response, $args) {
        if ($request->getMethod() === 'GET') {
            // Render login form (you can replace this with template rendering)
            $html = '<form method="POST" action="/login">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username"><br>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password"><br>
                        <input type="submit" value="Login">
                     </form>';
            $response->getBody()->write($html);
            return $response;
        }

        return $response
            ->withHeader('Location', '/dashboard')
            ->withStatus(302);

    })->add(LoginMiddleware::class);


    $app->get('/logout', function (Request $request, Response $response, $args) {
        return $response;
    })->add(LogoutMiddleware::class);

    $app->get('/dashboard', function (Request $request, Response $response, $args) {
        if (!isset($_SESSION['user_id'])) {
            return $response->withStatus(403)->write('Access denied');
        }
        $response->getBody()->write("Welcome to the dashboard!");
        return $response;
    })->add(AuthenticationMiddleware::class);
};