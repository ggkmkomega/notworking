<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    ];

    public function prod_images(){
        return $this->hasMany(ProdImage::class, ['prod_id', 'prod_category'], ['id', 'prod_category']);
    }
}
