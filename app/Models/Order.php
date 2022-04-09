<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    const PLACE_CLIENT = 1;
    const PLACE_CLINIC = 2;

    const STATUS_UNPAID = 1;
    const STATUS_LOCKED = 2;
    const STATUS_FINISHED = 3;

    protected $casts = [
        'total_price' => 'integer',
        'total_duration' => 'integer',
        'total_transport' => 'integer',
        'additional' => 'integer',
        'date' => 'date',
        'status' => 'integer',
        'finished_at' => 'datetime'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_user_id', 'id');
    }

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(User::class, 'midwife_user_id', 'id');
    }

    public function testimonial(): HasOne
    {
        return $this->hasOne(Testimonial::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class);
    }

    public function scopeInClient($query)
    {
        $query->where('place', self::PLACE_CLIENT);
    }

    public function scopeInClinic($query)
    {
        $query->where('place', self::PLACE_CLINIC);
    }

    public function scopeUnpaid($query)
    {
        $query->where('status', self::STATUS_UNPAID);
    }

    public function scopeLocked($query)
    {
        $query->where('status', self::STATUS_LOCKED);
    }

    public function scopefinished($query)
    {
        $query->where('status', self::STATUS_FINISHED);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function pendingPayments(): HasMany
    {
        return $this->hasMany(Payment::class)->where('status', Payment::STATUS_UNVERIFIED);
    }

    public function verifiedPayments(): HasMany
    {
        return $this->hasMany(Payment::class)->where('status', Payment::STATUS_VERIFIED);
    }

    public function grand_total()
    {
        return ($this->total_price + $this->total_transport + $this->additional);
    }

    public function payments_verified()
    {
        return $this->payments()->verified()->pluck('value')->sum();
    }

    public function paid()
    {
        return $this->payments_verified() >= $this->grand_total();
    }

    public function dp()
    {
        return $this->payments_verified() >= $this->grand_total() * 50/100;
    }

    public function dp_amount()
    {
        return $this->grand_total() / 2;
    }

    public function place()
    {
        return $this->place === self::PLACE_CLIENT ? 'Homecare' : 'Onsite';
    }

    public function status()
    {
        return $this->status === self::STATUS_FINISHED
            ? 'Selesai'
            : ( $this->status === self::STATUS_LOCKED
                ? 'Aktif'
                : 'Pending'
            );
    }

    public function remaining_payment()
    {
        return $this->grand_total() - $this->verifiedPayments->pluck('value')->sum();
    }

    public function setNoRegdAttribute()
    {
        $this->attributes['no_reg'] = rand(1,9). time() . rand(00001,9999);
    }

    public function setInvoiceAttribute()
    {
        $this->attributes['invoice'] = 'INV/' . str_replace('-', '', today()->toDateString()) . '/BBC/'. rand(1111111111, 9999999999);
    }

    public function scopeActiveBetween($query, $from, $to)
    {
        $query->whereStatus(Order::STATUS_LOCKED)
            ->betweenDates($from, $to);
    }

    public function scopeBetweenTime($query, $from, $to)
    {
        $query->where(function ($query) use ($to, $from) {
            $query
                ->whereBetween('start_time', [$from, $to])
                ->orWhereBetween('end_time', [$from, $to])
                ->orWhere(function ($query) use ($to, $from) {
                    $query
                        ->where('start_time', '<', $from)
                        ->where('end_time', '>', $to);
                });
        });
    }

}
