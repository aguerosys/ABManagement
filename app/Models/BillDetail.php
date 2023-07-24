<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'product',
        'quantity',
        'unit_price',
        'sub_total'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
