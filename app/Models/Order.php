<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\PlaceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $casts = [
        'total_price' => 'integer',
        'total_duration' => 'integer',
        'total_transport' => 'integer',
        'adjustment_amount' => 'integer',
        'status' => OrderStatus::class,
        'finished_at' => 'datetime',
        'startDateTime' => 'datetime',
        'endDateTime' => 'datetime',
    ];

    public function getInvoice()
    {
        return 'INV/' . $this->startDateTime->isoFormat('YYMMDD') . '/' . $this->id;
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
        return $this->belongsTo(Client::class);
    }

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(Midwife::class);
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

    public function scopeUnpaid($query)
    {
        $query->where('status', OrderStatus::UNPAID);
    }

    public function scopeLocked($query)
    {
        $query->where('status', OrderStatus::LOCKED);
    }

    public function scopefinished($query)
    {
        $query->where('status', OrderStatus::FINISHED);
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

    public function scopeActiveBetween($query, $from, $to)
    {
        $query->whereStatus(OrderStatus::LOCKED)
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
        return $this->hasMany(Payment::class)->where('status', PaymentStatus::UNVERIFIED);
    }

    public function verifiedPayments(): HasMany
    {
        return $this->hasMany(Payment::class)->where('status', PaymentStatus::VERIFIED);
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


    // Creating Record

    public function numberStartTime()
    {
        return session('order.place_id')
            . sprintf('%02d', session('order.midwife_id'))
            . session('order.start_time')[0]
            . session('order.start_time')[1]
            . session('order.start_time')[3]
            . session('order.start_time')[4];
    }

    public function getTotalTransport()
    {
        $place = Place::find(session('order.place_id'));
        throw_if(!$place, \Exception::class, 'Place not found');

        if ($place->type === PlaceType::HOMECARE) {
            // return calculateTransport(session('order.kecamatan_distance'));
        }

        return 0;
    }

    public function getTotalPrice()
    {
        return collect(session('order.treatments'))->sum('treatment_price') ?? 0;
    }

    public function getTotalDuration()
    {
        return collect(session('order.treatments'))->sum('treatment_duration');
    }

    public function getStartTime()
    {
        return DB::table('slots')->where('id', session('order.start_time_id'))->value('time');
    }

    public function getEndTime()
    {
        return Carbon::parse($this->getStartTime())->addMinutes(session('order.addMinutes'))->toTimeString();
    }
}
