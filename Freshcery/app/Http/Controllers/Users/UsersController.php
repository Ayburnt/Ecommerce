<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product\Order;
use App\Models\User;


class UsersController extends Controller
{
    public function myOrders(){
        $orders = Order::select()->where('user_id', Auth::user()->id)->get();
        return view('users.myorders', compact('orders'));
    }

    
    public function settings(){
        $user = User::find(Auth::user() -> id);
        return view('users.settings', compact('user'));
    }

    
}
