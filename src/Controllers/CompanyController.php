<?php

namespace App\Controllers;

use App\Models\Industry;
use App\Models\Company;
use App\Models\PlayerCompany;

class CompanyController extends Controller
{
    private function setCompanyProduct($companylist)
    {
        foreach ($companylist as $company)
        {
            switch($company->product_id)
            {
                case 0: $company->product = " $"; break;
                case 1: $company->product = " surowce"; break;
                case 2: $company->product = " tekstylia"; break;
                case 3: $company->product = " sprzęt"; break;
                case 4: $company->product = " żywność"; break;
            }
        }
        
        return $companylist;
    }
    
    private function setCompanyListValues($companylist)
    {
        foreach ($companylist as $company)
        {
            $costs = $company->hire_cost * $company->workers;
            $company->open ? $company->costs = $costs : $costs / 4;
        }
        
        return $companylist;
    }
    
    public function getCompanyList($request, $response)
    {
        $companylist = $this->setCompanyListValues($this->setCompanyProduct(Industry::join('company_types', 'industry_types.id', '=', 'company_types.industry_type')
                ->join('company_players', 'company_players.company_id', '=', 'company_types.id')
                ->select('*')
                ->where('company_players.player_id', '=', $this->auth->user()->id)
                ->getQuery()
                ->get()));
        
        $this->view->getEnvironment()->addGlobal('companylist', $companylist);
        
        return $this->view->render($response, 'company/list.twig');
    }
    
    public function getCompanyNew($request, $response)
    {
        $companylist = $this->setCompanyProduct(
                Industry::join('company_types', 'industry_types.id', '=', 'company_types.industry_type')
                ->select('*')
                ->getQuery()
                ->get());
        
        $this->view->getEnvironment()->addGlobal('companylist', $companylist);
        $this->view->getEnvironment()->addGlobal('userCash', $this->auth->user()->cash);
        
        return $this->view->render($response, 'company/create.twig');
    }
    
    public function postCompanyNew($request, $response)
    {
        $company = Company::find($request->getParam('company_id'));
        
        if ($company == null)
        {
            $this->flash->addMessage('danger', 'Taka firma nie istnieje!');
            return $response->withRedirect($this->router->pathFor('company.create'));
        }
        
        if ($company->cost > $this->auth->user()->cash)
        {
            $this->flash->addMessage('danger', 'Nie stać cię na tę firmę!');
            return $response->withRedirect($this->router->pathFor('company.create'));
        }
        
        PlayerCompany::create([
            'company_id' => $company->id,
            'name' => $company->name,
            'player_id' => $this->auth->user()->id,
            'value' => floor($company->cost / 2),
            'production' => $company->production_per_worker,
            'upgrade_time' => time(),
            'production_time' => time()
        ]);
        
        $user = $this->auth->user();
        $user->setCash($user->cash - $company->cost);
        $user->setPoints($user->points + $company->points);
        
        $this->flash->addMessage('success', 'Kupiłeś przedsiębiorstwo ' . $company->name . '.');
        return $response->withRedirect($this->router->pathFor('company.list'));
    }
    
    public function postCompanyUpgrade($request, $response)
    {
        
    }
    
    public function postCompanyHire($request, $response)
    {
        
    }
    
    public function postCompanyFire($request, $response)
    {
        
    }
    
    public function postCompanyClose($request, $response)
    {
        
    }
    
    public function postCompanyOpen($request, $response)
    {
        
    }
    
    public function postCompanySell($request, $response)
    {
        
    }
    
    public function postCompanyChangeName($request, $response)
    {
        
    }
}
