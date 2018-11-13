<?php

namespace App\Middleware\FormsMiddleware;

use App\Middleware\Middleware;

class CsrfViewMiddleware extends Middleware
{
    /**
     * CSRF view middleware
     *
     * @param Request $request
     * @param Response $response
     * @param Middleware $next
     * @return Response
     */
    public function __invoke($request, $response, $next)
    {
        $this->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden"
                    name="' . $this->csrf->getTokenNameKey() . '"
                    value="' . $this->csrf->getTokenName() . '">
                <input type="hidden"
                    name="' . $this->csrf->getTokenValueKey() . '"
                    value="' . $this->csrf->getTokenValue() . '">
            ',
        ]);
        
        return $next($request, $response);
    }
}
