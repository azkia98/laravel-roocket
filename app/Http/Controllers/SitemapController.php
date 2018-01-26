<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class SitemapController extends Controller {

    public function index() {
        $sitemap = app()->make('sitemap');
        $sitemap->setCache('laravel.sitemap', 30);
        if (!$sitemap->isCached())
            $sitemap->add(url('/fa/sitemap-articles'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
        return $sitemap->render();
    }

    public function articles() {
        $sitemap = app()->make('sitemap');
        $sitemap->setCache('laravel.sitemap.articles', 30);

        if (!$sitemap->isCached()) {

            $articles = \App\Article::latest()->get();
            foreach ($articles as $article)
                $sitemap->addSitemap(url($article->path()), '2012-08-25T20:10:00+02:00');
        }

        return $sitemap->render('sitemapindex');
    }

}
