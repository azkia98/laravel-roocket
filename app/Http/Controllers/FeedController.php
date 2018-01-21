<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class FeedController extends Controller {

    public function articles() {
        
        $feed = app()->make('feed');

        $feed->setCache(1, 'laravel.feed.article');

        if (!$feed->isCached()) {
            $articles = Article::latest()->take(10)->get();
            foreach ($articles as $article)
                $feed->add($article->title, $article->user->name, url($article->slug), $article->created_at, strip_tags ($article->description), strip_tags ($article->body));
        }

        return $feed->render('rss');
    }

}
