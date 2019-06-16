<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'exchange';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'last_change',
        'last_cleaning',
        'raw_materials',
        'raw_materials_hossa',
        'fabrics',
        'fabrics_hossa',
        'equipments',
        'equipments_hossa',
        'food',
        'food_hossa'
    ];
    
    public function updateNewPricesTime()
    {
        $this->update([
            'last_change' => time(),
        ]);
    }
    
    public function updateCleaningTime()
    {
        $this->update([
            'last_cleaning' => time(),
        ]);
    }
    
    // TODO: Throw this method out of the model class
    public function randomize()
    {
        $randType = rand(0, 3);
        
        $new_raw_materials = $this->raw_materials;
        $new_fabrics = $this->fabrics;
        $new_equipments = $this->equipments;
        $new_food = $this->food;
        
        $new_raw_materials_hossa = $this->raw_materials_hossa;
        $new_fabrics_hossa = $this->fabrics_hossa;
        $new_equipments_hossa = $this->equipments_hossa;
        $new_food_hossa = $this->food_hossa;
        
        if ($randType == 0)
        {
            $new_raw_materials = rand(25, 50);
            $new_fabrics = rand(10, 30);
            
            $new_raw_materials_hossa = $new_raw_materials > $this->raw_materials ? 1 : 0;
            $new_fabrics_hossa = $new_fabrics > $this->fabrics ? 1 : 0;
            
            $arr = [
                'raw_materials' => $new_raw_materials_hossa,
                'fabrics' => $new_fabrics_hossa,
            ];
        }
        elseif ($randType == 1)
        {
            $new_fabrics = rand(10, 30);
            $new_equipments = rand(50, 80);
            
            $new_fabrics_hossa = $new_fabrics > $this->fabrics ? 1 : 0;
            $new_equipments_hossa = $new_equipments > $this->equipments ? 1 : 0;
            
            $arr = [
                'fabrics' => $new_fabrics_hossa,
                'equipments' => $new_equipments_hossa,
            ];
        }
        elseif ($randType == 2)
        {
            $new_equipments = rand(50, 80);
            $new_food = rand(1, 20);
            
            $new_equipments_hossa = $new_equipments > $this->equipments ? 1 : 0;
            $new_food_hossa = $new_food > $this->food ? 1 : 0;
            
            $arr = [
                'equipments' => $new_equipments_hossa,
                'food' => $new_food_hossa,
            ];
        }
        else
        {
            $new_raw_materials = rand(25, 50);
            $new_food = rand(1, 20);
            
            $new_raw_materials_hossa = $new_raw_materials > $this->raw_materials ? 1 : 0;
            $new_food_hossa = $new_food > $this->food ? 1 : 0;
            
            $arr = [
                'raw_materials' => $new_raw_materials_hossa,
                'food' => $new_food_hossa,
            ];
        }
        
        $this->update([
            'raw_materials' => $new_raw_materials,
            'raw_materials_hossa' => $new_raw_materials_hossa,
            'fabrics'  => $new_fabrics,
            'fabrics_hossa' => $new_fabrics_hossa,
            'equipments' => $new_equipments,
            'equipments_hossa' => $new_equipments_hossa,
            'food' => $new_food,
            'food_hossa' => $new_food_hossa
        ]);
        
        return $arr;
    }
}
