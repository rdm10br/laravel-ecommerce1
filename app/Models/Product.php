<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table='products'; //nome da tabela

    protected $fillable = [
        'name','quantity','cost','description'
    ];
}
