<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Awobaz\Compoships\Compoships;

class Hardware extends Product
{
    use HasFactory;
    use Compoships;
    
    protected $table = 'hardwares';

    protected $fillable = [
        'datasheet',
        'category',
    ];

    public function prod_images(){
        return $this->hasMany(ProdImage::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }

    public function OrderItem(){
        return $this->hasMany(OrderList::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }
}
