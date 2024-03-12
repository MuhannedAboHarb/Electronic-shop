<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function products()
{
    return $this->belongsToMany(
        Product::class,   //Related Model
        'product_tag',   //pivot table name 
        'tag_id',       //Carrent model FK in pivot table
        'product_id',   //Related model FK in pivot table
        'id',           //Local (PK)  current model
        'id'            //Local (PK)  related model
    );
}
}
