<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{
    //User

    public function UserIndexOngoingTickets()
    {
        $tickets = Ticket::where('user_id', '=', Auth::user()->id)
                ->where('status', '=', 'ongoing')
                ->get();
        return view('user.dashboard.ticket.ongoing', compact('tickets'));
    }

    public function UserIndexClosedTickets()
    {
        $tickets = Ticket::where('user_id', '=', Auth::user()->id)
                ->where('closed_at', '!=', null)
                ->get();
        return view('user.dashboard.ticket.closed', compact('tickets'));
    }

    public function NewTicketForm()
    {
        return view('user.dashboard.ticket.new');
    }

    public function NewTicket(Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $ticket = new Ticket;
        $ticket->user_id = Auth::user()->id;
        $ticket->title = $valid['title'];
        $ticket->type = $valid['type'];
        $ticket->save();

        return redirect(route('userShowTicket', compact('ticket')));
    }

    public function UserShowTicket(Ticket $ticket)
    {
        $messages = $ticket->Messages()->orderBy('created_at', 'asc')->get();
        return view('user.dashboard.ticket.show', compact('ticket', 'messages'));
    }

    public function UserSendMessage(Request $request, Ticket $ticket)
    {
        $valid = $request->validate([
            'body' => 'required',
        ]);

        $message = new Message;
        $message->body = $valid['body'];
        $message->ticket_id = $ticket->id;
        $message->sender_name = Auth::user()->fname.' '.Auth::user()->lname;
        $message->save();

        return Response::json($message);
    }

    

    public function UserEditMessage(Request $request, Message $message)
    {
        
    }

    //Admin

    public function AdminIndexOngoingTickets()
    {
        $tickets = Ticket::where('status', '=', 'ongoing')
                ->where('isArchived', '=', false)
                ->get();
        return view('admin.ticket.ongoing', compact('tickets'));
    }

    public function AdminIndexClosedTickets()
    {
        $tickets = Ticket::where('closed_at', '!=', null)
                ->where('isArchived', '=', false)
                ->get();
        return view('admin.ticket.closed', compact('tickets'));
    }

    public function AdminIndexArchivedTickets()
    {
        $tickets = Ticket::where('isArchived', '=', true)
                ->get();
        return view('admin.ticket.archived', compact('tickets'));
    }

    public function AdminShowTicket(Ticket $ticket)
    {
        $messages = $ticket->Messages()->orderBy('created_at', 'asc')->get();
        return view('admin.ticket.show', compact('ticket', 'messages'));
    }

    public function AdminSendMessage(Request $request, Ticket $ticket)
    {
    
        $valid = $request->validate([
            'body' => 'required',
        ]);

        $message = new Message;
        $message->body = $valid['body'];
        $message->ticket_id = $ticket->id;
        $message->sender_name = Auth::guard('admin')->user()->fname.' '.Auth::guard('admin')->user()->lname;
        $message->save();

        return Response::json($message);
    }

    public function UpdateMessageData(Ticket $ticket)
    {
        $messages = $ticket->Messages()->orderBy('created_at', 'asc')->get();

        return Response::json($messages);
    }

    public function AdminEditMessage(Request $request, Message $message)
    {
        
    }

    public function UpdateTicketStatus(Request $request, Ticket $ticket)
    {


        $ticket->status = $request->status;
        if($request->status == 'ongoing'){
            $ticket->closed_at = null;
        }else{

            $ticket->closed_at = now();
        }
        $ticket->save();

        return Response::json($ticket);
    }

    public function ArchiveTicket(Ticket $ticket)
    {
        $ticket->isArchived = true;
        $ticket->save();

        return redirect()->back();
    }

    public function UnarchiveTicket(Ticket $ticket)
    {
        $ticket->isArchived = false;
        $ticket->save();

        return redirect()->back();
    }
}
