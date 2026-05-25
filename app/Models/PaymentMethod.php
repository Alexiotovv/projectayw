<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function getQrImageUrlAttribute(): ?string
    {
        if (empty($this->qr_image_path)) {
            return null;
        }

        $path = str_replace('\\', '/', trim($this->qr_image_path));

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        if (Str::startsWith($path, '/storage/')) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return '/' . ltrim($path, '/');
        }

        if (Str::startsWith($path, 'public/')) {
            $path = Str::after($path, 'public/');
        }

        return Storage::url(ltrim($path, '/'));
    }
}
