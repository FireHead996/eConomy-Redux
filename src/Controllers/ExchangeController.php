<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserStorage;
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
        $this->view->getEnvironment()->addGlobal('exchange', Exchange::find(1));
        
        return $this->view->render($response, 'exchange/exchange.twig');
    }
    
    private function getExchangeTableFromRequest($request)
    {
        return [
            'raw_materials' => $request->getParam('raw_materials'),
            'fabrics' => $request->getParam('fabrics'),
            'equipments' => $request->getParam('equipments'),
            'food' => $request->getParam('food'),
        ];
    }
    
    private function getExchangePricesAsTable($exchange)
    {
        return [
            'raw_materials' => $exchange->raw_materials,
            'fabrics' => $exchange->fabrics,
            'equipments' => $exchange->equipments,
            'food' => $exchange->food,
        ];
    }
    
    private function getStorageValuesAsTable($storage)
    {
        return [
            'raw_materials' => $storage->raw_materials,
            'fabrics' => $storage->fabrics,
            'equipments' => $storage->equipments,
            'food' => $storage->food,
        ];
    }

    /**
     * Buy given materials
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function postExchangeBuy($request, $response) //TODO: refactor
    {
        if ($this->validator->validateExchangeForm($request)->getErrorsCount() > 0)
        {
            $_SESSION['errors'] = $this->validator->getErrors();
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $user = User::find($_SESSION['user']);
        
        if (!$user)
        {
            $this->flash->addMessage('danger', 'Nie hakieruj.');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $userstorage = UserStorage::where('uid', $_SESSION['user'])->first();
        
        if (!$userstorage)
        {
            $this->flash->addMessage('danger', 'Coś nie pykło :O.');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $exchange = $this->getExchangePricesAsTable(Exchange::find(1));
        
        $exchangeTab = $this->getExchangeTableFromRequest($request);
        
        $allcost = 0;
        
        foreach ($exchangeTab as $element => $value)
        {
            $cost = $exchange[$element] * $value;
            $allcost += $cost;
        }
        
        if ($allcost == 0)
        {
            $this->flash->addMessage('info', 'Nie wybrano żadnych towarów');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        if ($allcost > $user->cash)
        {
            $this->flash->addMessage('danger', 'Nie stać cię na zakup tych towarów');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $user->setCash($user->cash - $allcost);
        
        $storage = $this->getStorageValuesAsTable($userstorage);
        
        foreach ($exchangeTab as $element => $value)
        {
            $userstorage->setStorage($element, $storage[$element] + $value);
        }
        
        $this->flash->addMessage('success', 'Zakupiono towary');

        return $response->withRedirect($this->router->pathFor('exchange'));
    }
    
    /**
     * Sell given materials
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function postExchangeSell($request, $response) //TODO: refactor
    {
        if ($this->validator->validateExchangeForm($request)->getErrorsCount() > 0)
        {
            $_SESSION['errors'] = $this->validator->getErrors();
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $user = User::find($_SESSION['user']);
        
        if (!$user)
        {
            $this->flash->addMessage('danger', 'Nie hakieruj.');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $userstorage = UserStorage::where('uid', $_SESSION['user'])->first();
        
        if (!$userstorage)
        {
            $this->flash->addMessage('danger', 'Coś nie pykło :O.');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $exchange = $this->getExchangePricesAsTable(Exchange::find(1));
        
        $exchangeTab = $this->getExchangeTableFromRequest($request);
        
        $allvalue = 0;
        
        foreach ($exchangeTab as $element => $value)
        {
            $val = $exchange[$element] * $value;
            $allvalue += $val;
        }
        
        if ($allvalue == 0)
        {
            $this->flash->addMessage('info', 'Nie wybrano żadnych towarów');
            return $response->withRedirect($this->router->pathFor('exchange'));
        }
        
        $storage = $this->getStorageValuesAsTable($userstorage);
        
        foreach ($storage as $element => $count)
        {
            if ($exchangeTab[$element] > $count)
            {
                $this->flash->addMessage('danger', 'Nie masz tylu towarów');
                return $response->withRedirect($this->router->pathFor('exchange'));
            }
        }
        
        $user->setCash($user->cash + $allvalue);
        
        foreach ($exchangeTab as $element => $value)
        {
            $userstorage->setStorage($element, $storage[$element] - $value);
        }
        
        $this->flash->addMessage('success', 'Sprzedano towary');

        return $response->withRedirect($this->router->pathFor('exchange'));
    }
}