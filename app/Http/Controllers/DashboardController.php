<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        if(auth()->user()->hasRole('Admin')) {
            $totalTickets = Ticket::count();
            $openTickets = Ticket::where('status', 'Open')->count();
            $closedTickets = Ticket::where('status', 'Closed')->count();
            $latestTickets = Ticket::orderBy('created_at', 'desc')->take(5)->get();
        }
        else{
            $totalTickets = Ticket::where('user_id', auth()->user()->id)->count();
            $openTickets = Ticket::where('user_id', auth()->user()->id)->where('status', 'Open')->count();
            $closedTickets = Ticket::where('user_id', auth()->user()->id)->where('status', 'Closed')->count();
            $latestTickets = Ticket::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        }

        return view('dashboard', compact('totalTickets','openTickets', 'closedTickets', 'latestTickets'));
    }
}
