<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class Software extends Product
{
    use HasFactory;
    use Compoships;

    protected $table = 'softwares';

    protected $fillable = [
        'category',
        'payment',
        'price',
    ];

    public function prod_images(){
        return $this->hasMany(ProdImage::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }
}
