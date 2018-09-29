<?php

namespace App\Extensions;

use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterface;

class NotFound extends \Slim\Handlers\NotFound
{
    /**
     * DIC
     *
     * @var Container
     */
    protected $container;

    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Invoke not found handler
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $path = $request->getUri()->getPath();
        
        if (preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $path)) {
            return $response->withStatus(404);
        }

        return parent::__invoke($request, $response);
    }

    /**
     * Return a response for text/html content not found - Overwrite Parent Method
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    protected function renderHtmlNotFoundOutput(ServerRequestInterface $request)
    {
        return $this->container->view->fetch('errors/404.twig');
    }
}
