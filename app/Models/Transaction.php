<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'donor_name',
        'mobile',
        'email',
        'campaign_id',
        'receipt_number',
        'amount',
        'payment_status',
        'payment_response'
    ];
}
