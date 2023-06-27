<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'repair_id'
    ];

    public function client()
    {
        return $this->belongsToMany(Client::class, 'id');
    }

    public function repair()
    {
        return $this->belongsToMany(Repair::class, 'id');
    }
}
