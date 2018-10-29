<?php

namespace App\Controllers;

use App\Models\Exchange;
use App\Models\ExchangeEvent;

class ExchangeController extends Controller {
    
    /**
     * Render prices page
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function prices($request, $response)
    {
        $this->view->getEnvironment()->addGlobal('exchange', Exchange::find(1));
        $this->view->getEnvironment()->addGlobal('events', ExchangeEvent::get());
        
        return $this->view->render($response, 'exchange/prices.twig');
    }
    
    /**
     * Render exchange page
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function getExchange($request, $response)
    {
        return $this->view->render($response, 'exchange/exchange.twig');
    }
    
    /**
     * Exchange given materials
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function postExchange($request, $response)
    {
        return null;
    }
}