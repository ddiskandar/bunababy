<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        'status' => 'integer',
        'finished_at' => 'datetime',
        'startDateTime' => 'datetime',
        'endDateTime' => 'datetime',
    ];

    protected static function booted(): void
    {
        parent::boot();

        static::created(function ($order) {
            $order->invoice = 'INV/' . $order->startDateTime->isoFormat('YYMMDD') . '/' . $order->id;
            $order->save();
        });
    }

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

    public function getStartDateTimeAttribute()
    {
        return Carbon::parse(Carbon::parse($this->date)->toDateString() . ' ' . $this->start_time);
    }

    public function getEndDateTimeAttribute()
    {
        return Carbon::parse(Carbon::parse($this->date)->toDateString() . ' ' . $this->end_time)
            ->addMinutes($this->place->transport_duration);
    }

    public function getStatusString()
    {
        $ref = [
            self::STATUS_FINISHED => 'Selesai',
            self::STATUS_LOCKED => 'Aktif',
            self::STATUS_UNPAID => 'Pending',
        ];

        return $ref[$this->status];
    }

    public function scopeActiveBetween($query, $from, $to)
    {
        $query->whereStatus(Order::STATUS_LOCKED)
            ->betweenTimes($from, $to);
    }

    public function scopeBetweenTimes($query, $from, $to)
    {
        $query->where(function ($query) use ($from, $to) {
            $query
                ->whereBetween('start_time', [$from, $to])
                ->orWhereBetween('end_time', [$from, $to])
                ->orWhere(function ($query) use ($from, $to) {
                    $query
                        ->where('start_time', '<', $from)
                        ->where('end_time', '>', $to);
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
        return $this->total_price + $this->total_transport + $this->adjustment_amount;
    }

    public function numberStartTime()
    {
        return session('order.place_id')
            . sprintf('%02d', session('order.midwife_user_id'))
            . session('order.start_time')[0]
            . session('order.start_time')[1]
            . session('order.start_time')[3]
            . session('order.start_time')[4];
    }

    public function getTotalTransport()
    {
        $place = Place::find(session('order.place_id'));
        throw_if(!$place, \Exception::class, 'Place not found');

        if ($place->type === Place::TYPE_HOMECARE) {
            return calculateTransport(session('order.kecamatan_distance'));
        }

        return 0;
    }

    public function getTotalPrice()
    {
        return collect(session('order.treatments'))->sum('treatment_price') ?? 0;
    }

    public function getTotalDuration()
    {
        return collect(session('order.treatments'))
            ->sum('treatment_duration') + session('order.place_transport_duration');
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
        return Carbon::parse($this->start_time)->isoFormat('HH:mm') . ' - ' . Carbon::parse($this->end_time)
            ->isoFormat('HH:mm');
    }

    public function getLongTime()
    {
        return $this->getTime(). ' WIB';
    }

    public function getLongDate()
    {
        return Carbon::parse($this->date)->isoFormat('dddd, DD MMMM YYYY');
    }

    public function getShortDate()
    {
        return Carbon::parse($this->date)->isoFormat('ddd, DD MMM');
    }

    public function getLongDateTime()
    {
        return $this->getLongDate() . ' ' . $this->getLongTime();
    }

}
