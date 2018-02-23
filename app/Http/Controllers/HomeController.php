<?php

namespace App\Http\Controllers;

use App\Auto;
use App\Client;
use App\Reglement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$infos['clients'] = Client::all()->count();
		$infos['autos'] = Auto::all()->count();
		
		$reglements = Reglement::forDate(Carbon::now()->format('Y-m-d'))->get();
        return view('home',compact('infos','reglements'));
    }
}
