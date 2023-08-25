<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'name',
        'slugs',
        'description',
        'top_id',
        'icon',
        'status',
        'send_info',
        'order_a',
        'showondashboard'
    ];
    protected $casts = [
        'name' => 'json',
        'slugs' => 'json',
        'description' => 'json',
        'top_id' => 'integer',
        'status' => "boolean",
        'send_info' => "boolean",
        'order_a' => "integer",
        'showondashboard'=>"boolean"
    ];
    public function top_service()
    {
        return $this->belongsTo(Services::class);
    }
    public function alt_services(){
        return $this->hasMany(Services::class,'top_id','id');
    }
    public function users()
    {
        return $this->hasMany(UserServices::class, 'service_id', 'id');
    }
    public function attributes(){
        return $this->hasMany(ServiceAttributes::class,'service_id','id')->orderBy('order_a','ASC');
    }

}
