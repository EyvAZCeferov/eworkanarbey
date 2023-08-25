<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'title',
        'description',
        'open_hours',
        'social_media',
        'favicon',
        'logo_dark_mode',
        'logo_light_mode'
    ];
    protected $casts = [
        'title'=>'json',
        'description'=>'json',
        'open_hours'=>'json',
        'social_media'=>'json',
    ];
}
