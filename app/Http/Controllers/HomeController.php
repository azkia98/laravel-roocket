<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Course;
use SEO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    public function index()
    {
        $local=app()->getLocale();
        cache()->flush();
        SEO::setTitle(__('messages.title'));
        SEO::setDescription('وسایت آموزشی');

        if(cache()->has("articles|{$local}")) {
            $articles = cache('articles|'.$local);
        } else {
            $articles = Article::whereLang($local)->latest()->take(8)->get();
            cache(['articles|'.$local => $articles] , Carbon::now()->addMinutes(10));
        }

        if(cache()->has('courses')) {
            $courses = cache('courses');
        } else {
            $courses = Course::latest()->take(4)->get();
            cache(['courses' => $courses] , Carbon::now()->addMinutes(10));
        }

        return view('Home.index' , compact('articles' , 'courses'));
    }


    public function comment()
    {
        $this->validate(request(),[
            'comment' => 'required|min:5'
        ]);

//        Comment::create(array_merge([
//            'user_id' => auth()->user()->id
//        ], \request()->all()));

        auth()->user()->comments()->create(\request()->all());
        return back();
    }
}
