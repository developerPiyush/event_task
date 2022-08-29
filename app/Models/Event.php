<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['week', 'duration'];

    public function getWeekAttribute()
    {
        if ($this->recurrence_time == 1) {
            return 'First';
        } elseif ($this->recurrence_time == 2) {
            return 'Second';
        } elseif ($this->recurrence_time == 3) {
            return 'Third';
        } elseif ($this->recurrence_time == 4) {
            return 'Fourth';
        }
    }

    public function getDurationAttribute()
    {
        if ($this->recurrence_duration == 1) {
            return 'Day';
        } else if ($this->recurrence_duration == 2) {
            return 'Week';
        } else if ($this->recurrence_duration == 3) {
            return 'Month';
        } else if ($this->recurrence_duration == 4) {
            return 'Year';
        }
    }
}
