<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdditionals extends Model
{
    use HasFactory;
    protected $table='user_additionals';
    protected $fillable=[
        'user_id',
        'company_name',
        'company_owner_name',
        'company_legal_owner',
        'company_version',
        'company_description',
        'company_voen',
        'company_logo',
        'activity_area',
        'original_password',
        'registry_date',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
