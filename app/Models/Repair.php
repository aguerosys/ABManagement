<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'code',
        'client_id',
        'description',
        'details',
        'price',
        'category',
        'status'
    ];

    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    /* public function category(){
        return $this->belongsTo(Category::class);
    } */
}
