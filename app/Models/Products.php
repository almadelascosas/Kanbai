<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Products extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','name','price_min','price_max','quantity_min','delivery_time','shipping_price','description','shipping_free','user_id'
    ];

  
   
        
    protected $searchable = [
        'columns' => [
          'name.title' => 5,
        ]
    ];

    protected $guard_name = 'web';

    public function getEncodeIDAttribute()
    {
        return Hashids::encode($this->id);
    }
    public function gallery()
    {
        return $this->hasMany(ProductsGallery::class, 'product_id')->orderBy('id','ASC');
    }

    public function questions()
    {
        return $this->hasMany(ProductsQuestions::class, 'product_id');
    }

    

    public function productcategories()
    {
        return $this->hasMany(ProductsCategories::class, 'product_id');
    }

    public function category()
    {
        return $this->productcategories->belongsTo(Categories::class,'category_id');
    }

    public function productsubcategories()
    {
        return $this->hasMany(ProductsSubcategories::class, 'product_id');
    }

    public function subcategory()
    {
        return $this->productsubcategories->belongsTo(SubCategories::class,'subcategory_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
