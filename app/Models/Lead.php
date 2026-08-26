<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    public const TYPE_TOUR_INQUIRY     = 'tour_inquiry';
    public const TYPE_ACTIVITY_INQUIRY = 'activity_inquiry';
    public const TYPE_CONTACT_INQUIRY  = 'contact_inquiry';
    public const TYPE_WHATSAPP_CLICK   = 'whatsapp_click';
    public const TYPE_PHONE_CLICK      = 'phone_click';

    /** Types that come from a click, not a submitted form. */
    public const CLICK_TYPES = [
        self::TYPE_WHATSAPP_CLICK,
        self::TYPE_PHONE_CLICK,
    ];

    public const TYPE_LABELS = [
        self::TYPE_TOUR_INQUIRY     => 'Tour inquiry',
        self::TYPE_ACTIVITY_INQUIRY => 'Activity inquiry',
        self::TYPE_CONTACT_INQUIRY  => 'Contact / B2B form',
        self::TYPE_WHATSAPP_CLICK   => 'WhatsApp click',
        self::TYPE_PHONE_CLICK      => 'Phone click',
    ];

    public const STATUS_LABELS = [
        'new'       => 'New',
        'contacted' => 'Contacted',
        'converted' => 'Converted',
        'closed'    => 'Closed',
    ];

    protected $fillable = [
        'type', 'source', 'status',
        'name', 'email', 'phone', 'nationality',
        'arrival_date', 'duration_days', 'adults', 'children', 'message',
        'tour_id', 'activity_id', 'item_title',
        'ip_address', 'browser', 'platform', 'device', 'user_agent',
        'page_url', 'referrer',
    ];

    protected $casts = [
        'arrival_date' => 'date',
        'adults'       => 'integer',
        'children'     => 'integer',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function isClick(): bool
    {
        return in_array($this->type, self::CLICK_TYPES, true);
    }
}
