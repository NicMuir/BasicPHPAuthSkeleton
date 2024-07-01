<?php

namespace Nicm\AuthSkeleton\middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class LoginMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $session = $request->getAttribute("session");
        $response = $request->getAttribute("response");

        if ($request->getMethod() === 'POST') {

            $data = $request->getParsedBody();
            $username = $data['username'] ?? '';
            $password = $data['password'] ?? '';

            if($this->authenticate($username, $password)) {
                $_SESSION['user_id'] = 1;
                $response = $handler->handle($request);

                return $response
                    ->withHeader('Location', '/dashboard')
                    ->withStatus(302);
            } else {

                return $response
                    ->withHeader('Location', '/login')
                    ->withStatus(302);
            }


        }
        return $handler->handle($request);

    }

    private function authenticate($username, $password)
    {
        return true;
    }
}