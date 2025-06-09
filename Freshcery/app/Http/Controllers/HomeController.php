<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Category;

class HomeController extends Controller
{
    public function __construct()
    {
        // Remove this if you want the homepage visible to all users
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('home', compact('categories'));
    }
}
