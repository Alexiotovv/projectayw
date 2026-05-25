<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'instructions',
        'qr_image_path',
        'bank_name',
        'bank_account_holder',
        'bank_account_number',
        'bank_account_cci',
        'gateway_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
