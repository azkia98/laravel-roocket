<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Article;
use App\Episode;

class TelegramController extends Controller {

    public function telegram() {
        $response = Telegram::setWebhook(['url' => 'https://22965ca1.ngrok.io/88905215:AAHwtR-_cZd16tcSn_-kKmP8kpM8L-Pik6o/webhook']);





        return Telegram::sendMessage([
                    'chat_id' => '83890025',
                    'text' => 'به ربات تلگرام خوش امدید'
        ]);
    }

    public function webhook() {
        Telegram::commandsHandler(true);

        switch (request('message.text')) {
            case 'اخرین مقالات':
                $this->lastArticles();
                break;
            case 'اخرین ویدئو های سایت':
                $this->lastEpisodes();
                break;
            case 'راهنمای استفاده از رباط نجفیان':
                $this->guide();
                break;
        }
    }

    public function lastArticles() {
        $articles = Article::latest()->take(5)->get();
        if ($articles) {
            $text = '';

            foreach ($articles as $article) {
                $text .= $article->title . PHP_EOL;
                $text .= url()->to($article->path());
            }
            Telegram::sendMessage([
                'chat_id' => request('message.chat.id'),
                'text' => $text,
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => request('message.chat.id'),
                'text' => 'مقاله ای برای نمایش وجود ندارد',
            ]);
        }
    }

    public function lastEpisodes() {
        $episodes = Episode::latest()->take(5)->get();
        if ($episodes) {
            $text = '';

            foreach ($episodes as $episode) {
                $text .= $episode->title . PHP_EOL;
                $text .= url()->to($episode->path());
            }
            Telegram::sendMessage([
                'chat_id' => request('message.chat.id'),
                'text' => $text,
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => request('message.chat.id'),
                'text' => 'مقاله ای برای نمایش وجود ندارد',
            ]);
        }
    }

    public function guide() {
        Telegram::sendMessage([
                'chat_id' => request('message.chat.id'),
                'text' => 'راهنمایی برای بات وجود ندارد دوست عزیز :)',
            ]);
    }

}
