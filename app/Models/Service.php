<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class Service extends Product
{
    use HasFactory;
    use Compoships;

    public $table = 'services';

    protected $fillable = [
        'page',
    ];

    public function prod_images(){
        return $this->hasMany(ProdImage::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }

    public function OrderItem(){
        return $this->hasMany(OrderList::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }

    public function Reviews(){
        return $this->hasMany(Review::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }
}
