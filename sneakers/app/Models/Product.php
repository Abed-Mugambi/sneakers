<?php

namespace App\Models;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'detail', 'price', 'stock', 'discount'];
    // protected $fillable = ['detail'];


    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }




}
