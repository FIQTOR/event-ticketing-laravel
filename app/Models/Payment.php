<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * This model represents a payment made by a user for an event.
 * It contains information about the user, event, payment status,
 * total price, guest details, layout preferences, and a snap token.
 *
 * @package App\Models
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',     // The ID of the user making the payment
        'event_id',    // The ID of the event for which the payment is made
        'payment_id',  // The unique identifier for the payment
        'status',      // The current status of the payment (e.g., pending, completed)
        'total_price', // The total amount of the payment
        'guest',       // The number of guests associated with the payment
        'layout',      // The layout preference for the event
        'snap_token'   // The token used for payment processing
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the event associated with the payment.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    /**
     * Get the invoice associated with the payment.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'payment_id', 'id');
    }
}
