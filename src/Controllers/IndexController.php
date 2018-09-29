<?php

namespace App\Controllers;

class IndexController extends Controller
{
    /**
     * Render index page
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function index($request, $response)
    {
        return $this->view->render($response, 'index.twig');
    }
}
