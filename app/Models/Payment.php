<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['booking_id', 'amount', 'payment_date', 'payment_method', 'payment_status', 'transaction_id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('payment_method', 'like', '%' . $s . '%')
            ->orWhere('payment_status', 'like', '%' . $s . '%')
            ->orWhere('transaction_id', 'like', '%' . $s . '%');
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['search'] ?? false) {
            $query->search($filters['search']);
        }
    }

}
