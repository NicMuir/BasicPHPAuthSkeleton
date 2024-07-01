<?php

namespace Nicm\AuthSkeleton\middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $response = $handler->handle($request);

//        session_write_close();

        return $response;
    }
}