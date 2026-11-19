<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BillingMeteranController extends Controller
{
    public function index(Request $request): View
    {
        return view('billing-meteran', [
            'activePage' => $request->is('meteran') ? 'meteran' : 'tagihan',
        ]);
    }
}
