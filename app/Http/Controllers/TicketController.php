<?php

namespace App\Http\Controllers;

use App\Mail\CloseTicketMail;
use App\Mail\CreateTicketMail;
use App\Mail\TicketResponseMail;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->hasRole('Admin')) {
            $tickets = Ticket::orderBy('status', 'asc')->get();
        }
        else {
            $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        }
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (auth()->user()->can('ticket-create')) {
            return view('tickets.create');
        }
        else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('ticket-create')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
            ]);

            try {

                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $filename);
                }

                $ticket = new Ticket();
                $ticket->user_id = auth()->user()->id;
                $ticket->title = $request->title;
                $ticket->ticket_number = rand(100000, 999999);
                $ticket->description = $request->description;
                $ticket->file = $filename ?? null;
                $ticket->save();

                // Send email to admin
                Mail::to("admin@example.com")->queue(new CreateTicketMail($ticket));
                Toastr::success('success', 'Ticket created successfully');
                return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
            }
            catch (\Exception $e) {
                Toastr::error('An error occurred: ' . $e->getMessage());
                return redirect()->back();
            }
        }
        else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        try {
            $ticket_responses = TicketResponse::where('ticket_id', $ticket->id)->get();
            return view('tickets.show', compact('ticket', 'ticket_responses'));
        } catch (\Exception $e) {
            Toastr::error('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        if(auth()->user()->can('ticket-update')) {
            $ticket_responses = TicketResponse::where('ticket_id', $ticket->id)->get();
            return view('tickets.edit', compact('ticket', 'ticket_responses'));
        }
        else {
            abort(403, 'Unauthorized action.');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {

            $request->validate([
                'status' => 'required',
                'message' => 'required',
                'ticket_id' => 'required',
            ]);
            try {
                // Save Response
                $ticket_reply = new TicketResponse();
                $ticket_reply->ticket_id = $request->ticket_id;
                $ticket_reply->user_id = auth()->user()->id;
                $ticket_reply->message = $request->message;
                $ticket_reply->save();

                // Update Ticket
                $ticket->status = $request->status;
                $ticket->save();

                if($ticket->status == 'closed') {
                    // Send email to customer
                    Mail::to($ticket->user->email)->queue(new CloseTicketMail($ticket));
                }
                else{
                    // Send email to customer
                    Mail::to($ticket->user->email)->queue(new TicketResponseMail($ticket));
                }
                Toastr::success('success', 'Ticket updated successfully');
                return redirect()->back();

            } catch (\Exception $e) {
                Toastr::error('An error occurred: ' . $e->getMessage());
                return redirect()->back();
            }
    }

    public function storeResponse(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'ticket_id' => 'required',
        ]);
        try {

            $ticket = new TicketResponse();
            $ticket->ticket_id = $request->ticket_id;
            $ticket->user_id = auth()->user()->id;
            $ticket->message = $request->message;
            $ticket->save();
            Toastr::success('Success', 'Response added successfully');
            return redirect()->back();

        }
        catch (\Exception $e) {
            Toastr::error('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        if (auth()->user()->can('ticket-delete')) {
            $ticket->delete();
            Toastr::success('success', 'Ticket deleted successfully');
            return redirect()->back();
        }
        else {
            abort(403, 'Unauthorized action.');
        }
    }
}
