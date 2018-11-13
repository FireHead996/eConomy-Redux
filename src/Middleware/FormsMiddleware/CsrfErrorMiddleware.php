<?php

namespace App\Middleware\FormsMiddleware;

use App\Middleware\Middleware;

class CsrfErrorMiddleware extends Middleware
{
    /**
     * CSRF error middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     */
    public function __invoke($request, $response, $next)
    {
        $this->flash->addMessage('danger', 'Błędna weryfikacja CSRF');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
