<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'header',
        'desc',
    ];
    
    protected $hidden = [
        'prod_category',
    ];
}