<?php

namespace Nicm\AuthSkeleton\middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if(!isset($_SESSION['user_id'])){
            $response = $response = new \Slim\Psr7\Response();
            $response->getBody()->write('Access denied. Please log in.');
            return $response->withStatus(403);
        }

        // Pass to next middleware
        return $handler->handle($request);
    }
}