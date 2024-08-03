<?php

namespace App\Models;

use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // ####   Mutators   ####

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = ucwords($value);
    // }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // ####  Accessors  ####

    public function getDobAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }
    public function getSalaryAttribute($value)
    {
        return Number::currency($value, in:'PKR');
    }

    // Laravel New Format method here
    protected function Name():Attribute{
        // add class attribute import herer
        return Attribute::make(
           get:fn(string $value)=>ucwords($value),
           set:fn(string $value)=>strtolower($value),
        );
    }
}
