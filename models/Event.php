<?php namespace Taema\BandTourEvents\Models;

use Carbon\Carbon;
use Model;
use October\Rain\Database\Builder;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'taema_bandtourevents_events';

    public function getLocationAttribute()
    {
        return implode(', ', array_filter([
            $this->city,
            $this->region,
            $this->country
        ]));
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function scopeUpcoming(Builder $query)
    {
        return $query->whereDate('datetime', '>=', Carbon::today());
    }

    public function scopePast(Builder $query)
    {
        return $query->whereDate('datetime', '<', Carbon::today())
            ->orderBy('datetime', 'desc');
    }

    /**
     * Tries to extract YouTube video id if a full YouTube url was given
     *
     * @param $value
     */
    public function setYoutubeUrlAttribute($value)
    {
        preg_match(
            '/(?:https?:)?(?:\/\/)?(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\S*?[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:[\'"][^<>]*>|<\/a>))[?=&+%\w.-]*/',
            $value,
            $matches
        );

        $this->attributes['youtube_url'] = (isset($matches[1])) ? $matches[1] : $value;
    }

    public $belongsTo = [
        'gallery' => '\Raviraj\Rjgallery\Models\Gallery'
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];
}
