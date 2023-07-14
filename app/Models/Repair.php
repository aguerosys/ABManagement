<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'code',
        'description',
        'details',
        'price',
        'category',
        'client',
        'status'
    ];

    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    /* public function category(){
        return $this->belongsTo(Category::class);
    } */
}
