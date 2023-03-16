<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class ProductQuotation extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'product_quotation';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_id','email','name','user_id','cellphone','quantity','address','date_delivery','observations','state','price_finish','price_shiping','comment','deny','user_request_id'
    ];

    
    protected $guard_name = 'web';

    public function getEncodeIDAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function producto()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function history()
    {
        return $this->hasMany(ProductQuotationHistory::class, 'quotation_id')->orderBy('id','ASC');
    }

   

}
