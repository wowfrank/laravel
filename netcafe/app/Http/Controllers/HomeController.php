<?php

namespace Netcafe\Http\Controllers;

use Illuminate\Http\Request;

use Netcafe\Http\Requests;
use Netcafe\Http\Controllers\Controller;

use Netcafe\Models\Cover;
use Netcafe\Models\Activity;
use Netcafe\Models\Posts;
use Netcafe\Models\Team;
use Netcafe\Models\Message;

class HomeController extends Controller
{
    //
    public function index() {
    	$covers = Cover::where('active', '1')->take(config('home.numOfSlide'))->orderBy('created_at', 'desc')->get();

    	$activities = Activity::take(config('home.numOfActivity'))->orderBy('created_at', 'desc')->get();

    	$blogs = Posts::take(config('home.numOfBlog'))->orderBy('created_at','desc')->get();

    	$teams = Team::where('status', 1)->take(config('home.numOfTeam'))->orderBy('created_at', 'desc')->get();

    	$messages = Message::take(config('home.numOfMessage'))->orderBy('created_at', 'desc')->get();

    	$activityRand = Activity::getRandomNum(1, count($activities));

    	return view('index', compact('covers', 'activities', 'blogs', 'teams', 'messages', 'activityRand'));
    }
}
