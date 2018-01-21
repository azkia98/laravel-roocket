<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivationCode extends Model
{
    protected $fillable = ['user_id' , 'code' , 'used' , 'expire'];

    public function scopeCreateCode($query , $user)
    {
        $code = $this->code();

        return $query->create([
            'user_id' => $user->id,
            'code' => $code,
            'expire' => Carbon::now()->addMinutes(15)
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    private function code()
    {
        do {
            $code = Str::random(60);
            $check_code = static::whereCode($code)->get();
        } while( ! $check_code->isEmpty() );

        return $code;
    }
}
