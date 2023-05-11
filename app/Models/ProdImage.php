<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class ProdImage extends Model
{
    use HasFactory;
    use Compoships;

    public $table = 'prod_images';

    public function hwProd(){
        return $this->hasOne(Hardware::class ,  ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }

    public function swProd(){
        return $this->hasOne(Software::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }

    public function svProd(){
        return $this->hasOne(Service::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }

    public function crProd(){
        return $this->hasOne(Course::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }
}
