<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeEvent extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'exchange_events';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'type',
        'content',
    ];
    
    public function RawMaterialsHossa()
    {
        $this->type = 0;
        $this->subject = "Surowce drożeją!";
        $this->content = "Boom na giełdzie surowcowej! Ceny windują w górę!";
    }
    
    public function RawMaterialsBessa()
    {
        $this->type = 1;
        $this->subject = "Cena surowców spada!";
        $this->content = "Krach na giełdzie surowcowej! To najlepszy moment by zacząć sprzedawać!";
    }
    
    public function FabricsHossa()
    {
        $this->type = 0;
        $this->subject = "Tekstylia drożeją!";
        $this->content = "Boom na giełdzie tekstylnej! Ceny windują w górę!";
    }
    
    public function FabricsBessa()
    {
        $this->type = 1;
        $this->subject = "Cena tekstyliów spada!";
        $this->content = "Krach na giełdzie tekstylnej! To najlepszy moment by zacząć sprzedawać!";
    }
    
    public function EquipmentsHossa()
    {
        $this->type = 0;
        $this->subject = "Sprzęty drożeją!";
        $this->content = "Boom na giełdzie sprzętów! Ceny windują w górę!";
    }
    
    public function EquipmentsBessa()
    {
        $this->type = 1;
        $this->subject = "Cena sprzętów spada!";
        $this->content = "Krach na giełdzie sprzętów! To najlepszy moment by zacząć sprzedawać!";
    }
    
    public function FoodHossa()
    {
        $this->type = 0;
        $this->subject = "Artykuły spożywcze drożeją!";
        $this->content = "Boom na giełdzie żywnościowej! Ceny windują w górę!";
    }
    
    public function FoodBessa()
    {
        $this->type = 1;
        $this->subject = "Cena artykułów spożywczych spada!";
        $this->content = "Krach na giełdzie żywnościowej! To najlepszy moment by zacząć sprzedawać!";
    }
}
