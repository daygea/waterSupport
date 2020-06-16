<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Category;
use App\Http\Requests;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ZonesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display all tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$zones = DB::table('categories')->paginate(10);
        

        return view('zones.index', compact('zones'));
    }


    /**
     * Show the form for opening a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('zones.create', compact(''));
    }

    /**
     * Store a newly created ticket in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {


        $this->validate($request, [
            'name'     => 'required',
        ]);

        $zone = DB::table('categories')->insert([
                                            'name' => $request->name                                            
                                            ]);

        return redirect()->back()->with("status", "Zone created successfully!");
    }

    /**
     * Display a specified ticket.
     *
     * @param  int  $ticket_id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $comments = $ticket->comments;

        $category = $ticket->category;

        return view('tickets.show', compact('ticket', 'category', 'comments'));
    }


    public function edit($zone_id)
    {
        $zone = DB::table('categories')->where('id', $zone_id)->first();
        
        return view('zones.edit', compact('zone'));
    }


    public function update(Request $request, AppMailer $mailer)
    {

        $this->validate($request, [
            'name'     => 'required'           
        ]);        

         DB::table('categories')->where('id','=',$request->id)->update([
                                            'name' => $request->name                                        
                                            ]);

        return redirect()->back()->with("status", "Zone updated successfully!");

    }

    /**
     * Close the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $ticket->status = 'Closed';

        $ticket->save();

        $ticketOwner = $ticket->user;

        // $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
