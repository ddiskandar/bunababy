<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS_UNPAID = 1;
    const STATUS_LOCKED = 2;
    const STATUS_FINISHED = 3;

    protected $casts = [
        'total_price' => 'integer',
        'total_duration' => 'integer',
        'total_transport' => 'integer',
        'adjustment_amount' => 'integer',
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'status' => 'integer',
        'finished_at' => 'datetime'
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_user_id', 'id');
    }

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(User::class, 'midwife_user_id', 'id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class)
            ->withPivot('family_name', 'family_age', 'treatment_price', 'treatment_duration')
            ->withTimestamps();
    }

    public function testimonial(): HasOne
    {
        return $this->hasOne(Testimonial::class);
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

    public function getStatusString()
    {
        return $this->status === self::STATUS_FINISHED
            ? 'Selesai'
            : ($this->status === self::STATUS_LOCKED
                ? 'Aktif'
                : 'Pending'
            );
    }

    public function scopeActiveBetween($query, $from, $to)
    {
        $query->whereStatus(Order::STATUS_LOCKED)
            ->betweenTimes($from, $to);
    }

    public function scopeBetweenTimes($query, $from, $to)
    {
        $query->where(function ($query) use ($to, $from) {
            $query
                ->whereBetween('start_datetime', [$from, $to])
                ->orWhereBetween('end_datetime', [$from, $to])
                ->orWhere(function ($query) use ($to, $from) {
                    $query
                        ->where('start_datetime', '<', $from)
                        ->where('end_datetime', '>', $to);
                });
        });
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

    public function getVerifiedPayments()
    {
        return $this->payments()->verified()->pluck('value')->sum();
    }

    public function isPaid()
    {
        return $this->getVerifiedPayments() >= $this->getGrandTotal();
    }

    public function dp()
    {
        return $this->getVerifiedPayments() >= $this->getGrandTotal() * 50 / 100;
    }

    public function getDpAmount()
    {
        return $this->getGrandTotal() / 2;
    }

    public function getRemainingPayment()
    {
        return $this->getGrandTotal() - $this->verifiedPayments->pluck('value')->sum();
    }

    public function getGrandTotal()
    {
        return ($this->total_price + $this->total_transport + $this->adjustment_amount);
    }

    // Create Order

    public function numberStartTime()
    {
        return session('order.place_id') . sprintf('%02d', session('order.midwife_user_id')) . session('order.start_time')[0] . session('order.start_time')[1] . session('order.start_time')[3] . session('order.start_time')[4];
    }

    public function getNoReg()
    {
        return time();
        // return session('order.date')->isoFormat('YYMMDD') . $this->numberStartTime();
    }

    public function getInvoice()
    {
        return 'INV/' . session('order.date')->isoFormat('YYMMDD') . '/BBC/' . $this->getNoReg();
    }

    public function getTotalTransport()
    {
        $place = Place::find(session('order.place_id'));
        throw_if(!$place, \Exception::class, 'Place not found');

        if ($place->type === Place::TYPE_HOMECARE) {
            return calculate_transport(session('order.kecamatan_distance'));
        }

        return 0;
    }

    public function getTotalPrice()
    {
        return collect(session('order.treatments'))->sum('treatment_price') ?? 0;
    }

    public function getTotalDuration()
    {
        $default = 0;

        if (session('order.place_type') === Place::TYPE_HOMECARE) {
            $default = DB::table('options')->select('transport_duration')->first()->transport_duration;
        }
        return collect(session('order.treatments'))->sum('treatment_duration') + $default;
    }

    public function getStartTime()
    {
        return DB::table('slots')->where('id', session('order.start_time_id'))->value('time');
    }

    public function getEndTime()
    {
        return Carbon::parse($this->getStartTime())->addMinutes(session('order.addMinutes'))->toTimeString();
    }

    public function getTime()
    {
        return $this->start_datetime->isoFormat('HH:mm') . ' - ' . $this->end_datetime->isoFormat('HH:mm');
    }
}
