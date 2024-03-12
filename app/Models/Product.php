<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes ;

    protected $fillable = [
        'name' , 'slug' , 'description' , 'category_id' , 'price' , 'compare_price' , 'cost',
        'quantity', 'availabillty' , 'status' , 'image' , 'sku' , 'barcode'
    ];


    public static function booted()
    {
        static::forceDeleted(function($product){
            if($product->image)
            {
                Storage::disk('uploads')->delete($product->image);
            }
        });

        static::saving(function($product){
            $product->slug=Str::slug($product->name);
        });
    }


    //Inverse One to Many : Product Belongs To Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id' , 'id');
        // return $this->belongsTo(Category::class);
    }


    public static function statusOptions()
    {
     return [
        'active' => 'Active',
        'draft'=>'Draft',
        'archived'=> 'Archived'
     ];
    }


    public static function availabillties()
    {
        return [
            'in-stock'=>'In Stock',
            'out-of-stock'=> 'Out Of Stock',
            'back-order'=> 'Back Order'
        ];
    }


    public function getImageUrlAttribute()
{
    if (! $this->image) {
        return asset('images/defluat.jpg');
    }

    if (Str::startsWith($this->image, ['http://', 'https://'])) {
        return $this->image;
    }

    return asset('uploads/' . $this->image);
}


// public function setNameAttribute($value)
// {
//     $this->attributes['name']=Str::upper($value);
// }


public function getDiscountPercentAttribute()
{
    if(! $this->compare_price)
    {
        return 0 ;
    }
    return number_format( ($this-> price - $this->compare_price ) / $this->compare_price * 100, 2) ;
}

// Many-to-Many: Product has  many tags
public function tags()
{
    return $this->belongsToMany(
        Tag::class, //Related Model
        'product_tag', //pivot table name 
        'product_id', //Carrent model FK in pivot table
        'tag_id', //Related model FK in pivot table
        'id', //Local (PK)  current model
        'id' //Local (PK)  related model
    );
}


public function cartUsers()
{
    return  $this->belongsToMany(
    User::class , 
        'carts' ,
        'product_id' ,
         'user_id' ,
         'id' ,
         'id' ,
    );
}

public function getUrlAttribute()
{
    return  route('products.show', [$this->category->slug, $this->slug]);
}

}
