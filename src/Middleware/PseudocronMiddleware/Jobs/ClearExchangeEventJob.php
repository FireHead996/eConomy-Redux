<?php

namespace App\Middleware\PseudocronMiddleware\Jobs;

use App\Models\ExchangeEvent;
use App\Models\Exchange;

class ClearExchangeEventJob implements Job
{
    public static function execute()
    {
        $exchange = Exchange::find(1)->first();
        
        if ($exchange->last_change + 86400 > time()) {
            return;
        }
        
        $exchange->updateCleaningTime();
        $events = ExchangeEvent::orderBy('id', 'asc')->get();
        
        if ($events->count() > 10)
        {
            $limit = $events->count() - 10;
            ExchangeEvent::orderBy('id', 'asc')->limit($limit)->delete();
        }
    }
}
