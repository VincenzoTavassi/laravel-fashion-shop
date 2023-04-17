<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;

class HomeController extends Controller
{
    public function homepage () {
        $shoes = Shoe::where('is_available', 1)->get();

        return view('guest.home', compact('shoes'));
    }

    public function showdetail(Request $request) {
        $shoe = Shoe::findOrFail($request->id);
        return view('guest.detail', compact('shoe'));
    }
}