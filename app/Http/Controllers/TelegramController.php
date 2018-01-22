<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class TelegramController extends Controller {

    public function telegram() {
//        return Telegram::getUpdates();
        for ($i=0; $i <= 100; $i++)
            Telegram::sendMessage([
                'chat_id' => '83890025',
                'text' => 'به ربات تلگرام خوش امدید'
            ]);
    }

}
