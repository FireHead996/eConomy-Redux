<?php

namespace App\Controllers;

use App\Models\User;

class RankingController extends Controller
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
        $this->view->getEnvironment()->addGlobal('players', User::all());
        
        return $this->view->render($response, 'ranking.twig');
    }
}
