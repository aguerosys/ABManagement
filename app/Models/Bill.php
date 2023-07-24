<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'number_bill',
        'date_bill',
        'total_bill'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class);
    }

}
