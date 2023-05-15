<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Awobaz\Compoships\Compoships;

class Course extends Product
{
    use Compoships;
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'period',
        'prof',
        'price',
        'category',
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
