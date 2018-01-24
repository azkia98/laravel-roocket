<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command {

    protected $name = 'start';
    protected $description = 'شروع کار با ربات نجفیان';

    public function handle($arguments) {
        $text = 'به ربات تلگرام خوش آمدید';
//        $this->replyWithMessage(compact('text'));
        $keyboard = [
                ['اخرین مقالات', 'اخرین ویدئو های سایت'],
                ['راهنمای استفاده از رباط نجفیان']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
        'keyboard' => $keyboard,
        'resize_keyboard' => true,
        'one_time_keyboard' => true
        ]);
        
        Telegram::sendMessage([
            'chat_id'=> request('message.chat.id'),
            'text'=>$text,
            'reply_markup'=>$reply_markup
        ]);
    }

}
