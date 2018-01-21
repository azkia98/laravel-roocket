<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'resnumber',
        'price',
        'course_id',
        'payment'
    ];
    public function scopeSpanningPayment($query , $month , $paymen) {
        $query->selectRaw('monthname(created_at) month , count(*) published')
            ->where('created_at' , '>' , Carbon::now()->subMonth($month))
            ->wherePayment($paymen)
            ->groupBy('month')
            ->latest();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
