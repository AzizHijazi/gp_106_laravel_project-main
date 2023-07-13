<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $rentCount = Rent::where('hub_id', $user->id)->count();
        return response()->view('dashboard.home.index', ['rentCount' => $rentCount]);
    }

}
