<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'order_number',
        'total',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($q) {
            $inv = $q->whereNotNull('order_number')->latest()->first();
            $prefix = 'rim';
            if ($inv) {
                $number = $prefix . '-' . str_pad($inv->id, 6, '0', STR_PAD_LEFT);
            } else {
                $number = $prefix . '-' . str_pad(1, 6, '0', STR_PAD_LEFT);
            }
            $q->order_number = $number;
            $q->uuid = Str::uuid();
        });
    }

    public function transaction_item()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
