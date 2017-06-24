<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AuditRepository as Audit;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Redirect;
use Setting;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    //
    /**
     * @param Application $app
     * @param Audit $audit
     */
    public function __construct()
    {
        session(['crumbtrail.leaf' => 'news']);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $homeRouteName = 'news';

        // try {
        //     $homeCandidateName = Setting::get('app.news_route');
        //     $homeRouteName = $homeCandidateName;
        // }
        // catch (Exception $ex) { } // Eat the exception will default to the welcome route.

        // $request->session()->reflash();
        // return Redirect::route($homeRouteName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsstream(Request $request)
    {
        $page_title = trans('general.text.newsstream');
        $page_description = "This is the news stream page";

//        $request->flashExcept(['password', 'password_confirmation']);
        $request->session()->reflash();
        return view('newsstream', compact('page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsfeed(Request $request)
    {
        $page_title = trans('general.text.newsfeed');
        $page_description = "This is the newsfeed page";

        $feed = simplexml_load_file('http://rss.nytimes.com/services/xml/rss/nyt/World.xml');

        // var_dump($feed->channel);
        $title = $feed->channel->title;
        $copyRight = $feed->channel->copyright;
        $lastBuildDate = $feed->channel->lastBuildDate; //feed last build date                                        
        $image = $feed->channel->image;
        $imageTitle = $image->title;
        $imageURL = $image->url;
        $imageLink = $image->link;

        $worldfeeds = [];
        for ($i=0; $i < 5; $i++) { 
            # code...
            $worldfeeds[$i] = $feed->channel->item[$i];
        }

        $feedDescription = ['title'=>$title, 'copyRight'=>$copyRight, 'lastBuildDate'=>$lastBuildDate, 'image'=>$image,'worldfeeds'=>$worldfeeds];

        $request->session()->reflash();
        //return view::make('feeds')->with('worldfeeds', $worldfeeds);
        if (View::exists('feeds')) {
            #code...
            // return view('feeds')->with('feedDescription', $feedDescription);
            //return view('feeds', $feedDescription);
            return view('feeds', compact('page_title', 'page_description'))->with($feedDescription);
        }
        var_dump('Cannot find the right view');
    }
}
