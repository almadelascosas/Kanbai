<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Projects extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'projects';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type','id_type','name','ubication','price','quantity','delivery_date','state','price_delivery','user_request_id','iva'
    ];


         
  
    protected $guard_name = 'web';

    public function getEncodeIDAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function timeline()
    {
        return $this->hasMany(ProjectTimeLine::class, 'project_id')->orderBy('id','ASC');
    }

    public function chat()
    {
        return $this->hasMany(ProjectChat::class, 'project_id')->orderBy('id','ASC');
    }

    


}
