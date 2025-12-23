<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Display the user's bookings page.
     */
    public function index(Request $request)
    {
        $firebaseUid = session('firebase_uid');
        
        return view('bookings.index', compact('firebaseUid'));
    }
}
