<?php

namespace App\Middleware\PseudocronMiddleware\Jobs;

use App\Models\Exchange;
use App\Models\ExchangeEvent;

class ExchangeJob implements Job
{
    public static function execute()
    {
        $exchange = Exchange::find(1)->first();
        
        if ($exchange->last_cleaning + 86400 > time()) {
            return;
        }
        
        $exchange->updateNewPricesTime();
        ExchangeJob::addEvent($exchange->randomize());
    }
    
    private static function addEvent($arr)
    {
        if (isset($arr['raw_materials']))
        {
            $event = new ExchangeEvent();

            if ($arr['raw_materials'] == 1) {
                $event->RawMaterialsHossa();
            } else {
                $event->RawMaterialsBessa();
            }
            
            $event->save();
        }
        
        if (isset($arr['fabrics']))
        {
            $event = new ExchangeEvent();

            if ($arr['fabrics'] == 1) {
                $event->FabricsHossa();
            } else {
                $event->FabricsBessa();
            }
            
            $event->save();
        }
        
        if (isset($arr['equipments']))
        {
            $event = new ExchangeEvent();

            if ($arr['equipments'] == 1) {
                $event->EquipmentsHossa();
            } else {
                $event->EquipmentsBessa();
            }
            
            $event->save();
        }
        
        if (isset($arr['food']))
        {
            $event = new ExchangeEvent();

            if ($arr['food'] == 1) {
                $event->FoodHossa();
            } else {
                $event->FoodBessa();
            }
            
            $event->save();
        }
    }
}
